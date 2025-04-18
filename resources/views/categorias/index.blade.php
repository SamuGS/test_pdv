@extends('layouts.app')

@section('content')
<<<<<<< Updated upstream
    <div class="container">
        <h2 class="mb-4">Listado de Categorías</h2>

        <table class="table table-striped table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>    
                    <th>ID</th>                            
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
=======
<div class="container">
    <!-- Card para el botón Agregar Categoria -->
    <div class="card cardModulo">
    <div class="encabezadoModulo">
        <h2 class="mb-0">Listado de Categorías</h2>
        <a href="{{ route('categorias.create') }}" class="btn botonNuevo">
            <i class="bi bi-plus-circle"></i> Agregar Categoría
        </a>
    </div>
    <div class="card-body">
        <!-- tabla o contenido -->
    </div>
</div>

    <!-- Card para la tabla de usuarios -->
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered table-hover text-center">
                <thead class="table-dark">
>>>>>>> Stashed changes
                    <tr>
                        <td>{{ $categoria->id }}</td>                                    
                        <td>{{ $categoria->nombre }}</td>
<<<<<<< Updated upstream
                        <td>{{ $categoria->estado }}</td>                                    
=======
                        <td>{{ $categoria->estado == '1' ? 'Activado' : 'Desactivado' }}</td>

>>>>>>> Stashed changes
                        <td>
                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn botonAcciones boton1">
                            <i class="bi bi-pencil-square"></i> Actualizar
                        </a>


                        <form action="{{ route('categorias.desactivando', $categoria->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn botonAcciones boton2 {{ $categoria->estado == 1 ? 'btn-danger' : 'btn-success' }}">
                                <i class="bi {{ $categoria->estado == 1 ? 'bi-x-circle' : 'bi-check-circle' }}"></i>
                                {{ $categoria->estado == 1 ? 'Desactivar' : 'Activar' }}
                            </button>
                        </form>



                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('categorias.create') }}" class="btn btn-success mt-3">Agregar Categoría</a>
    </div>
@endsection
