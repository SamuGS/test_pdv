@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header card-header-custom">
            <h2 class="mb-0">Agregar Usuario</h2>
        </div>
        <div class="card-body">            
            <!-- Formulario de registro -->
            <form action="{{ route('users.store')}}" method="POST">
                @csrf                

                <!-- Nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-person-fill"></i></span>
                        <input type="text" class="form-control border-start-0 rounded-end-pill" id="nombre" name="nombre" required placeholder="Nombre de usuario">
                    </div>
                    @error('nombre')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-envelope-fill"></i></span>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="Correo electrónico">
                    </div>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Nueva Contraseña -->
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control border-start-0 rounded-end-pill" id="password" name="password" required placeholder="Contraseña" autocomplete="new-password">
                    </div>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Confirmar Contraseña -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control border-start-0 rounded-end-pill" id="password_confirmation" name="password_confirmation" required placeholder="Confirmar contraseña" autocomplete="new-password">
                    </div>          
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror          
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
                    @error('rol')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror                 
                </div>


                <!-- Botón registrar -->
                <div class="d-flex justify-content-between mt-4">
                    <!-- Botón para Actualizar -->
                    <button type="submit" class="btn btn-primary" name="btnCrear">Registrar</button>

                    <!-- Botón Cancelar -->
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

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

    <script src="{{ asset('js/alertasUsuarios/crear.js') }}"></script>
@endsection