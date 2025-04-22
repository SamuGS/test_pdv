<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolePermissionController;

use App\Models\Proveedores;
use Spatie\Permission\Contracts\Role;
use App\Http\Controllers\ProductoController;


// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Ruta del dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Roles y permisos
    Route::get('/roles', [RolePermissionController::class, 'index'])->name('roles.index');
    Route::post('/roles/update-permissions', [RolePermissionController::class, 'updatePermissions'])->name('roles.update.permissions');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Usuarios
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');


    //ADMINISTRACION DE CATEGORIAS
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index'); // Listar categorias
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create'); // Crear categoria
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store'); // Guardar categoria
    Route::get('/categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit'); // Vista/Editar categoria
    Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update'); // Actualizar categoria
    Route::delete('/categorias/{id}', [CategoriaController::class, 'desactivando'])->name('categorias.desactivando'); // Eliminar categoria


    // Clientes
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('clientes.edit'); // Vista/Editar Cliente
    Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update'); // Actualizar Cliente
    Route::delete('/clientes/{id}', [ClienteController::class, 'desactivando'])->name('clientes.desactivando'); // Eliminar cliente

  
    // Proveedores
    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
    Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
    Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
    Route::get('/proveedores/{id}/edit', [ProveedorController::class, 'edit'])->name('proveedores.edit'); // Vista/Editar proveedores
    Route::put('/proveedores/{id}', [ProveedorController::class, 'update'])->name('proveedores.update'); // Actualizar proveedores
    Route::delete('/proveedores/{id}', [ProveedorController::class, 'desactivando'])->name('proveedores.desactivando'); // Eliminar proveedores

    // Productos
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

});

// Rutas de autenticación
require __DIR__.'/auth.php';
