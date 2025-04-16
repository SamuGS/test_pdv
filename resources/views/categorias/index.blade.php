@extends('layouts.app')

@section('content')
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
                    <tr>
                        <td>{{ $categoria->id }}</td>                                    
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->estado }}</td>                                    
                        <td>
                            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('categorias.create') }}" class="btn btn-success mt-3">Agregar Categoría</a>
    </div>
@endsection
