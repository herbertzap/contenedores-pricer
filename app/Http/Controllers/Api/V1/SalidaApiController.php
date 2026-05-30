<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Salida;
use App\Models\Tatc;
use App\Services\Hermes\HermesService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class SalidaApiController extends Controller
{
    protected $hermesService;

    public function __construct(HermesService $hermesService)
    {
        $this->hermesService = $hermesService;
    }

    /**
     * Listar Salidas con filtros y paginación
     * GET /api/v1/salidas
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Salida::with(['tatc', 'user', 'empresaTransportista']);

            // Filtros
            if ($request->has('numero_salida')) {
                $query->where('numero_salida', 'like', '%' . $request->numero_salida . '%');
            }

            if ($request->has('numero_contenedor')) {
                $query->where('numero_contenedor', 'like', '%' . $request->numero_contenedor . '%');
            }

            if ($request->has('tipo_salida')) {
                $query->where('tipo_salida', $request->tipo_salida);
            }

            if ($request->has('estado')) {
                $query->where('estado', $request->estado);
            }

            if ($request->has('tatc_id')) {
                $query->where('tatc_id', $request->tatc_id);
            }

            if ($request->has('fecha_desde')) {
                $query->whereDate('fecha_salida', '>=', $request->fecha_desde);
            }

            if ($request->has('fecha_hasta')) {
                $query->whereDate('fecha_salida', '<=', $request->fecha_hasta);
            }

            // Ordenamiento
            $query->orderBy($request->get('order_by', 'created_at'), $request->get('order_dir', 'desc'));

            // Paginación
            $perPage = min($request->get('per_page', 15), 100);
            $salidas = $query->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $salidas
            ]);

        } catch (\Exception $e) {
            Log::error('API V1 - Error listando Salidas: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener Salidas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Registrar una Salida por Internación (Declaración de Internación)
     * POST /api/v1/salidas/internacion
     */
    public function registrarInternacion(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'tatc_id' => 'required|exists:tatcs,id',
            'fecha_salida' => 'required|date',
            'declaracion_internacion' => 'required|string|max:50',
            'comentario_internacion' => 'nullable|string|max:500',
            'empresa_transportista_id' => 'nullable|integer|exists:empresa_transportistas,id',
            'rut_chofer' => 'nullable|string|max:20',
            'patente_camion' => 'nullable|string|max:20',
            'destino_final' => 'nullable|string|max:200',
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
            $tatc = Tatc::findOrFail($request->tatc_id);

            // Verificar que el TATC puede tener salidas
            if ($tatc->estado === 'Cancelado' || $tatc->estado === 'Con Salida') {
                return response()->json([
                    'success' => false,
                    'message' => 'El TATC no admite más salidas'
                ], 400);
            }

            // Generar número de salida
            $numeroSalida = Salida::generarNumeroSalida($tatc, 'internacion');

            $salida = new Salida();
            $salida->tatc_id = $tatc->id;
            $salida->numero_salida = $numeroSalida;
            $salida->numero_contenedor = $tatc->numero_contenedor;
            $salida->tipo_contenedor = $tatc->tipo_contenedor;
            $salida->fecha_salida = Carbon::parse($request->fecha_salida);
            $salida->tipo_salida = 'internacion';
            $salida->motivo_salida = 'Declaración de Internación';
            $salida->declaracion_internacion = $request->declaracion_internacion;
            $salida->comentario_internacion = $request->comentario_internacion;
            $salida->empresa_transportista_id = $request->empresa_transportista_id;
            $salida->rut_chofer = $request->rut_chofer;
            $salida->patente_camion = $request->patente_camion;
            $salida->destino_final = $request->destino_final;
            $salida->estado = 'Pendiente';
            $salida->user_id = $user->id;

            $salida->save();

            // Actualizar estado del TATC
            $tatc->estado = 'Con Salida';
            $tatc->save();

            // Enviar a HERMES (cumplido)
            $hermesResult = null;
            if ($request->get('enviar_hermes', true)) {
                try {
                    $hermesResult = $this->hermesService->enviarCumplidoTatc($tatc);
                    if ($hermesResult['success']) {
                        $salida->estado = 'Aprobado';
                        $salida->save();
                    }
                } catch (\Exception $e) {
                    Log::error('API V1 - Error enviando internación a HERMES: ' . $e->getMessage());
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Internación registrada correctamente',
                'data' => [
                    'salida_id' => $salida->id,
                    'numero_salida' => $salida->numero_salida,
                    'tatc' => [
                        'id' => $tatc->id,
                        'numero_tatc' => $tatc->numero_tatc,
                        'estado' => $tatc->estado
                    ],
                    'hermes' => $hermesResult
                ]
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('API V1 - Error registrando internación: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar internación',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Registrar una Salida por Cancelación
     * POST /api/v1/salidas/cancelacion
     */
    public function registrarCancelacion(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'tatc_id' => 'required|exists:tatcs,id',
            'fecha_salida' => 'required|date',
            'aduana_ingreso_cancelacion' => 'required|string|max:10',
            'documento_cancelacion' => 'required|string|max:50',
            'observaciones' => 'nullable|string|max:500',
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
            $tatc = Tatc::findOrFail($request->tatc_id);

            if ($tatc->estado === 'Cancelado') {
                return response()->json([
                    'success' => false,
                    'message' => 'El TATC ya está cancelado'
                ], 400);
            }

            $numeroSalida = Salida::generarNumeroSalida($tatc, 'cancelacion');

            $salida = new Salida();
            $salida->tatc_id = $tatc->id;
            $salida->numero_salida = $numeroSalida;
            $salida->numero_contenedor = $tatc->numero_contenedor;
            $salida->tipo_contenedor = $tatc->tipo_contenedor;
            $salida->fecha_salida = Carbon::parse($request->fecha_salida);
            $salida->tipo_salida = 'cancelacion';
            $salida->motivo_salida = 'Cancelación de TATC';
            $salida->aduana_ingreso_cancelacion = $request->aduana_ingreso_cancelacion;
            $salida->documento_cancelacion = $request->documento_cancelacion;
            $salida->observaciones = $request->observaciones;
            $salida->estado = 'Pendiente';
            $salida->user_id = $user->id;

            $salida->save();

            // Actualizar estado del TATC
            $tatc->estado = 'Cancelado';
            $tatc->save();

            // Enviar cancelación a HERMES
            $hermesResult = null;
            if ($request->get('enviar_hermes', true)) {
                try {
                    $hermesResult = $this->hermesService->enviarCancelacionTatc($tatc);
                    if ($hermesResult['success']) {
                        $salida->estado = 'Aprobado';
                        $salida->save();
                    }
                } catch (\Exception $e) {
                    Log::error('API V1 - Error enviando cancelación a HERMES: ' . $e->getMessage());
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Cancelación registrada correctamente',
                'data' => [
                    'salida_id' => $salida->id,
                    'numero_salida' => $salida->numero_salida,
                    'tatc' => [
                        'id' => $tatc->id,
                        'numero_tatc' => $tatc->numero_tatc,
                        'estado' => $tatc->estado
                    ],
                    'hermes' => $hermesResult
                ]
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('API V1 - Error registrando cancelación: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar cancelación',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Registrar una Salida por Traspaso
     * POST /api/v1/salidas/traspaso
     */
    public function registrarTraspaso(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'tatc_id' => 'required|exists:tatcs,id',
            'fecha_salida' => 'required|date',
            'operador_destino' => 'required|string|max:100',
            'tatc_destino' => 'nullable|string|max:20',
            'lugar_deposito_origen' => 'nullable|string|max:100',
            'lugar_deposito_destino' => 'nullable|string|max:100',
            'valor_contenedor_traspaso' => 'nullable|numeric|min:0',
            'tipo_bulto_traspaso' => 'nullable|string|max:50',
            'observaciones' => 'nullable|string|max:500',
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
            $tatc = Tatc::findOrFail($request->tatc_id);

            if (in_array($tatc->estado, ['Cancelado', 'Con Salida', 'Traspasado'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'El TATC no puede ser traspasado'
                ], 400);
            }

            $numeroSalida = Salida::generarNumeroSalida($tatc, 'traspaso');

            $salida = new Salida();
            $salida->tatc_id = $tatc->id;
            $salida->numero_salida = $numeroSalida;
            $salida->numero_contenedor = $tatc->numero_contenedor;
            $salida->tipo_contenedor = $tatc->tipo_contenedor;
            $salida->fecha_salida = Carbon::parse($request->fecha_salida);
            $salida->tipo_salida = 'traspaso';
            $salida->motivo_salida = 'Traspaso a otro operador';
            $salida->operador_destino = $request->operador_destino;
            $salida->tatc_destino = $request->tatc_destino;
            $salida->lugar_deposito_origen = $request->lugar_deposito_origen;
            $salida->lugar_deposito_destino = $request->lugar_deposito_destino;
            $salida->valor_contenedor_traspaso = $request->valor_contenedor_traspaso;
            $salida->tipo_bulto_traspaso = $request->tipo_bulto_traspaso;
            $salida->observaciones = $request->observaciones;
            $salida->estado = 'Pendiente';
            $salida->user_id = $user->id;

            $salida->save();

            // Actualizar TATC
            $tatc->estado = 'Traspasado';
            $tatc->tatc_destino = $request->tatc_destino;
            $tatc->save();

            // Enviar traspaso a HERMES
            $hermesResult = null;
            if ($request->get('enviar_hermes', true)) {
                try {
                    $hermesResult = $this->hermesService->enviarTraspasoTatc($tatc);
                    if ($hermesResult['success']) {
                        $salida->estado = 'Aprobado';
                        $salida->save();
                    }
                } catch (\Exception $e) {
                    Log::error('API V1 - Error enviando traspaso a HERMES: ' . $e->getMessage());
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Traspaso registrado correctamente',
                'data' => [
                    'salida_id' => $salida->id,
                    'numero_salida' => $salida->numero_salida,
                    'tatc' => [
                        'id' => $tatc->id,
                        'numero_tatc' => $tatc->numero_tatc,
                        'estado' => $tatc->estado
                    ],
                    'hermes' => $hermesResult
                ]
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('API V1 - Error registrando traspaso: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar traspaso',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener una Salida específica
     * GET /api/v1/salidas/{id}
     */
    public function show($id): JsonResponse
    {
        try {
            $salida = Salida::with(['tatc', 'user', 'empresaTransportista'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $salida
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Salida no encontrada'
            ], 404);
        }
    }

    /**
     * Obtener TATCs vigentes disponibles para salida
     * GET /api/v1/salidas/tatcs-disponibles
     */
    public function tatcsDisponibles(Request $request): JsonResponse
    {
        try {
            $tatcs = Tatc::whereNotIn('estado', ['Cancelado', 'Con Salida', 'Traspasado', 'Vencido'])
                ->with(['empresaTransportista'])
                ->orderBy('created_at', 'desc');

            if ($request->has('numero_contenedor')) {
                $tatcs->where('numero_contenedor', 'like', '%' . $request->numero_contenedor . '%');
            }

            $tatcs = $tatcs->limit(50)->get();

            return response()->json([
                'success' => true,
                'data' => $tatcs->map(function ($tatc) {
                    return [
                        'tatc_id' => $tatc->id,
                        'numero_tatc' => $tatc->numero_tatc,
                        'numero_contenedor' => $tatc->numero_contenedor,
                        'tipo_contenedor' => $tatc->tipo_contenedor,
                        'estado' => $tatc->estado,
                        'fecha_vencimiento' => $tatc->fecha_vencimiento->format('Y-m-d'),
                        'dias_restantes' => $tatc->dias_restantes
                    ];
                })
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener TATCs disponibles',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

