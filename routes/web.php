<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\ProductoController;
use App\Models\Proveedores;
use Spatie\Permission\Contracts\Role;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//TODO LO QUE YA NECESITE LOGUEARSE IRIA AQUI
Route::middleware('auth')->group(function () {
    //RUTAS DEL DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

    //ADMINISTRACIONES DE ROLES Y PERMISOS
    Route::get('/roles', [RolePermissionController::class, 'index'])->name('roles.index');
    Route::post('/roles', [RolePermissionController::class, 'store'])->name('roles.store');
    Route::post('/roles/assign', [RolePermissionController::class, 'assignRoleToUser'])->name('roles.assign');

    //ADMINISTRACION DE PERFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //ADMINISTRACION DE USUARIOS
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); // Crear usuario
    Route::post('/users', [UserController::class, 'store'])->name('users.store'); // Guardar usuario
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


     //ADMINISTRACION DE CLIENTES
     Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index'); // Listar clientes
     Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create'); // Crear cliente
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store'); // Guardar cliente

    //ADMINISTRACION DE PROVEEDORES
    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index'); // Listar proveedores
    Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create'); // Crear proveedores
    Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store'); // Guardar proveedores

    //ADMINISTRACION DE PRODUCTOS
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index'); // Listar productos
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create'); // Crear producto
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store'); // Guardar producto
    Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit'); // Vista/Editar producto
    Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update'); // Actualizar producto
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy'); // Eliminar producto

    // Productos
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    Route::delete('/productos/{id}', [ProductoController::class, 'desactivando'])->name('productos.desactivando'); 
    Route::get('/productos/buscar', [ProductoController::class, 'buscar'])->name('productos.buscar');

});

require __DIR__.'/auth.php';
