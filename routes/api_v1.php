<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TatcApiController;
use App\Http\Controllers\Api\V1\TstcApiController;
use App\Http\Controllers\Api\V1\SalidaApiController;
use App\Http\Controllers\Api\V1\ProrrogaApiController;

/*
|--------------------------------------------------------------------------
| API V1 Routes - Microservicio Externo
|--------------------------------------------------------------------------
|
| Rutas de la API V1 para integración con sistemas externos.
| Todas las rutas requieren autenticación mediante Token Bearer (Sanctum).
|
| Base URL: /api/v1
|
| Autenticación:
|   Header: Authorization: Bearer {token}
|
| Para obtener un token:
|   POST /api/v1/auth/token
|   Body: { "email": "user@email.com", "password": "..." }
|
*/

// ============================================================================
// AUTENTICACIÓN
// ============================================================================
Route::post('/auth/token', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'nullable|string'
    ]);

    $user = \App\Models\User::where('email', $request->email)->first();

    if (!$user || !\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        return response()->json([
            'success' => false,
            'message' => 'Credenciales inválidas'
        ], 401);
    }

    // Verificar que el usuario tenga un operador asignado
    if (!$user->operador) {
        return response()->json([
            'success' => false,
            'message' => 'El usuario no tiene un operador asignado. Contacte al administrador.'
        ], 403);
    }

    $deviceName = $request->device_name ?? 'api-client';
    $token = $user->createToken($deviceName)->plainTextToken;

    return response()->json([
        'success' => true,
        'message' => 'Autenticación exitosa',
        'data' => [
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ],
            'operador' => [
                'id' => $user->operador->id,
                'codigo' => $user->operador->codigo,
                'nombre' => $user->operador->nombre_operador
            ]
        ]
    ]);
});

Route::post('/auth/logout', function (\Illuminate\Http\Request $request) {
    $request->user()->currentAccessToken()->delete();
    
    return response()->json([
        'success' => true,
        'message' => 'Sesión cerrada correctamente'
    ]);
})->middleware('auth:sanctum');


