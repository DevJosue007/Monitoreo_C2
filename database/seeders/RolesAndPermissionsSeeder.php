<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Se limpia la cache de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //CREACIÓN DE PERMISOS BÁSICOS
 
        // 1. Se crea el guard para referenciar el tipo de permiso
        $guard = 'web';

        // 2. Se crean los permisos especificando el tipo
        // Reportes
        Permission::create(['name' => 'ver_reportes',     'guard_name' => $guard]);
        Permission::create(['name' => 'crear_reportes',   'guard_name' => $guard]);
        Permission::create(['name' => 'editar_reportes',  'guard_name' => $guard]);
        Permission::create(['name' => 'eliminar_reportes','guard_name' => $guard]);
        // usuarios
        Permission::create(['name' => 'ver_usuarios',     'guard_name' => $guard]);
        Permission::create(['name' => 'crear_usuarios',   'guard_name' => $guard]);
        Permission::create(['name' => 'editar_usuarios',  'guard_name' => $guard]);
        Permission::create(['name' => 'eliminar_usuarios','guard_name' => $guard]);
        // Catalogos
        Permission::create(['name' => 'ver_catalogos',     'guard_name' => $guard]);
        Permission::create(['name' => 'crear_catalogos',   'guard_name' => $guard]);
        Permission::create(['name' => 'editar_catalogos',  'guard_name' => $guard]);
        Permission::create(['name' => 'eliminar_catalogos','guard_name' => $guard]);


        // 3. Obtener los permisos creados ya que se guardan en un contexto diferente y no se pueden acceder directamente para su asignación a usuarios:
        // reportes
        $verReportes = Permission::where('name', 'ver_reportes')->first();
        $crearReportes = Permission::where('name', 'crear_reportes')->first();
        $editarReportes = Permission::where('name', 'editar_reportes')->first();
        $eliminarReportes = Permission::where('name', 'eliminar_reportes')->first();
        //Usuarios
        $verUsuarios = Permission::where('name', 'ver_usuarios')->first();
        $crearUsuarios = Permission::where('name', 'crear_usuarios')->first();
        $editarUsuarios = Permission::where('name', 'editar_usuarios')->first();
        $eliminarUsuarios = Permission::where('name', 'eliminar_usuarios')->first();
        // Catalogos
        $verCatalogos = Permission::where('name', 'ver_catalogos')->first();
        $crearCatalogos = Permission::where('name', 'crear_catalogos')->first();
        $editarCatalgos = Permission::where('name', 'editar_catalogos')->first();
        $eliminarCatalogos = Permission::where('name', 'eliminar_catalogos')->first();

        // 4. Creación de roles principales especificando el tipo
              // Rol Operador Admin
        $operadorR3 = Role::create(['name' => 'r_1_operador' , 'guard_name' => $guard]);
        $operadorR3->syncPermissions([$verReportes, $crearReportes, $editarReportes, $eliminarReportes]);
        
        // Rol Operador funcional
        $operadorR2 = Role::create(['name' => 'r_2_operador', 'guard_name' => $guard]);
        $operadorR2->syncPermissions([$verReportes, $crearReportes]);

        // Rol Operador solo lectura
        $operadorR1 = Role::create(['name' => 'r_3_operador', 'guard_name' => $guard]);
        $operadorR1->syncPermissions([ $verReportes ]);

        // Rol Administrador
        $adminR = Role::create(['name' => 'r_admin', 'guard_name' => $guard]);
        $allWebPermissions = Permission::where('guard_name', $guard)->get();
        $adminR->syncPermissions($allWebPermissions);
    
        // Se vuelve a limpiar la cáche después de la creación
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    }
}
