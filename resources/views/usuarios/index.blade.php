@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Card para el botón Agregar Usuario -->
    <div class="card cardModulo">
        <div class="encabezadoModulo">
            <h2 class="mb-0">Listado de Usuarios</h2>
            <a href="{{ route('users.create') }}" class="btn botonNuevo">
                <i class="bi bi-plus-circle"></i> Agregar Usuario
            </a>
        </div>
    </div>

    <!-- Card para la tabla de usuarios -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="tablaPersonalizada">
                    <thead>
                        <tr>                            
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>                            
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->estado == 1)
                                Activo
                                @else
                                Inactivo
                                @endif
                            </td>
                            <td>
                                @foreach($user->getRoleNames() as $role)
                                    {{ $role }} <!-- Muestra todos los roles del usuario -->
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn botonAcciones boton1">
                                    <i class="bi bi-pencil-square"></i> Actualizar
                                </a>
                            
                                <!-- Formulario para Eliminar -->
                                <form action="{{ route('usuarios.desactivando', $user->id) }}" method="POST" style="display:inline;" id="form-estado-{{ $user->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn botonAcciones boton2 {{ $user->estado == 1 ? 'btn-danger' : 'btn-success' }}" id="btn-estado-{{ $user->id }}">
                                        <i class="bi {{ $user->estado == 1 ? 'bi-x-circle' : 'bi-check-circle' }}"></i>
                                        {{ $user->estado == 1 ? 'Desactivar' : 'Activar' }}
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
</div>
@endsection