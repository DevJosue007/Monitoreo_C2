<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Se limpia la cache de los permisos entre la ejecución de seeders 
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Se llama primero al seeder de roles/permisos 
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        // Se limpia la cache de los permisos entre la ejecución de seeders 
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Se llama al seeder para crear los usuarios y asignar los roles creados previamente
        $this->call([
            UsersSeeder::class,
        ]);

        $this->call([
            CatalogItemSeeder::class,
        ]);


        /*
        // User::factory(10)->create();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/


    }
}
