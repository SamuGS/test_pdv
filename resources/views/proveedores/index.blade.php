@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Card para el botón Agregar Proveedor-->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Listado de Proveedores</h2>
            <a href="{{ route('proveedores.create') }}" class="btn btn-success">Agregar Proveedores</a>
        </div>
    </div>
    <!-- Card para la tabla de Proveedores -->
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Correo Electrónico</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proveedores as $proveedores)
                    <tr>
                        <td>{{ $proveedores->id }}</td>
                        <td>{{ $proveedores->nombre }}</td>
                        <td>{{ $proveedores->direccion }}</td>
                        <td>{{ $proveedores->telefono }}</td>
                        <td>{{ $proveedores->email}}</td>
                        <td>{{ $proveedores->estado }}</td>
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