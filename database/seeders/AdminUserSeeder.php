<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear o encontrar el rol admin
        $adminRole = Role::firstOrCreate(['name' => 'Administrador']);

        // Obtener todos los permisos existentes
        $allPermissions = Permission::all();

        // Asignar todos los permisos al rol
        $adminRole->syncPermissions($allPermissions);

        // Crear el usuario admin si no existe
        $admin = User::firstOrCreate(
            ['email' => 'administrador@gmail.com'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('admin1234'),
            ]
        );

        // Asignar rol
        if (!$admin->hasRole('Administrador')) {
            $admin->assignRole($adminRole);
        }
    }
}
