@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Card para el botón Agregar ventas -->
    <div class="card cardModulo">
        <div class="encabezadoModulo">
            <h2 class="mb-0">Todas las ventas</h2>
            <!-- Contenedor para el campo de búsqueda y el botón -->
            <div class="d-flex align-items-center">
                <!-- Campo de búsqueda -->
                <div class="input-group mr-2" style="flex-grow: 1; max-width: 250px;">
                    <span class="input-group-text rounded-start-pill"><i class="bi bi-search"></i></span>
                    <input type="text" id="live-search" class="form-control" placeholder="Buscar ventas...">
                </div>
                <!-- Botón de Agregar ventas -->
                <a href="{{ route('ventas.create') }}" class="btn botonNuevo">
                    <i class="bi bi-plus-circle"></i> Nueva Venta
                </a>
            </div>
        </div>
    </div>

    <!-- Aquí mostrar una tabla de ventas anteriores -->
    <div class="card">


        <div class="card-body" style="max-height: 400px; overflow-y: auto; white-space: normal;" id="resultados-productos">
            @include('ventas.tabla', ['ventas' => $ventas])
        </div>
        {{ $ventas->appends(['buscar' => request('buscar')])->links('vendor.pagination.bootstrap-5') }}

    </div>
</div>
@endsection
