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
            'email' => 'dev.josue.007@gmail.com',
            'password' => Hash::make('12345'),
        ]); 
        $admin->assignRole('admin');
    }
}
