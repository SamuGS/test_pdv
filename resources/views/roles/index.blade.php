@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Gestión de Roles y Permisos</h2>

        <!-- Crear un nuevo rol -->
        <form action="{{ route('roles.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="role" class="form-label">Nombre del Rol</label>
                <input type="text" class="form-control" id="role" name="role" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear Rol</button>
        </form>

        <!-- Tabla de roles -->
        <h3 class="mb-4">Listado de Roles</h3>
        <table class="table table-striped table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <hr class="my-4">

        <!-- Asignar un rol a un usuario -->
        <h3 class="mb-4">Asignar Rol a Usuario</h3>
        <form action="{{ route('roles.assign') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">Usuario</label>
                <select class="form-control" id="user_id" name="user_id" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Rol</label>
                <select class="form-control" id="role" name="role" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Asignar Rol</button>
        </form>
    </div>
@endsection