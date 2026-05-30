<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Tstc;
use App\Models\Operador;
use App\Models\AduanaChile;
use App\Services\Hermes\HermesService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use PDF;

class TstcApiController extends Controller
{
    protected $hermesService;

    public function __construct(HermesService $hermesService)
    {
        $this->hermesService = $hermesService;
    }

    /**
     * Listar TSTCs con filtros y paginación
     * GET /api/v1/tstc
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Tstc::with(['user', 'operador', 'empresaTransportista', 'aduana']);

            // Filtros
            if ($request->has('numero_tstc')) {
                $query->where('numero_tstc', 'like', '%' . $request->numero_tstc . '%');
            }

            if ($request->has('numero_contenedor')) {
                $query->where('numero_contenedor', 'like', '%' . $request->numero_contenedor . '%');
            }

            if ($request->has('estado')) {
                $query->where('estado', $request->estado);
            }

            if ($request->has('aduana_salida')) {
                $query->where('aduana_salida', $request->aduana_salida);
            }

            if ($request->has('fecha_desde')) {
                $query->whereDate('created_at', '>=', $request->fecha_desde);
            }

            if ($request->has('fecha_hasta')) {
                $query->whereDate('created_at', '<=', $request->fecha_hasta);
            }

            // Ordenamiento
            $orderBy = $request->get('order_by', 'created_at');
            $orderDir = $request->get('order_dir', 'desc');
            $query->orderBy($orderBy, $orderDir);

            // Paginación
            $perPage = min($request->get('per_page', 15), 100);
            $tstcs = $query->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $tstcs,
                'message' => 'TSTCs obtenidos correctamente'
            ]);

        } catch (\Exception $e) {
            Log::error('API V1 - Error listando TSTCs: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener TSTCs',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crear un nuevo TSTC y enviarlo a HERMES
     * POST /api/v1/tstc
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'numero_contenedor' => 'required|string|max:20',
            'tipo_contenedor' => 'required|string|max:10',
            'aduana_salida' => 'required|string|max:10',
            'destino_contenedor' => 'required|string|max:100',
            'fecha_salida_pais' => 'required|date',
            'ingreso_deposito' => 'nullable|date',
            'valor_fob' => 'nullable|numeric|min:0',
            'tara_contenedor' => 'nullable|string|max:20',
            'comentario' => 'nullable|string|max:500',
            'tamano_contenedor' => 'nullable|string|max:10',
            'estado_contenedor' => 'nullable|string|max:50',
            'codigo_tipo_bulto' => 'nullable|string|max:10',
            'anio_fabricacion' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'empresa_transportista_id' => 'nullable|integer|exists:empresa_transportistas,id',
            'rut_chofer' => 'nullable|string|max:20',
            'patente_camion' => 'nullable|string|max:20',
            'documento_transporte' => 'nullable|string|max:50',
            'codigo_operador_destino_oc' => 'nullable|string|max:10',
            'enviar_hermes' => 'nullable|boolean',
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

            $user = $request->user();
            $operador = $user->operador;

            if (!$operador) {
                return response()->json([
                    'success' => false,
                    'message' => 'El usuario no tiene un operador asignado'
                ], 400);
            }

            // Obtener aduana
            $aduana = AduanaChile::where('codigo', $request->aduana_salida)->first();

            // Generar número de TSTC
            $numeroTstc = Tstc::generarNumeroTstc($operador, $request->aduana_salida);

            // Crear el TSTC
            $tstc = new Tstc();
            $tstc->numero_tstc = $numeroTstc;
            $tstc->operador_id = $operador->id;
            $tstc->numero_contenedor = strtoupper($request->numero_contenedor);
            $tstc->tipo_contenedor = $request->tipo_contenedor;
            $tstc->aduana_salida = $request->aduana_salida;
            $tstc->destino_contenedor = $request->destino_contenedor;
            $tstc->fecha_salida_pais = Carbon::parse($request->fecha_salida_pais);
            $tstc->fecha_emision_tstc = now();
            $tstc->ingreso_deposito = $request->ingreso_deposito ? Carbon::parse($request->ingreso_deposito) : null;
            $tstc->valor_fob = $request->valor_fob;
            $tstc->tara_contenedor = $request->tara_contenedor;
            $tstc->comentario = $request->comentario;
            $tstc->tamano_contenedor = $request->tamano_contenedor;
            $tstc->estado_contenedor = $request->estado_contenedor;
            $tstc->codigo_tipo_bulto = $request->codigo_tipo_bulto;
            $tstc->anio_fabricacion = $request->anio_fabricacion;
            $tstc->empresa_transportista_id = $request->empresa_transportista_id;
            $tstc->rut_chofer = $request->rut_chofer;
            $tstc->patente_camion = $request->patente_camion;
            $tstc->documento_transporte = $request->documento_transporte;
            $tstc->codigo_operador_destino_oc = $request->codigo_operador_destino_oc;
            $tstc->estado = 'Pendiente';
            $tstc->user_id = $user->id;

            $tstc->save();

            Log::info('API V1 - TSTC creado', [
                'tstc_id' => $tstc->id,
                'numero_tstc' => $tstc->numero_tstc,
                'user_id' => $user->id
            ]);

            // Enviar a HERMES si se solicita
            $enviarHermes = $request->get('enviar_hermes', true);
            $hermesResult = null;

            if ($enviarHermes) {
                try {
                    $hermesResult = $this->hermesService->enviarTstc($tstc);
                    
                    if ($hermesResult['success']) {
                        $tstc->estado = 'Aprobado';
                    }
                    $tstc->save();
                    
                } catch (\Exception $e) {
                    Log::error('API V1 - Error enviando TSTC a HERMES: ' . $e->getMessage());
                    $hermesResult = [
                        'success' => false,
                        'error' => $e->getMessage()
                    ];
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'TSTC creado correctamente',
                'data' => [
                    'tstc_id' => $tstc->id,
                    'numero_tstc' => $tstc->numero_tstc,
                    'numero_contenedor' => $tstc->numero_contenedor,
                    'estado' => $tstc->estado,
                    'fecha_emision' => $tstc->fecha_emision_tstc->format('Y-m-d'),
                    'pdf_url' => route('api.v1.tstc.pdf', $tstc->id),
                    'hermes' => $hermesResult ? [
                        'enviado' => $enviarHermes,
                        'status' => $hermesResult['success'] ? 'EXITOSO' : 'ERROR',
                        'log_id' => $hermesResult['log_id'] ?? null
                    ] : null
                ]
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('API V1 - Error creando TSTC: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al crear TSTC',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crear múltiples TSTCs de forma masiva
     * POST /api/v1/tstc/masivo
     */
    public function storeMasivo(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'tstcs' => 'required|array|min:1|max:100',
            'tstcs.*.numero_contenedor' => 'required|string|max:20',
            'tstcs.*.tipo_contenedor' => 'required|string|max:10',
            'tstcs.*.aduana_salida' => 'required|string|max:10',
            'tstcs.*.destino_contenedor' => 'required|string|max:100',
            'tstcs.*.fecha_salida_pais' => 'required|date',
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

        foreach ($request->tstcs as $index => $tstcData) {
            try {
                DB::beginTransaction();

                $numeroTstc = Tstc::generarNumeroTstc($operador, $tstcData['aduana_salida']);

                $tstc = new Tstc();
                $tstc->numero_tstc = $numeroTstc;
                $tstc->operador_id = $operador->id;
                $tstc->numero_contenedor = strtoupper($tstcData['numero_contenedor']);
                $tstc->tipo_contenedor = $tstcData['tipo_contenedor'];
                $tstc->aduana_salida = $tstcData['aduana_salida'];
                $tstc->destino_contenedor = $tstcData['destino_contenedor'];
                $tstc->fecha_salida_pais = Carbon::parse($tstcData['fecha_salida_pais']);
                $tstc->fecha_emision_tstc = now();
                $tstc->valor_fob = $tstcData['valor_fob'] ?? null;
                $tstc->comentario = $tstcData['comentario'] ?? null;
                $tstc->empresa_transportista_id = $tstcData['empresa_transportista_id'] ?? null;
                $tstc->estado = 'Pendiente';
                $tstc->user_id = $user->id;

                $tstc->save();

                // Enviar a HERMES
                $hermesStatus = 'No enviado';
                if ($enviarHermes) {
                    try {
                        $hermesResult = $this->hermesService->enviarTstc($tstc);
                        $hermesStatus = $hermesResult['success'] ? 'Enviado' : 'Error';
                        if ($hermesResult['success']) {
                            $tstc->estado = 'Aprobado';
                            $tstc->save();
                        }
                    } catch (\Exception $e) {
                        $hermesStatus = 'Error: ' . $e->getMessage();
                    }
                }

                DB::commit();

                $resultados[] = [
                    'index' => $index,
                    'success' => true,
                    'tstc_id' => $tstc->id,
                    'numero_tstc' => $tstc->numero_tstc,
                    'numero_contenedor' => $tstc->numero_contenedor,
                    'hermes_status' => $hermesStatus,
                    'pdf_url' => route('api.v1.tstc.pdf', $tstc->id)
                ];
                $exitosos++;

            } catch (\Exception $e) {
                DB::rollBack();
                $resultados[] = [
                    'index' => $index,
                    'success' => false,
                    'numero_contenedor' => $tstcData['numero_contenedor'] ?? 'N/A',
                    'error' => $e->getMessage()
                ];
                $fallidos++;
            }
        }

        return response()->json([
            'success' => $fallidos === 0,
            'message' => "Procesados: {$exitosos} exitosos, {$fallidos} fallidos",
            'data' => [
                'total' => count($request->tstcs),
                'exitosos' => $exitosos,
                'fallidos' => $fallidos,
                'resultados' => $resultados
            ]
        ], $fallidos === 0 ? 201 : 207);
    }