// ============================================================================
// RUTAS PROTEGIDAS (Requieren Token)
// ============================================================================
Route::middleware('auth:sanctum')->group(function () {

    // ========================================================================
    // INFORMACIÓN DEL USUARIO Y OPERADOR
    // ========================================================================
    Route::get('/me', function (\Illuminate\Http\Request $request) {
        $user = $request->user()->load('operador');
        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
                'operador' => $user->operador
            ]
        ]);
    });

    // ========================================================================
    // TATC - Títulos de Admisión Temporal de Contenedores
    // ========================================================================
    Route::prefix('tatc')->name('api.v1.tatc.')->group(function () {
        // CRUD básico
        Route::get('/', [TatcApiController::class, 'index'])->name('index');
        Route::post('/', [TatcApiController::class, 'store'])->name('store');
        Route::get('/{id}', [TatcApiController::class, 'show'])->name('show');
        Route::put('/{id}', [TatcApiController::class, 'update'])->name('update');
        
        // Carga masiva
        Route::post('/masivo', [TatcApiController::class, 'storeMasivo'])->name('masivo');
        
        // PDF
        Route::get('/{id}/pdf', [TatcApiController::class, 'generarPdf'])->name('pdf');
        
        // HERMES
        Route::post('/{id}/hermes/enviar', [TatcApiController::class, 'enviarHermes'])->name('hermes.enviar');
        
        // Cancelación
        Route::post('/{id}/cancelar', [TatcApiController::class, 'cancelar'])->name('cancelar');
        
        // Búsquedas
        Route::get('/buscar/contenedor/{numero}', [TatcApiController::class, 'buscarPorContenedor'])->name('buscar.contenedor');
    });

    // ========================================================================
    // TSTC - Títulos de Salida Temporal de Contenedores
    // ========================================================================
    Route::prefix('tstc')->name('api.v1.tstc.')->group(function () {
        // CRUD básico
        Route::get('/', [TstcApiController::class, 'index'])->name('index');
        Route::post('/', [TstcApiController::class, 'store'])->name('store');
        Route::get('/{id}', [TstcApiController::class, 'show'])->name('show');
        Route::put('/{id}', [TstcApiController::class, 'update'])->name('update');
        
        // Carga masiva
        Route::post('/masivo', [TstcApiController::class, 'storeMasivo'])->name('masivo');
        
        // PDF
        Route::get('/{id}/pdf', [TstcApiController::class, 'generarPdf'])->name('pdf');
        
        // HERMES
        Route::post('/{id}/hermes/enviar', [TstcApiController::class, 'enviarHermes'])->name('hermes.enviar');
    });

    // ========================================================================
    // SALIDAS - Internación, Cancelación, Traspaso
    // ========================================================================
    Route::prefix('salidas')->name('api.v1.salidas.')->group(function () {
        // Listado
        Route::get('/', [SalidaApiController::class, 'index'])->name('index');
        Route::get('/{id}', [SalidaApiController::class, 'show'])->name('show');
        
        // Tipos de salida
        Route::post('/internacion', [SalidaApiController::class, 'registrarInternacion'])->name('internacion');
        Route::post('/cancelacion', [SalidaApiController::class, 'registrarCancelacion'])->name('cancelacion');
        Route::post('/traspaso', [SalidaApiController::class, 'registrarTraspaso'])->name('traspaso');
        
        // TATCs disponibles para salida
        Route::get('/tatcs-disponibles', [SalidaApiController::class, 'tatcsDisponibles'])->name('tatcs-disponibles');
    });

    // ========================================================================
    // PRÓRROGAS
    // ========================================================================
    Route::prefix('prorrogas')->name('api.v1.prorrogas.')->group(function () {
        // CRUD
        Route::get('/', [ProrrogaApiController::class, 'index'])->name('index');
        Route::post('/', [ProrrogaApiController::class, 'store'])->name('store');
        Route::get('/{id}', [ProrrogaApiController::class, 'show'])->name('show');
        
        // Aprobación/Rechazo (admin)
        Route::post('/{id}/aprobar', [ProrrogaApiController::class, 'aprobar'])->name('aprobar');
        Route::post('/{id}/rechazar', [ProrrogaApiController::class, 'rechazar'])->name('rechazar');
        
        // TATCs elegibles para prórroga
        Route::get('/tatcs-elegibles', [ProrrogaApiController::class, 'tatcsElegibles'])->name('tatcs-elegibles');
    });

    // ========================================================================
    // CATÁLOGOS Y DATOS MAESTROS
    // ========================================================================
    Route::prefix('catalogos')->name('api.v1.catalogos.')->group(function () {
        // Aduanas
        Route::get('/aduanas', function () {
            $aduanas = \App\Models\AduanaChile::where('estado', 'Activo')
                ->orderBy('codigo')
                ->get(['id', 'codigo', 'nombre_aduana']);
            return response()->json(['success' => true, 'data' => $aduanas]);
        })->name('aduanas');

        // Tipos de contenedor
        Route::get('/tipos-contenedor', function () {
            $tipos = \App\Models\TipoContenedor::where('estado', 'Activo')
                ->orderBy('codigo')
                ->get(['id', 'codigo', 'descripcion', 'tamano']);
            return response()->json(['success' => true, 'data' => $tipos]);
        })->name('tipos-contenedor');

        // Empresas transportistas
        Route::get('/empresas-transportistas', function () {
            $empresas = \App\Models\EmpresaTransportista::where('estado', 'Activo')
                ->orderBy('nombre_empresa')
                ->get(['id', 'rut', 'nombre_empresa']);
            return response()->json(['success' => true, 'data' => $empresas]);
        })->name('empresas-transportistas');

        // Lugares de depósito
        Route::get('/lugares-deposito', function () {
            $lugares = \App\Models\LugarDeposito::where('estado', 'Activo')
                ->orderBy('nombre_deposito')
                ->get(['id', 'codigo', 'nombre_deposito', 'direccion']);
            return response()->json(['success' => true, 'data' => $lugares]);
        })->name('lugares-deposito');
    });

    // ========================================================================
    // ESTADÍSTICAS Y REPORTES
    // ========================================================================
    Route::prefix('estadisticas')->name('api.v1.estadisticas.')->group(function () {
        // Resumen general
        Route::get('/resumen', function () {
            $tatcs = \App\Models\Tatc::count();
            $tstcs = \App\Models\Tstc::count();
            $salidas = \App\Models\Salida::count();
            $tatcsVigentes = \App\Models\Tatc::whereNotIn('estado', ['Cancelado', 'Con Salida', 'Vencido'])->count();
            
            return response()->json([
                'success' => true,
                'data' => [
                    'total_tatc' => $tatcs,
                    'total_tstc' => $tstcs,
                    'total_salidas' => $salidas,
                    'tatc_vigentes' => $tatcsVigentes
                ]
            ]);
        })->name('resumen');

        // TATCs por estado
        Route::get('/tatc-por-estado', function () {
            $porEstado = \App\Models\Tatc::selectRaw('estado, COUNT(*) as total')
                ->groupBy('estado')
                ->get();
            return response()->json(['success' => true, 'data' => $porEstado]);
        })->name('tatc-por-estado');

        // TATCs próximos a vencer
        Route::get('/tatc-proximos-vencer', function () {
            $tatcs = \App\Models\Tatc::whereNotIn('estado', ['Cancelado', 'Con Salida'])
                ->whereRaw('DATE_ADD(created_at, INTERVAL 335 DAY) <= NOW()')
                ->whereRaw('DATE_ADD(created_at, INTERVAL 1 YEAR) > NOW()')
                ->orderBy('created_at', 'asc')
                ->limit(20)
                ->get();
            
            return response()->json([
                'success' => true,
                'data' => $tatcs->map(function ($tatc) {
                    return [
                        'tatc_id' => $tatc->id,
                        'numero_tatc' => $tatc->numero_tatc,
                        'numero_contenedor' => $tatc->numero_contenedor,
                        'dias_restantes' => $tatc->dias_restantes,
                        'fecha_vencimiento' => $tatc->fecha_vencimiento->format('Y-m-d')
                    ];
                })
            ]);
        })->name('tatc-proximos-vencer');
    });

});

