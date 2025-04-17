<?php

namespace Database\Seeders;

use App\Models\User;
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
        // Crear un rol
        $role = Role::create(['name' => 'admin']);

        // Crear un permiso
        $permission = Permission::create(['name' => 'edit articles']);

        // Asignar un permiso al rol
        $role->givePermissionTo($permission);

        // Asignar un rol a un usuario
        $user = User::find(1); // Asegúrate de que el usuario con ID 1 exista
        $user->assignRole('admin');
    }
}