    /**
     * Obtener un TSTC específico
     * GET /api/v1/tstc/{id}
     */
    public function show($id): JsonResponse
    {
        try {
            $tstc = Tstc::with(['user', 'operador', 'empresaTransportista', 'aduana', 'salidas'])
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'tstc' => $tstc,
                    'pdf_url' => route('api.v1.tstc.pdf', $tstc->id)
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'TSTC no encontrado',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Actualizar un TSTC existente
     * PUT /api/v1/tstc/{id}
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $tstc = Tstc::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'destino_contenedor' => 'sometimes|string|max:100',
                'valor_fob' => 'nullable|numeric|min:0',
                'tara_contenedor' => 'nullable|string|max:20',
                'comentario' => 'nullable|string|max:500',
                'empresa_transportista_id' => 'nullable|integer|exists:empresa_transportistas,id',
                'rut_chofer' => 'nullable|string|max:20',
                'patente_camion' => 'nullable|string|max:20',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error de validación',
                    'errors' => $validator->errors()
                ], 422);
            }

            $tstc->fill($request->only([
                'destino_contenedor', 'valor_fob', 'tara_contenedor', 'comentario',
                'empresa_transportista_id', 'rut_chofer', 'patente_camion'
            ]));

            $tstc->save();

            return response()->json([
                'success' => true,
                'message' => 'TSTC actualizado correctamente',
                'data' => $tstc->fresh()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar TSTC',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generar PDF del TSTC
     * GET /api/v1/tstc/{id}/pdf
     */
    public function generarPdf($id)
    {
        try {
            $tstc = Tstc::with(['user', 'operador', 'empresaTransportista'])->findOrFail($id);

            // Generar PDF
            $pdf = PDF::loadView('tstc.pdf', compact('tstc'));
            
            $filename = 'TSTC_' . $tstc->numero_tstc . '_' . now()->format('Y-m-d_H-i-s') . '.pdf';

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
     * Reenviar TSTC a HERMES
     * POST /api/v1/tstc/{id}/hermes/enviar
     */
    public function enviarHermes($id): JsonResponse
    {
        try {
            $tstc = Tstc::findOrFail($id);
            $resultado = $this->hermesService->enviarTstc($tstc);

            return response()->json([
                'success' => $resultado['success'],
                'message' => $resultado['success'] ? 'TSTC enviado a HERMES correctamente' : 'Error al enviar a HERMES',
                'data' => $resultado
            ], $resultado['success'] ? 200 : 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar TSTC a HERMES',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

