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
        // Crear permisos
        $permissions = [
            //Permisos categorias
            'Ver categorias',
            'Editar categorias',
            'Crear categorias',
            'Eliminar categorias',

            //Permisos usuarios
            'Ver usuarios',
            'Editar usuarios',
            'Crear usuarios',
            'Eliminar usuarios',

            //Permisos roles
            'Ver roles',
            'Editar roles',
            'Crear roles',
            'Eliminar roles', 
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
