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
                <a href="{{ route('productos.create') }}" class="btn botonNuevo">
                    <i class="bi bi-plus-circle"></i> Agregar Producto
                </a>
            </div>
        </div>
    </div>

    <!-- Card para la tabla de productos -->
    <div class="card">
<<<<<<< Updated upstream
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th> <!-- Nueva columna -->
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Categoría</th>
                            <th>Proveedor</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>
                                @if ($producto->imagen)
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen del producto" width="50">
                                @else
                                    Sin imagen
                                @endif
                            </td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->descripcion }}</td>
                            <td>{{ $producto->precio }}</td>
                            <td>{{ $producto->stock }}</td>
                            <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                            <td>{{ $producto->proveedor->nombre ?? 'Sin proveedor' }}</td>
                            <td>{{ $producto->estado ? 'Activo' : 'Inactivo' }}</td>
                            <td>
                                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
=======

        <div class="card-body" style="max-height: 400px; overflow-y: auto; white-space: normal;" id="resultados-productos">
            @include('productos.tabla', ['productos' => $productos])

>>>>>>> Stashed changes
        </div>
        {{ $productos->appends(['buscar' => request('buscar')])->links('vendor.pagination.bootstrap-5') }}

    </div>
</div>
@endsection
<<<<<<< Updated upstream
=======

@vite('resources/js/productos_busqueda.js')

@yield('page_js')
>>>>>>> Stashed changes
