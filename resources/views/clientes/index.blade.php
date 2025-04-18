@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Card para el botón Agregar clientes -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Listado de Clientes</h2>
            <a href="{{ route('clientes.create') }}" class="btn btn-success">Agregar Cliente</a>
        </div>
    </div>
    <!-- Card para la tabla de usuarios -->
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $clientes)
                    <tr>
                        <td>{{ $clientes->id }}</td>
                        <td>{{ $clientes->nombre }}</td>
                        <td>{{ $clientes->telefono }}</td>
                        <td>{{ $clientes->direccion }}</td>
                        <td>{{ $clientes->estado }}</td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm">Editar</a>
                            <form action="" method="POST" style="display:inline;">
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
@endsection