@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header card-header-custom">
                <h2 class="mb-0">Información del Perfil</h2>
            </div>            

            <div class="card-body">
                <div class="row">
                    <!-- Card para Información del Perfil -->
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header card-header-custom">
                                <h2 class="mb-0">Datos personales</h2>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('patch')

                                    @if ($user->name !== 'Administrador')
                                        <!-- Nombre -->
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nombre</label>
                                            <div class="input-group">
                                                <span class="input-group-text rounded-start-pill"><i class="bi bi-person-fill"></i></span>
                                                <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus />
                                            </div>
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif

                                    <!-- Correo Electrónico -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Correo electrónico</label>
                                        <div class="input-group">
                                            <span class="input-group-text rounded-start-pill"><i class="bi bi-envelope-fill"></i></span>
                                        <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required />
                                        </div>
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
                                    <div class="mb-3 text-center">
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
                            <div class="card-header card-header-custom">
                                <h2 class="mb-0">Cambiar contraseña</h2>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('password.update') }}">
                                    @csrf
                                    @method('put')

                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Contraseña Actual</label>
                                        <div class="input-group">
                                            <span class="input-group-text rounded-start-pill"><i class="bi bi-lock-fill"></i></span>
                                            <input type="password" id="current_password" name="current_password" class="form-control" required />
                                        </div>
                                        @error('current_password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Nueva Contraseña</label>
                                        <div class="input-group">
                                            <span class="input-group-text rounded-start-pill"><i class="bi bi-lock-fill"></i></span>
                                            <input type="password" id="password" name="password" class="form-control" required />
                                        </div>
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                                        <div class="input-group">
                                            <span class="input-group-text rounded-start-pill"><i class="bi bi-lock-fill"></i></span>
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required />
                                        </div>
                                    </div>

                                    <div class="mb-3 text-center">
                                        <button type="submit" class="btn btn-success">Actualizar Contraseña</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
