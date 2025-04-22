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
        //Llamando al seeder para crear permisos y roles
        $this->call(RolesAndPermissionsSeeder::class);

        //Llamando al seeder para crear usuario admin
        $this->call(AdminUserSeeder::class);        
    }
}
