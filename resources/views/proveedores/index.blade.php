@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Card para el botón Agregar Proveedor-->
    <div class="card cardModulo">
    <div class="encabezadoModulo">
            <h2 class="mb-0">Listado de Proveedores</h2>
            <a href="{{ route('proveedores.create') }}" class="btn botonNuevo"><i class="bi bi-plus-circle"></i>Agregar Proveedores</a>
        </div>
    </div>
    <!-- Card para la tabla de Proveedores -->
    <div class="card">
    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
        <table class="tablaPersonalizada">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Correo Electrónico</th>
                        <th>Estado</th>
                        <th class="acciones">Acciones</th>
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
                        <td>{{ $proveedores->estado == '1' ? 'Activado' : 'Desactivado' }}</td>
                        <td class="acciones">
                            <a href="{{ route('proveedores.edit', $proveedores->id) }}" class="btn botonAcciones boton1"><i class="bi bi-pencil-square"></i>Actualizar</a>
                            <form action="{{ route('proveedores.desactivando', $proveedores->id) }}" method="POST" style="display:inline;" id="form-estado-{{ $proveedores->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn botonAcciones boton2 {{ $proveedores->estado == 1 ? 'btn-danger' : 'btn-success' }}" id="btn-estado-{{ $proveedores->id }}">
                                    <i class="bi {{ $proveedores->estado == 1 ? 'bi-x-circle' : 'bi-check-circle' }}"></i>
                                    {{ $proveedores->estado == 1 ? 'Desactivar' : 'Activar' }}
                                </button>
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