@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Card para el botón Agregar clientes -->
    <div class="card cardModulo">
        <div class="encabezadoModulo">
            <h2 class="mb-0">Lista de clientes</h2>
            <a href="{{ route('clientes.create') }}" class="btn botonNuevo"><i class="bi bi-plus-circle"></i>Agregar cliente</a>
        </div>
    </div>
    <!-- Card para la tabla de usuarios -->
    <div class="card">
        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
         <table class="tablaPersonalizada">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Estado</th>
                        <th class="acciones">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $clientes)
                    <tr>
                        <td>{{ $clientes->id }}</td>
                        <td>{{ $clientes->nombre }}</td>
                        <td>{{ $clientes->telefono }}</td>
                        <td>{{ $clientes->direccion }}</td>
                        <td>{{ $clientes->estado == '1' ? 'Activado' : 'Desactivado' }}</td>
                        <td class="acciones">
                            <a href="{{ route('clientes.edit', $clientes->id) }}" class="btn botonAcciones boton1"><i class="bi bi-pencil-square"></i> Actualizar</a>
                            <form action="{{ route('clientes.desactivando', $clientes->id) }}" method="POST" style="display:inline;" id="form-estado-{{ $clientes->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn botonAcciones boton2 {{ $clientes->estado == 1 ? 'btn-danger' : 'btn-success' }}" id="btn-estado-{{ $clientes->id }}">
                                    <i class="bi {{ $clientes->estado == 1 ? 'bi-x-circle' : 'bi-check-circle' }}"></i>
                                    {{ $clientes->estado == 1 ? 'Desactivar' : 'Activar' }}
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