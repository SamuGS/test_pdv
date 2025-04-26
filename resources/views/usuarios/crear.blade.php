@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header card-header-custom">
            <h2 class="mb-0">Agregar Usuario</h2>
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
            <!-- Formulario de registro -->
            <form action="{{ route('users.store')}}" method="POST">
                @csrf                

                <!-- Nombre -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-person-fill"></i></span>
                        <input type="text" class="form-control border-start-0 rounded-end-pill" id="nombre" name="nombre" required placeholder="Nombre de usuario">
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-envelope-fill"></i></span>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="Correo electrónico">
                    </div>
                </div>

                <!-- Nueva Contraseña -->
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control border-start-0 rounded-end-pill" id="password" name="password" required placeholder="Contraseña" autocomplete="new-password">
                    </div>
                </div>

                <!-- Confirmar Contraseña -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control border-start-0 rounded-end-pill" id="password_confirmation" name="password_confirmation" required placeholder="Confirmar contraseña" autocomplete="new-password">
                    </div>                    
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

                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-person-fill"></i></span>
                        <select class="form-control border-start-0 rounded-end-pill" id="rol" name="rol" required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>                                        
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