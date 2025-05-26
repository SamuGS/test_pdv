@extends('layouts.app')

@section('content')

<div class="container">
    <!-- Card para el botón Agregar Categoria -->
    <div class="card cardModulo">
        <div class="encabezadoModulo">
            <h2 class="mb-0">Listado de Categorías</h2>
            @can('Crear categorias')
            <a href="{{ route('categorias.create') }}" class="btn botonNuevo">
                <i class="bi bi-plus-circle"></i> Agregar Categoría
            </a>
            @endcan
        </div>
    </div>

    <!-- Card para la tabla de categorías -->
    <div class="card">
        <div class="card-body" style="overflow-y: auto;">
            <table class="tablaPersonalizada">
                <thead>
                    <tr>                        
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th class="acciones">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorias as $categoria)
                    <tr>                        
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->estado == '1' ? 'Activado' : 'Desactivado' }}</td>
                        <td class="acciones">
                            @can('Editar categorias')
                            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn botonAcciones boton1">
                                <i class="bi bi-pencil-square"></i> Actualizar
                            </a>
                            @endcan

                            @can('Eliminar categorias')
                            <form action="{{ route('categorias.desactivando', $categoria->id) }}" method="POST" style="display:inline;" id="form-estado-{{ $categoria->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn botonAcciones boton2 {{ $categoria->estado == 1 ? 'btn-danger' : 'btn-success' }}" id="btn-estado-{{ $categoria->id }}">
                                    <i class="bi {{ $categoria->estado == 1 ? 'bi-x-circle' : 'bi-check-circle' }}"></i>
                                    {{ $categoria->estado == 1 ? 'Desactivar' : 'Activar' }}
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
