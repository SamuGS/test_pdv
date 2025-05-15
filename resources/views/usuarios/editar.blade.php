@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header card-header-custom">
            <h2 class="mb-0">Editar Datos del Usuario</h2>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulario de Actualización -->
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-person-fill"></i></span>
                        <input type="text" class="form-control border-start-0 rounded-end-pill" id="name" name="name" value="{{ $user->name }}" required>
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-envelope-fill"></i></span>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                </div>                

                <!-- Nueva Contraseña -->
                <div class="mb-3">
                    <label for="password" class="form-label">Nueva Contraseña (opcional)</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                    </div>
                </div>

                <!-- Confirmar Contraseña -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="rol" class="form-label">Rol</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-person-fill"></i></span>
                        <select class="form-control" id="rol" name="rol" required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ isset($user) && $user->roles->first() && $user->roles->first()->name == $role->name ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Botones Actualizar y Cancelar -->
                <div class="d-flex justify-content-between mt-4">
                    <!-- Botón para Actualizar -->
                    <button type="submit" class="btn btn-primary" name="btnActualizar">Actualizar</button>

                    <!-- Botón Cancelar -->
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>

        </div>
    </div>
</div>

@php
    $success = session()->pull('success');
@endphp

    @section('page_js')
        @if($success)
            <script>
                // Guardar solo si hay mensaje
                sessionStorage.setItem('successMessage', @json($success));
            </script>
        @endif

        <script src="{{ asset('js/alertasUsuarios/editar.js') }}"></script>
    @endsection

@endsection