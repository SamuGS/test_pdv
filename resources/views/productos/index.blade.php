@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Card para el botón Agregar Producto -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Listado de Productos</h2>
            <a href="{{ route('productos.create') }}" class="btn btn-success">Agregar Producto</a>
        </div>
    </div>

    <!-- Card para la tabla de productos -->
    <div class="card">
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
        </div>
    </div>
</div>
@endsection
