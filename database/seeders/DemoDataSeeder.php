<?php

namespace Database\Seeders;

use App\Models\AduanaChile;
use App\Models\Contenedor;
use App\Models\EmpresaTransportista;
use App\Models\LugarDeposito;
use App\Models\Operador;
use App\Models\Tatc;
use App\Models\Ticket;
use App\Models\TipoContenedor;
use App\Models\Tstc;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'ver tickets',
            'editar tickets',
            'ver logistica',
            'crear logistica',
            'editar logistica',
            'eliminar logistica',
            'ver inventario',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $operarioRole = Role::firstOrCreate(['name' => 'operario', 'guard_name' => 'web']);

        $superAdminRole->syncPermissions(Permission::all());
        $adminRole->syncPermissions(Permission::all());
        $operarioRole->syncPermissions(['ver tickets', 'ver logistica', 'ver inventario']);

        $operador = Operador::firstOrCreate(
            ['rut_operador' => '76666087-8'],
            [
                'codigo' => 'S46',
                'nombre_operador' => 'Contenedores Pricer Demo E.I.R.L.',
                'nombre_fantasia' => 'PRICER DEMO',
                'direccion_operador' => 'Av. Providencia 1234, Santiago',
                'resolucion_operador' => 'Res. Nro. 2635 del 26/08/2020',
                'rut_representante' => '12345678-9',
                'nombre_representante' => 'Administrador Demo',
                'cargo_representante' => 'Gerente General',
                'estado' => 'Activo',
                'fecha_creacion' => now(),
                'nombre_remitente' => 'PRICER DEMO',
                'email_remitente' => 'demo@pricer.cl',
                'valida_ingreso_aduana' => true,
                'email_notificaciones' => 'demo@pricer.cl',
            ]
        );

        $superAdmin = User::updateOrCreate(
            ['email' => 'superadmin@pricer.cl'],
            [
                'name' => 'Super Administrador',
                'password' => Hash::make('pricer123'),
                'email_verified_at' => now(),
                'operador_id' => $operador->id,
                'rut_usuario' => '12345678-9',
                'estado' => 'Activo',
                'ultimo_movimiento' => now(),
                'cambio_password_requerido' => false,
            ]
        );
        $superAdmin->syncRoles([$superAdminRole]);

        $admin = User::updateOrCreate(
            ['email' => 'admin@pricer.cl'],
            [
                'name' => 'Administrador Demo',
                'password' => Hash::make('pricer123'),
                'email_verified_at' => now(),
                'operador_id' => $operador->id,
                'rut_usuario' => '10958991-8',
                'estado' => 'Activo',
                'ultimo_movimiento' => now(),
                'cambio_password_requerido' => false,
            ]
        );
        $admin->syncRoles([$adminRole]);

        $operador->update(['usuario_id' => $admin->id]);

        $this->call(CompanySeeder::class);

        $transportista = EmpresaTransportista::firstOrCreate(
            ['rut_empresa' => '14275360-K'],
            [
                'nombre_empresa' => 'Transportes Demo SpA',
                'direccion' => 'Calle Demo 123',
                'ciudad' => 'Santiago',
                'telefono' => '987456321',
                'email' => 'transporte@pricer.cl',
                'contacto_persona' => 'Juan Transporte',
                'estado' => 'Activo',
            ]
        );

        $aduanas = [
            ['codigo' => '34', 'nombre_aduana' => 'Valparaíso', 'region' => 'Valparaíso'],
            ['codigo' => '39', 'nombre_aduana' => 'San Antonio', 'region' => 'San Antonio'],
            ['codigo' => '48', 'nombre_aduana' => 'Santiago', 'region' => 'Santiago'],
        ];

        foreach ($aduanas as $aduana) {
            AduanaChile::firstOrCreate(
                ['codigo' => $aduana['codigo']],
                array_merge($aduana, ['estado' => 'Activo'])
            );
        }

        $tipos = [
            ['codigo' => 'DRY', 'descripcion' => 'Dry (Seco)'],
            ['codigo' => 'HC', 'descripcion' => 'High Cube'],
            ['codigo' => 'REE', 'descripcion' => 'Reefer (Refrigerado)'],
        ];

        foreach ($tipos as $tipo) {
            TipoContenedor::firstOrCreate(
                ['codigo' => $tipo['codigo']],
                array_merge($tipo, ['estado' => 'Activo', 'operador_id' => $operador->id])
            );
        }

        $depositos = [
            ['codigo' => '01', 'nombre_deposito' => 'Depósito Valparaíso', 'ciudad' => 'Valparaíso'],
            ['codigo' => '02', 'nombre_deposito' => 'Depósito San Antonio', 'ciudad' => 'San Antonio'],
        ];

        foreach ($depositos as $deposito) {
            LugarDeposito::firstOrCreate(
                ['codigo' => $deposito['codigo']],
                array_merge($deposito, [
                    'operador_id' => $operador->id,
                    'estado' => 'Activo',
                    'region' => 'Valparaíso',
                ])
            );
        }

        $tipoDry = TipoContenedor::where('codigo', 'DRY')->first();
        $deposito = LugarDeposito::where('codigo', '01')->first();
        $aduana = AduanaChile::where('codigo', '34')->first();

        $contenedores = [
            'PRIC0000001',
            'PRIC0000002',
            'PRIC0000003',
        ];

        foreach ($contenedores as $numero) {
            Contenedor::firstOrCreate(
                ['numero_contenedor' => $numero],
                [
                    'estado_contenedor' => 'OP',
                    'estado' => 'Activo',
                    'tipo_contenedor_id' => $tipoDry?->id,
                    'tamano_contenedor' => '40',
                    'fecha_ingreso' => now()->toDateString(),
                    'lugardeposito_id' => $deposito?->id,
                    'aduana_ingreso_id' => $aduana?->id,
                    'operador_id' => $operador->id,
                ]
            );
        }

        Tatc::firstOrCreate(
            ['numero_tatc' => '34246000001'],
            [
                'numero_contenedor' => 'PRIC0000001',
                'tipo_contenedor' => 'DRY',
                'tipo_ingreso' => 'traspaso',
                'ingreso_pais' => now()->subMonths(2),
                'ingreso_deposito' => now()->subMonths(1),
                'fecha_traspaso' => now()->subMonth()->toDateString(),
                'tara_contenedor' => '3660',
                'tipo_bulto' => '74',
                'valor_fob' => 2000,
                'aduana_ingreso' => '39',
                'tamano_contenedor' => '40',
                'puerto_ingreso' => 'SAN ANTONIO',
                'estado_contenedor' => 'OP',
                'anio_fabricacion' => '2015',
                'ubicacion_fisica' => 'Depósito San Antonio',
                'valor_cif' => 2140,
                'empresa_transportista_id' => $transportista->id,
                'estado' => 'Pendiente',
                'user_id' => $admin->id,
            ]
        );

        Tatc::firstOrCreate(
            ['numero_tatc' => '34246000002'],
            [
                'numero_contenedor' => 'PRIC0000002',
                'tipo_contenedor' => 'HC',
                'tipo_ingreso' => 'traspaso',
                'ingreso_pais' => now()->subMonths(3),
                'ingreso_deposito' => now()->subMonths(2),
                'fecha_traspaso' => now()->subMonths(2)->toDateString(),
                'tara_contenedor' => '3830',
                'tipo_bulto' => '74',
                'valor_fob' => 1350,
                'aduana_ingreso' => '34',
                'tamano_contenedor' => '40',
                'puerto_ingreso' => 'Valparaíso',
                'estado_contenedor' => 'OP',
                'anio_fabricacion' => '2012',
                'ubicacion_fisica' => 'Depósito Valparaíso',
                'valor_cif' => 1444.5,
                'estado' => 'Pendiente',
                'user_id' => $admin->id,
            ]
        );

        Tstc::firstOrCreate(
            ['numero_tstc' => '34246000001'],
            [
                'operador_id' => $operador->id,
                'fecha_emision_tstc' => now()->subWeeks(2)->toDateString(),
                'numero_contenedor' => 'PRIC0000003',
                'tipo_contenedor' => 'DRY',
                'destino_contenedor' => 'Exportación',
                'valor_fob' => 1800,
                'tara_contenedor' => 3600,
                'ingreso_deposito' => now()->subMonth()->toDateString(),
                'aduana_salida' => '34',
                'fecha_salida_pais' => now()->subWeek(),
                'tamano_contenedor' => '40',
                'estado_contenedor' => 'OP',
                'codigo_tipo_bulto' => '74',
                'anio_fabricacion' => '2014',
                'empresa_transportista_id' => $transportista->id,
                'estado' => 'Pendiente',
                'user_id' => $admin->id,
            ]
        );

        Ticket::firstOrCreate(
            ['titulo' => 'Ticket de prueba - Sistema Demo'],
            [
                'descripcion' => 'Ticket generado automáticamente para demostración del sistema.',
                'estado' => 'nuevo',
                'user_id' => $admin->id,
            ]
        );
    }
}
