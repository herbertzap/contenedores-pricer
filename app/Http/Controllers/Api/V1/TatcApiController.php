<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Tatc;
use App\Models\Operador;
use App\Models\User;
use App\Services\Hermes\HermesService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use PDF;

class TatcApiController extends Controller
{
    protected $hermesService;

    public function __construct(HermesService $hermesService)
    {
        $this->hermesService = $hermesService;
    }

    /**
     * Listar TATCs con filtros y paginación
     * GET /api/v1/tatc
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Tatc::with(['user', 'empresaTransportista', 'aduana']);

            // Filtros
            if ($request->has('numero_tatc')) {
                $query->where('numero_tatc', 'like', '%' . $request->numero_tatc . '%');
            }

            if ($request->has('numero_contenedor')) {
                $query->where('numero_contenedor', 'like', '%' . $request->numero_contenedor . '%');
            }

            if ($request->has('estado')) {
                $query->where('estado', $request->estado);
            }

            if ($request->has('aduana_ingreso')) {
                $query->where('aduana_ingreso', $request->aduana_ingreso);
            }

            if ($request->has('fecha_desde')) {
                $query->whereDate('created_at', '>=', $request->fecha_desde);
            }

            if ($request->has('fecha_hasta')) {
                $query->whereDate('created_at', '<=', $request->fecha_hasta);
            }

            if ($request->has('hermes_status')) {
                $query->where('hermes_status', $request->hermes_status);
            }

            // Ordenamiento
            $orderBy = $request->get('order_by', 'created_at');
            $orderDir = $request->get('order_dir', 'desc');
            $query->orderBy($orderBy, $orderDir);

            // Paginación
            $perPage = min($request->get('per_page', 15), 100);
            $tatcs = $query->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $tatcs,
                'message' => 'TATCs obtenidos correctamente'
            ]);

        } catch (\Exception $e) {
            Log::error('API V1 - Error listando TATCs: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener TATCs',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crear un nuevo TATC y enviarlo a HERMES
     * POST /api/v1/tatc
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'numero_contenedor' => 'required|string|max:20',
            'tipo_contenedor' => 'required|string|max:10',
            'tipo_ingreso' => 'required|in:traspaso,desembarque,reingreso',
            'aduana_ingreso' => 'required|string|max:10',
            'ingreso_pais' => 'required|date',
            'ingreso_deposito' => 'required|date',
            'fecha_traspaso' => 'nullable|date',
            'tatc_origen' => 'nullable|string|max:20',
            'tatc_destino' => 'nullable|string|max:20',
            'documento_ingreso' => 'nullable|string|max:50',
            'tara_contenedor' => 'nullable|string|max:20',
            'tipo_bulto' => 'nullable|string|max:50',
            'valor_fob' => 'nullable|numeric|min:0',
            'valor_cif' => 'nullable|numeric|min:0',
            'comentario' => 'nullable|string|max:500',
            'eir' => 'nullable|string|max:50',
            'tamano_contenedor' => 'nullable|string|max:10',
            'puerto_ingreso' => 'nullable|string|max:100',
            'estado_contenedor' => 'nullable|string|max:50',
            'anio_fabricacion' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'ubicacion_fisica' => 'nullable|string|max:200',
            'empresa_transportista_id' => 'nullable|integer|exists:empresa_transportistas,id',
            'rut_chofer' => 'nullable|string|max:20',
            'patente_camion' => 'nullable|string|max:20',
            'documento_transporte' => 'nullable|string|max:50',
            'enviar_hermes' => 'nullable|boolean', // Por defecto true
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Obtener usuario de la API (del token)
            $user = $request->user();
            $operador = $user->operador;

            if (!$operador) {
                return response()->json([
                    'success' => false,
                    'message' => 'El usuario no tiene un operador asignado'
                ], 400);
            }

            // Generar número de TATC automáticamente
            $numeroTatc = Tatc::generarNumeroTatcHermes2024($request->aduana_ingreso, $operador);

            // Crear el TATC
            $tatc = new Tatc();
            $tatc->numero_tatc = $numeroTatc;
            $tatc->numero_contenedor = strtoupper($request->numero_contenedor);
            $tatc->tipo_contenedor = $request->tipo_contenedor;
            $tatc->tipo_ingreso = $request->tipo_ingreso;
            $tatc->ingreso_pais = Carbon::parse($request->ingreso_pais);
            $tatc->ingreso_deposito = Carbon::parse($request->ingreso_deposito);
            $tatc->fecha_traspaso = $request->fecha_traspaso ? Carbon::parse($request->fecha_traspaso) : now();
            $tatc->fecha_emision_tatc = now();
            $tatc->tatc_origen = $request->tatc_origen;
            $tatc->tatc_destino = $request->tatc_destino;
            $tatc->documento_ingreso = $request->documento_ingreso;
            $tatc->tara_contenedor = $request->tara_contenedor;
            $tatc->tipo_bulto = $request->tipo_bulto;
            $tatc->valor_fob = $request->valor_fob;
            $tatc->valor_cif = $request->valor_cif;
            $tatc->comentario = $request->comentario;
            $tatc->aduana_ingreso = $request->aduana_ingreso;
            $tatc->eir = $request->eir;
            $tatc->tamano_contenedor = $request->tamano_contenedor;
            $tatc->puerto_ingreso = $request->puerto_ingreso;
            $tatc->estado_contenedor = $request->estado_contenedor;
            $tatc->anio_fabricacion = $request->anio_fabricacion;
            $tatc->ubicacion_fisica = $request->ubicacion_fisica;
            $tatc->empresa_transportista_id = $request->empresa_transportista_id;
            $tatc->rut_chofer = $request->rut_chofer;
            $tatc->patente_camion = $request->patente_camion;
            $tatc->documento_transporte = $request->documento_transporte;
            $tatc->estado = 'Pendiente';
            $tatc->user_id = $user->id;

            $tatc->save();

            Log::info('API V1 - TATC creado', [
                'tatc_id' => $tatc->id,
                'numero_tatc' => $tatc->numero_tatc,
                'user_id' => $user->id
            ]);

            // Enviar a HERMES si se solicita (por defecto sí)
            $enviarHermes = $request->get('enviar_hermes', true);
            $hermesResult = null;

            if ($enviarHermes) {
                try {
                    $hermesResult = $this->hermesService->enviarTatc($tatc);
                    
                    // Actualizar estado del TATC según respuesta de HERMES
                    if ($hermesResult['success']) {
                        $tatc->hermes_status = 'Enviado';
                        $tatc->hermes_sent_at = now();
                        $tatc->estado = 'Aprobado';
                    } else {
                        $tatc->hermes_status = 'Error';
                        $tatc->hermes_message = $hermesResult['error'] ?? 'Error desconocido';
                    }
                    $tatc->save();
                    
                } catch (\Exception $e) {
                    Log::error('API V1 - Error enviando TATC a HERMES: ' . $e->getMessage());
                    $hermesResult = [
                        'success' => false,
                        'error' => $e->getMessage()
                    ];
                }
            }

            DB::commit();

            // Preparar respuesta
            $response = [
                'success' => true,
                'message' => 'TATC creado correctamente',
                'data' => [
                    'tatc_id' => $tatc->id,
                    'numero_tatc' => $tatc->numero_tatc,
                    'numero_contenedor' => $tatc->numero_contenedor,
                    'estado' => $tatc->estado,
                    'fecha_emision' => $tatc->fecha_emision_tatc->format('Y-m-d'),
                    'fecha_vencimiento' => $tatc->fecha_vencimiento->format('Y-m-d'),
                    'dias_restantes' => $tatc->dias_restantes,
                    'pdf_url' => route('api.v1.tatc.pdf', $tatc->id),
                    'hermes' => $hermesResult ? [
                        'enviado' => $enviarHermes,
                        'status' => $hermesResult['success'] ? 'EXITOSO' : 'ERROR',
                        'message' => $hermesResult['success'] ? 'Enviado correctamente' : ($hermesResult['error'] ?? 'Error'),
                        'log_id' => $hermesResult['log_id'] ?? null
                    ] : null
                ]
            ];

            return response()->json($response, 201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('API V1 - Error creando TATC: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error al crear TATC',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crear múltiples TATCs de forma masiva
     * POST /api/v1/tatc/masivo
     */
    public function storeMasivo(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'tatcs' => 'required|array|min:1|max:100',
            'tatcs.*.numero_contenedor' => 'required|string|max:20',
            'tatcs.*.tipo_contenedor' => 'required|string|max:10',
            'tatcs.*.tipo_ingreso' => 'required|in:traspaso,desembarque,reingreso',
            'tatcs.*.aduana_ingreso' => 'required|string|max:10',
            'tatcs.*.ingreso_pais' => 'required|date',
            'tatcs.*.ingreso_deposito' => 'required|date',
            'enviar_hermes' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();
        $operador = $user->operador;

        if (!$operador) {
            return response()->json([
                'success' => false,
                'message' => 'El usuario no tiene un operador asignado'
            ], 400);
        }

        $resultados = [];
        $exitosos = 0;
        $fallidos = 0;
        $enviarHermes = $request->get('enviar_hermes', true);

        foreach ($request->tatcs as $index => $tatcData) {
            try {
                DB::beginTransaction();

                $numeroTatc = Tatc::generarNumeroTatcHermes2024($tatcData['aduana_ingreso'], $operador);

                $tatc = new Tatc();
                $tatc->numero_tatc = $numeroTatc;
                $tatc->numero_contenedor = strtoupper($tatcData['numero_contenedor']);
                $tatc->tipo_contenedor = $tatcData['tipo_contenedor'];
                $tatc->tipo_ingreso = $tatcData['tipo_ingreso'];
                $tatc->aduana_ingreso = $tatcData['aduana_ingreso'];
                $tatc->ingreso_pais = Carbon::parse($tatcData['ingreso_pais']);
                $tatc->ingreso_deposito = Carbon::parse($tatcData['ingreso_deposito']);
                $tatc->fecha_traspaso = isset($tatcData['fecha_traspaso']) ? Carbon::parse($tatcData['fecha_traspaso']) : now();
                $tatc->fecha_emision_tatc = now();
                $tatc->tatc_origen = $tatcData['tatc_origen'] ?? null;
                $tatc->documento_ingreso = $tatcData['documento_ingreso'] ?? null;
                $tatc->tara_contenedor = $tatcData['tara_contenedor'] ?? null;
                $tatc->tipo_bulto = $tatcData['tipo_bulto'] ?? null;
                $tatc->valor_fob = $tatcData['valor_fob'] ?? null;
                $tatc->comentario = $tatcData['comentario'] ?? null;
                $tatc->puerto_ingreso = $tatcData['puerto_ingreso'] ?? null;
                $tatc->empresa_transportista_id = $tatcData['empresa_transportista_id'] ?? null;
                $tatc->rut_chofer = $tatcData['rut_chofer'] ?? null;
                $tatc->patente_camion = $tatcData['patente_camion'] ?? null;
                $tatc->estado = 'Pendiente';
                $tatc->user_id = $user->id;

                $tatc->save();

                // Enviar a HERMES
                $hermesStatus = 'No enviado';
                if ($enviarHermes) {
                    try {
                        $hermesResult = $this->hermesService->enviarTatc($tatc);
                        if ($hermesResult['success']) {
                            $tatc->hermes_status = 'Enviado';
                            $tatc->hermes_sent_at = now();
                            $tatc->estado = 'Aprobado';
                            $hermesStatus = 'Enviado';
                        } else {
                            $tatc->hermes_status = 'Error';
                            $hermesStatus = 'Error: ' . ($hermesResult['error'] ?? 'Desconocido');
                        }
                        $tatc->save();
                    } catch (\Exception $e) {
                        $hermesStatus = 'Error: ' . $e->getMessage();
                    }
                }

                DB::commit();

                $resultados[] = [
                    'index' => $index,
                    'success' => true,
                    'tatc_id' => $tatc->id,
                    'numero_tatc' => $tatc->numero_tatc,
                    'numero_contenedor' => $tatc->numero_contenedor,
                    'hermes_status' => $hermesStatus,
                    'pdf_url' => route('api.v1.tatc.pdf', $tatc->id)
                ];
                $exitosos++;

            } catch (\Exception $e) {
                DB::rollBack();
                $resultados[] = [
                    'index' => $index,
                    'success' => false,
                    'numero_contenedor' => $tatcData['numero_contenedor'] ?? 'N/A',
                    'error' => $e->getMessage()
                ];
                $fallidos++;
            }
        }

        return response()->json([
            'success' => $fallidos === 0,
            'message' => "Procesados: {$exitosos} exitosos, {$fallidos} fallidos",
            'data' => [
                'total' => count($request->tatcs),
                'exitosos' => $exitosos,
                'fallidos' => $fallidos,
                'resultados' => $resultados
            ]
        ], $fallidos === 0 ? 201 : 207);
    }

