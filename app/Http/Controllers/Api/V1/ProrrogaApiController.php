<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Prorroga;
use App\Models\Tatc;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ProrrogaApiController extends Controller
{
    /**
     * Listar Prórrogas con filtros y paginación
     * GET /api/v1/prorrogas
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Prorroga::with(['tatc', 'user']);

            // Filtros
            if ($request->has('tatc_id')) {
                $query->where('tatc_id', $request->tatc_id);
            }

            if ($request->has('estado')) {
                $query->where('estado', $request->estado);
            }

            if ($request->has('fecha_desde')) {
                $query->whereDate('created_at', '>=', $request->fecha_desde);
            }

            if ($request->has('fecha_hasta')) {
                $query->whereDate('created_at', '<=', $request->fecha_hasta);
            }

            // Ordenamiento
            $query->orderBy($request->get('order_by', 'created_at'), $request->get('order_dir', 'desc'));

            // Paginación
            $perPage = min($request->get('per_page', 15), 100);
            $prorrogas = $query->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $prorrogas
            ]);

        } catch (\Exception $e) {
            Log::error('API V1 - Error listando Prórrogas: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener Prórrogas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Solicitar una Prórroga para un TATC
     * POST /api/v1/prorrogas
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'tatc_id' => 'required|exists:tatcs,id',
            'motivo' => 'required|string|max:500',
            'dias_solicitados' => 'nullable|integer|min:1|max:365',
            'documentos_adjuntos' => 'nullable|string|max:500',
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

            // Verificar si el TATC puede solicitar prórroga
            if (!$tatc->puedeSolicitarProrroga()) {
                $mensaje = 'El TATC no puede solicitar prórroga. ';
                
                if ($tatc->prorrogas()->exists()) {
                    $mensaje .= 'Ya tiene una prórroga registrada.';
                } elseif (!$tatc->estaProximoAVencer()) {
                    $mensaje .= 'Aún no está próximo a vencer (debe estar a 30 días del vencimiento).';
                } elseif ($tatc->created_at->addYear()->lt(now())) {
                    $mensaje .= 'El TATC ya venció.';
                }

                return response()->json([
                    'success' => false,
                    'message' => $mensaje
                ], 400);
            }

            // Calcular nueva fecha de vencimiento (máximo 365 días adicionales)
            $diasSolicitados = $request->get('dias_solicitados', 365);
            $fechaVencimientoActual = $tatc->fecha_vencimiento;
            $nuevaFechaVencimiento = $fechaVencimientoActual->copy()->addDays($diasSolicitados);

            $prorroga = new Prorroga();
            $prorroga->tatc_id = $tatc->id;
            $prorroga->fecha_solicitud = now();
            $prorroga->fecha_vencimiento_original = $fechaVencimientoActual;
            $prorroga->fecha_vencimiento_nueva = $nuevaFechaVencimiento;
            $prorroga->dias_solicitados = $diasSolicitados;
            $prorroga->motivo = $request->motivo;
            $prorroga->documentos_adjuntos = $request->documentos_adjuntos;
            $prorroga->estado = 'Pendiente';
            $prorroga->user_id = $user->id;

            $prorroga->save();

            Log::info('API V1 - Prórroga solicitada', [
                'prorroga_id' => $prorroga->id,
                'tatc_id' => $tatc->id,
                'dias_solicitados' => $diasSolicitados
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Prórroga solicitada correctamente',
                'data' => [
                    'prorroga_id' => $prorroga->id,
                    'tatc' => [
                        'id' => $tatc->id,
                        'numero_tatc' => $tatc->numero_tatc,
                        'numero_contenedor' => $tatc->numero_contenedor
                    ],
                    'fecha_vencimiento_original' => $fechaVencimientoActual->format('Y-m-d'),
                    'fecha_vencimiento_nueva' => $nuevaFechaVencimiento->format('Y-m-d'),
                    'dias_solicitados' => $diasSolicitados,
                    'estado' => 'Pendiente'
                ]
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('API V1 - Error solicitando prórroga: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al solicitar prórroga',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener una Prórroga específica
     * GET /api/v1/prorrogas/{id}
     */
    public function show($id): JsonResponse
    {
        try {
            $prorroga = Prorroga::with(['tatc', 'user'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $prorroga
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Prórroga no encontrada'
            ], 404);
        }
    }

    /**
     * Aprobar una Prórroga (uso interno/admin)
     * POST /api/v1/prorrogas/{id}/aprobar
     */
    public function aprobar(Request $request, $id): JsonResponse
    {
        try {
            $prorroga = Prorroga::findOrFail($id);

            if ($prorroga->estado !== 'Pendiente') {
                return response()->json([
                    'success' => false,
                    'message' => 'La prórroga ya fue procesada'
                ], 400);
            }

            $prorroga->estado = 'Aprobada';
            $prorroga->fecha_aprobacion = now();
            $prorroga->aprobado_por = $request->user()->id;
            $prorroga->observaciones_aprobacion = $request->observaciones;
            $prorroga->save();

            return response()->json([
                'success' => true,
                'message' => 'Prórroga aprobada correctamente',
                'data' => $prorroga->fresh(['tatc', 'user'])
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al aprobar prórroga',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Rechazar una Prórroga (uso interno/admin)
     * POST /api/v1/prorrogas/{id}/rechazar
     */
    public function rechazar(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'motivo_rechazo' => 'required|string|max:500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Debe indicar el motivo del rechazo',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $prorroga = Prorroga::findOrFail($id);

            if ($prorroga->estado !== 'Pendiente') {
                return response()->json([
                    'success' => false,
                    'message' => 'La prórroga ya fue procesada'
                ], 400);
            }

            $prorroga->estado = 'Rechazada';
            $prorroga->fecha_aprobacion = now();
            $prorroga->aprobado_por = $request->user()->id;
            $prorroga->motivo_rechazo = $request->motivo_rechazo;
            $prorroga->save();

            return response()->json([
                'success' => true,
                'message' => 'Prórroga rechazada',
                'data' => $prorroga->fresh(['tatc', 'user'])
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al rechazar prórroga',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener TATCs que pueden solicitar prórroga
     * GET /api/v1/prorrogas/tatcs-elegibles
     */
    public function tatcsElegibles(Request $request): JsonResponse
    {
        try {
            // TATCs próximos a vencer (30 días antes) que no tengan prórroga
            $fechaLimite = now()->addDays(30);
            
            $tatcs = Tatc::whereDoesntHave('prorrogas')
                ->where('estado', '!=', 'Cancelado')
                ->where('estado', '!=', 'Con Salida')
                ->whereRaw('DATE_ADD(created_at, INTERVAL 1 YEAR) > NOW()')
                ->whereRaw('DATE_ADD(created_at, INTERVAL 335 DAY) <= NOW()')
                ->with(['user'])
                ->orderBy('created_at', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $tatcs->map(function ($tatc) {
                    return [
                        'tatc_id' => $tatc->id,
                        'numero_tatc' => $tatc->numero_tatc,
                        'numero_contenedor' => $tatc->numero_contenedor,
                        'fecha_vencimiento' => $tatc->fecha_vencimiento->format('Y-m-d'),
                        'dias_restantes' => $tatc->dias_restantes,
                        'estado' => $tatc->estado
                    ];
                }),
                'total' => $tatcs->count()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener TATCs elegibles',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

