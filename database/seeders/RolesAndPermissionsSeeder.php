<?php

namespace Database\Seeders;

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
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        // Crear permisos para roles y usuarios (sistema)
        $allPermissions = [
            'view_role', 'view_any_role', 'create_role', 'update_role', 'delete_role', 'delete_any_role',
            'view_user', 'view_any_user', 'create_user', 'update_user', 'delete_user', 'delete_any_user',
        ];

        // Crear todos los permisos
        foreach ($allPermissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $this->command->info('Permisos creados: ' . count($allPermissions));

        // Crear roles
        $superAdminRole = Role::create(['name' => 'super_admin']);
        $visorRole = Role::create(['name' => 'visor']);
        $editorRole = Role::create(['name' => 'editor']);


        $this->command->info('Roles creados: super_admin, visor, editor');

        // Asignar permisos a super_admin (todos los permisos)
        $superAdminRole->givePermissionTo($allPermissions);

        // Asignar permisos a visor (solo lectura)
        $visorRole->givePermissionTo([
            'view_role', 'view_any_role',
            'view_user', 'view_any_user',
        ]);

        // Asignar permisos a product_manager (lectura + creación/edición, sin eliminación)
        $editorRole->givePermissionTo([
            'view_role', 'view_any_role',
            'view_user', 'view_any_user', 'create_user', 'update_user',
        ]);

        $this->command->info('Permisos asignados a los roles correctamente');
    }
}
