<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\DetalleCompraController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\VentaController;

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
    Route::get('/roles/create', [RolePermissionController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RolePermissionController::class, 'store'])->name('roles.store');
    Route::get('/roles/{id}/edit', [RolePermissionController::class, 'edit'])->name('roles.edit');
    Route::get('/api/roles/{roleId}/permissions', [RolePermissionController::class, 'getPermissionsByRole'])->name('roles.get.permissions');
    Route::put('/roles/{id}/permissions', [RolePermissionController::class, 'updatePermissions'])->name('roles.update.permissions');
    Route::patch('/roles/{role}/toggle', [RolePermissionController::class, 'toggleEstado'])->name('roles.toggleEstado');

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
    Route::delete('users/{id}/desactivando', [UserController::class, 'desactivando'])->name('usuarios.desactivando');


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
    Route::delete('/productos/{id}', [ProductoController::class, 'desactivando'])->name('productos.desactivando');
    Route::get('/productos/buscar', [ProductoController::class, 'buscar'])->name('productos.buscar');



    //Administración de ventas
    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/create', [VentaController::class, 'create'])->name('ventas.create');
    Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
    Route::get('/ventas/{id}/edit', [VentaController::class, 'edit'])->name('ventas.edit');
    Route::post('ventas/catalogo', [VentaController::class, 'catalogo'])->name('ventas.catalogo');
    Route::get('/ventas/catalogo', [VentaController::class, 'mostrarCatalogo'])->name('ventas.catalogo');
    Route::post('/ventas/agregar-producto', [VentaController::class, 'agregarProducto'])->name('ventas.agregarProducto');
    Route::get('/ventas/resumen', [VentaController::class, 'mostrarResumen'])->name('ventas.resumen');
    Route::get('/ventas/tipo', [VentaController::class, 'seleccionarTipo'])->name('ventas.tipo');
    Route::post('/ventas/procesar', [VentaController::class, 'procesarVenta'])->name('ventas.procesar');
    Route::get('ventas/{venta}/abono', [VentaController::class, 'realizarAbono'])->name('ventas.abono');
    Route::get('/ventas/filtrar-productos/{categoria?}', [VentaController::class, 'filtrarPorCategoria']);
    Route::post('/ventas/agregar-al-carrito/{productoId}', [VentaController::class, 'agregarProducto']);
    Route::get('/ventas/ver-carrito', [VentaController::class, 'verCarrito']);
    Route::get('/ventas/eliminar-del-carrito/{productoId}', [VentaController::class, 'eliminarDelCarrito']);

    //ADMINISTRACION DE COMPRAS
    Route::get('/compras', [ComprasController::class, 'index'])->name('compras.index'); // Listar categorias
    Route::get('/compras/create', [ComprasController::class, 'create'])->name('compras.create'); // Crear categoria
    Route::post('/compras', [ComprasController::class, 'store'])->name('compras.store');


    Route::get('/detallecompras/crear/{compra_id}', [DetalleCompraController::class, 'crear'])->name('detallecompras.crear');



});

// Rutas de autenticación
require __DIR__ . '/auth.php';
