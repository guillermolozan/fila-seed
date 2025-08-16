<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario super administrador
        $admin = User::create([
            'name' => 'super',
            'email' => 'guillermolozan@gmail.com',
            'password' => Hash::make('Administrador159357$$'),
            'email_verified_at' => now(),
        ]);

        $this->command->info('Usuario super administrador creado: ' . $admin->email);

        // Asignar rol super_admin
        $role = Role::where('name', 'super_admin')->first();
        if ($role) {
            $admin->assignRole($role);
            $this->command->info('Rol super_admin asignado al usuario.');
        } else {
            $this->command->warn('Rol super_admin no encontrado. Asegúrate de ejecutar RolesAndPermissionsSeeder primero.');
        }
    }
}