    /**
     * Obtener un TATC específico
     * GET /api/v1/tatc/{id}
     */
    public function show($id): JsonResponse
    {
        try {
            $tatc = Tatc::with(['user', 'empresaTransportista', 'aduana', 'salidas', 'prorrogas'])
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'tatc' => $tatc,
                    'fecha_vencimiento' => $tatc->fecha_vencimiento->format('Y-m-d'),
                    'dias_restantes' => $tatc->dias_restantes,
                    'puede_modificarse' => $tatc->puedeSerModificado(),
                    'puede_solicitar_prorroga' => $tatc->puedeSolicitarProrroga(),
                    'pdf_url' => route('api.v1.tatc.pdf', $tatc->id)
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'TATC no encontrado',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Actualizar un TATC existente
     * PUT /api/v1/tatc/{id}
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $tatc = Tatc::findOrFail($id);

            // Verificar si puede ser modificado
            if (!$tatc->puedeSerModificado()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Este TATC no puede ser modificado porque tiene salidas registradas'
                ], 400);
            }

            $validator = Validator::make($request->all(), [
                'numero_contenedor' => 'sometimes|string|max:20',
                'tipo_contenedor' => 'sometimes|string|max:10',
                'tipo_ingreso' => 'sometimes|in:traspaso,desembarque,reingreso',
                'tara_contenedor' => 'nullable|string|max:20',
                'tipo_bulto' => 'nullable|string|max:50',
                'valor_fob' => 'nullable|numeric|min:0',
                'comentario' => 'nullable|string|max:500',
                'ubicacion_fisica' => 'nullable|string|max:200',
                'empresa_transportista_id' => 'nullable|integer|exists:empresa_transportistas,id',
                'rut_chofer' => 'nullable|string|max:20',
                'patente_camion' => 'nullable|string|max:20',
                'enviar_modificacion_hermes' => 'nullable|boolean',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error de validación',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Actualizar campos
            $tatc->fill($request->only([
                'numero_contenedor', 'tipo_contenedor', 'tipo_ingreso',
                'tara_contenedor', 'tipo_bulto', 'valor_fob', 'comentario',
                'ubicacion_fisica', 'empresa_transportista_id', 'rut_chofer', 'patente_camion'
            ]));

            if ($request->has('numero_contenedor')) {
                $tatc->numero_contenedor = strtoupper($request->numero_contenedor);
            }

            $tatc->save();

            // Enviar modificación a HERMES si se solicita
            $hermesResult = null;
            if ($request->get('enviar_modificacion_hermes', false)) {
                try {
                    $hermesResult = $this->hermesService->enviarModificacionTatc($tatc);
                } catch (\Exception $e) {
                    Log::error('API V1 - Error enviando modificación a HERMES: ' . $e->getMessage());
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'TATC actualizado correctamente',
                'data' => [
                    'tatc' => $tatc->fresh(),
                    'hermes' => $hermesResult
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar TATC',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generar PDF del TATC
     * GET /api/v1/tatc/{id}/pdf
     */
    public function generarPdf($id)
    {
        try {
            $tatc = Tatc::with(['user.operador', 'empresaTransportista'])->findOrFail($id);

            // Generar PDF usando la vista existente
            $pdf = PDF::loadView('tatc.pdf', compact('tatc'));
            
            $filename = 'TATC_' . $tatc->numero_tatc . '_' . now()->format('Y-m-d_H-i-s') . '.pdf';

            return $pdf->download($filename);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al generar PDF',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reenviar TATC a HERMES
     * POST /api/v1/tatc/{id}/hermes/enviar
     */
    public function enviarHermes($id): JsonResponse
    {
        try {
            $tatc = Tatc::findOrFail($id);
            $resultado = $this->hermesService->enviarTatc($tatc);

            if ($resultado['success']) {
                $tatc->hermes_status = 'Enviado';
                $tatc->hermes_sent_at = now();
                $tatc->save();
            }

            return response()->json([
                'success' => $resultado['success'],
                'message' => $resultado['success'] ? 'TATC enviado a HERMES correctamente' : 'Error al enviar a HERMES',
                'data' => $resultado
            ], $resultado['success'] ? 200 : 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar TATC a HERMES',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cancelar TATC y notificar a HERMES
     * POST /api/v1/tatc/{id}/cancelar
     */
    public function cancelar(Request $request, $id): JsonResponse
    {
        try {
            $tatc = Tatc::findOrFail($id);

            if ($tatc->estado === 'Cancelado') {
                return response()->json([
                    'success' => false,
                    'message' => 'El TATC ya está cancelado'
                ], 400);
            }

            $tatc->estado = 'Cancelado';
            $tatc->save();

            // Enviar cancelación a HERMES
            $hermesResult = null;
            if ($request->get('notificar_hermes', true)) {
                try {
                    $hermesResult = $this->hermesService->enviarCancelacionTatc($tatc);
                } catch (\Exception $e) {
                    Log::error('API V1 - Error enviando cancelación a HERMES: ' . $e->getMessage());
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'TATC cancelado correctamente',
                'data' => [
                    'tatc' => $tatc->fresh(),
                    'hermes' => $hermesResult
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cancelar TATC',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Buscar TATC por número de contenedor
     * GET /api/v1/tatc/buscar/contenedor/{numero}
     */
    public function buscarPorContenedor($numero): JsonResponse
    {
        try {
            $tatcs = Tatc::where('numero_contenedor', 'like', '%' . strtoupper($numero) . '%')
                ->with(['user', 'empresaTransportista'])
                ->orderBy('created_at', 'desc')
                ->limit(20)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $tatcs,
                'total' => $tatcs->count()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la búsqueda',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

