<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
<<<<<<< Updated upstream
=======
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolePermissionController;
use Spatie\Permission\Contracts\Role;
use App\Http\Controllers\ClienteController;
>>>>>>> Stashed changes

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//TODO LO QUE YA NECESITE LOGUEARSE IRIA AQUI
Route::middleware('auth')->group(function () {

    //ADMINISTRACION DE PERFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //ADMINISTRACION DE USUARIOS
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    //ADMINISTRACION DE CATEGORIAS
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index'); // Listar categorias
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create'); // Crear categoria
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store'); // Guardar categoria
    Route::get('/categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit'); // Vista/Editar categoria
    Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update'); // Actualizar categoria
    Route::delete('/categorias/{id}', [CategoriaController::class, 'desactivando'])->name('categorias.destroy'); // Eliminar categoria
<<<<<<< Updated upstream
=======

    //ADMINISTRACION DE PROVEEDORES
    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index'); // Listar proveedores

     //ADMINISTRACION DE CLIENTES
     Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index'); // Listar clientes
     Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create'); // Crear cliente
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store'); // Guardar cliente
>>>>>>> Stashed changes
});

require __DIR__.'/auth.php';
