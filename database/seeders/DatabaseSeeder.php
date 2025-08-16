<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // 1. Sistema y Usuarios
            RolesAndPermissionsSeeder::class,  // Primero crear roles y permisos
            AdminUserSeeder::class,            // Luego crear usuario admin
            UsersSeeder::class,            // Crear usuarios de prueba
        ]);
    }
}
