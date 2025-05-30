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

            //Permisos proveedores
            'Ver proveedores',
            'Editar proveedores',
            'Crear proveedores',
            'Eliminar proveedores',

            //Permisos clientes
            'Ver clientes',
            'Editar clientes',
            'Crear clientes',
            'Eliminar clientes',
            
            //Permisos categorias
            'Ver categorias',
            'Editar categorias',
            'Crear categorias',
            'Eliminar categorias',            

            //Permisos productos
            'Ver productos',
            'Editar productos',
            'Crear productos',
            'Eliminar productos',                                                            

            //Permisos compras
            'Ver compras',
            'Editar compras',
            'Crear compras',
            'Eliminar compras',

            //Permisos ventas
            'Ver ventas',
            'Editar ventas',
            'Crear ventas',
            'Eliminar ventas',

            //Permisos facturacion
            'Ver facturacion',
            'Editar facturacion',
            'Crear facturacion',
            'Eliminar facturacion',

            //Permisos inventario
            'Ver inventarios',
            'Editar inventarios',
            'Crear inventarios',
            'Eliminar inventarios',

            //Permisos reportes
            'Ver reportes',
            'Editar reportes',
            'Crear reportes',
            'Eliminar reportes',

            //Permisos respaldo            
            'Crear respaldos',            
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
