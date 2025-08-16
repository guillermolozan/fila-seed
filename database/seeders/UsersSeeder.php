<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario Visor (solo lectura)
        $visor = User::create([
            'name' => 'visor',
            'email' => 'visor@example.com',
            'password' => Hash::make('visor123'),
            'email_verified_at' => now(),
        ]);

        $visorRole = Role::where('name', 'visor')->first();
        if ($visorRole) {
            $visor->assignRole($visorRole);
            $this->command->info('Usuario visor creado: visor@example.com (password: visor123)');
        }

        // Usuario Product Manager
        $editor = User::create([
            'name' => 'product',
            'email' => 'product@example.com',
            'password' => Hash::make('product123'),
            'email_verified_at' => now(),
        ]);

        $productRole = Role::where('name', 'editor')->first();
        if ($productRole) {
            $editor->assignRole($productRole);
            $this->command->info('Usuario product manager creado: product@example.com (password: product123)');
        }
    }
}
