@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Card para el botón Agregar Usuario -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Listado de Usuarios</h2>
                <a href="{{ route('users.create') }}" class="btn btn-success">Agregar Usuario</a>
            </div>
        </div>

        <!-- Card para la tabla de usuarios -->
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover text-center">
                    <thead class="table-dark">
                        <tr> 
                            <th>N°</th>   
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
                                <td>{{ $user->id }}</td>                                
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
                                    @if ($user->roles->isNotEmpty())
                                        {{ $user->roles->pluck('name')->join(', ') }}
                                    @else
                                        Sin rol
                                    @endif
                                </td>          
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
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
