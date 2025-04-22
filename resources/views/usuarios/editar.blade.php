@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Editar Datos del Usuario</h2>
        </div>
        <div class="card-body">
            <!-- Formulario de Actualización -->
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </div>

                <div class="mb-3">
                    <label for="rol" class="form-label">Rol</label>
                    <select class="form-control" id="rol" name="rol" required>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ isset($user) && $user->roles->first() && $user->roles->first()->name == $role->name ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Nueva Contraseña -->
                <div class="mb-3">
                    <label for="password" class="form-label">Nueva Contraseña (opcional)</label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                </div>

                <!-- Confirmar Contraseña -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                </div>

                <!-- Botones Actualizar y Cancelar -->
                <div class="d-flex justify-content-between mt-4">
                    <!-- Botón para Actualizar -->
                    <button type="submit" class="btn btn-primary">Actualizar</button>

                    <!-- Botón Cancelar -->
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection