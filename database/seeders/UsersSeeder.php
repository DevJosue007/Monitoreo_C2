<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Se crean usuarios iniciales: un admin y varios operadores 
        $admin = User::create([
            'name' => 'Admin. Monitoreo',
            'email' => 'admin@monitoreo.com',
            'password' => Hash::make('12345'),
        ]); 
        $admin->assignRole('r_admin');

        $operator = User::create([
            'name' => 'Operador Admin',
            'email' => 'operador_r1@monitoreo.com',
            'password' => Hash::make('12345'),
        ]);
        $operator->assignRole('r_1_operador');

        $operator = User::create([
            'name' => 'Operador Funcional',
            'email' => 'operador_r2@monitoreo.com',
            'password' => Hash::make('12345'),
        ]);
        $operator->assignRole('r_2_operador');

        $operator = User::create([
            'name' => 'Operador Funcional',
            'email' => 'operador_r3@monitoreo.com',
            'password' => Hash::make('12345'),
        ]);
        $operator->assignRole('r_3_operador');

    }
}
