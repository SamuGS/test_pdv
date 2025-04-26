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

            //Permisos clientes
            'Ver clientes',
            'Editar clientes',
            'Crear clientes',
            'Eliminar clientes',

            //Permisos productos
            'Ver productos',
            'Editar productos',
            'Crear productos',
            'Eliminar productos',

            //Permisos proveedores
            'Ver proveedores',
            'Editar proveedores',
            'Crear proveedores',
            'Eliminar proveedores',

            //Permisos roles
            'Ver roles',
            'Editar roles',
            'Crear roles',
            'Eliminar roles',

            //Permisos usuarios
            'Ver usuarios',
            'Editar usuarios',
            'Crear usuarios',
            'Eliminar usuarios',
            
            //Permisos dashboard
            'Ver dashboard',
            'Editar dashboard',
            'Crear dashboard',
            'Eliminar dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
