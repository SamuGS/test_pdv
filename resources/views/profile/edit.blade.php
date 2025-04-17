@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4">Información del Perfil</h2>

        <div class="row">
            <!-- Card para Información del Perfil -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Información de Perfil</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input id="name" name="name" type="text" class="form-control"
                                    value="{{ old('name', $user->name) }}" required autofocus />
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Correo Electrónico -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input id="email" name="email" type="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required />
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <!-- Verificación de Email -->
                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div class="mt-2">
                                        <p class="text-sm text-muted">
                                            Tu correo electrónico no ha sido verificado.
                                            <button form="send-verification" class="btn btn-link p-0">Reenviar verificación</button>
                                        </p>
                                        @if (session('status') === 'verification-link-sent')
                                            <div class="text-success">
                                                Se envió un nuevo enlace de verificación a tu correo.
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Botón para guardar cambios -->
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>

                            <!-- Mensaje de éxito -->
                            @if (session('status') === 'profile-updated')
                                <span class="text-success ms-3">¡Perfil actualizado!</span>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <!-- Card para Cambiar Contraseña -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Cambiar Contraseña</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Contraseña Actual</label>
                                <input type="password" id="current_password" name="current_password" class="form-control" required />
                                @error('current_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Nueva Contraseña</label>
                                <input type="password" id="password" name="password" class="form-control" required />
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required />
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Actualizar Contraseña</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
