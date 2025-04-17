@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Registrar usuario</h2>
        </div>
        <div class="card-body">
            <!-- Formulario de registro -->
            <form action="{{ route('users.store')}}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <!-- Nueva Contraseña -->
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                </div>

                <!-- Confirmar Contraseña -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                </div>

                <!-- Estado 
                <div class="mb-3">
                    <label for="name" class="form-label">Estado</label>
                    <select class="form-control" id="estado" name="estado" required>
                        <option value="">Seleccione el estado</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>-->

                <!-- Rol -->
                <div class="mb-3">
                    <label for="rol" class="form-label">Rol</label>
                    <select class="form-control" id="rol" name="rol" required>
                        <option value="">Seleccione un rol</option>
                        <option value="1">Administrador</option>
                        <option value="2">Empleado</option>
                    </select>
                </div>


                <!-- Botón registrar -->
                <div class="d-flex justify-content-between mt-4">
                    <!-- Botón para Actualizar -->
                    <button type="submit" class="btn btn-primary">Registrar</button>

                    <!-- Botón Cancelar -->
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection