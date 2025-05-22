@extends('layouts.app')

@section('content')

<div class="container">
    <!-- Card para el botón Agregar Producto -->
    <div class="card cardModulo">
        <div class="encabezadoModulo">
            <h2 class="mb-0">Todos los Productos</h2>
            <!-- Contenedor para el campo de búsqueda y el botón -->
            <div class="d-flex align-items-center">
                <!-- Campo de búsqueda -->
                <div class="input-group mr-2" style="flex-grow: 1; max-width: 250px;">
                    <span class="input-group-text rounded-start-pill"><i class="bi bi-search"></i></span>
                    <input type="text" id="live-search" class="form-control" placeholder="Buscar productos...">
                </div>
                <!-- Botón de Agregar Producto -->
                @can('Crear productos')
                <a href="{{ route('productos.create') }}" class="btn botonNuevo">
                    <i class="bi bi-plus-circle"></i> Agregar Producto
                </a>
                @endcan
            </div>
        </div>
    </div>

    <!-- Card para la tabla de productos -->
    <div class="card">


        <div class="card-body" style="overflow-y: auto; white-space: normal;" id="resultados-productos">
            @include('productos.tabla', ['productos' => $productos])
        </div>
        {{ $productos->appends(['buscar' => request('buscar')])->links('vendor.pagination.bootstrap-5') }}

    </div>
</div>
@endsection

@vite('resources/js/productos_busqueda.js')

@yield('page_js')

