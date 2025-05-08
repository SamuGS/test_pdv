@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header card-header-custom">
            <h2 class="mb-0">Agregar Rol</h2>
        </div>
        <div class="card-body">
            <!-- Formulario de Crear -->
            <form action="{{ route('roles.store') }}" method="POST" id="form-create">

                @csrf

                <!-- Nombre con icono -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-tag-fill"></i></span>
                        <input type="text" class="form-control border-start-0 rounded-end-pill" id="nombre" name="nombre" required placeholder="Nombre del rol">
                    </div>
                </div>

                <!-- Permisos con icono -->
                <div class="mb-3">
                    <label for="permisos" class="form-label">Permisos</label>
                    <div class="row">
                        @foreach ($permisos as $index => $permiso)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="permiso_{{ $permiso->id }}" name="permisos[]" value="{{ $permiso->name }}">
                                    <label class="form-check-label" for="permiso_{{ $permiso->id }}">
                                        {{ $permiso->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-main" id="btn-create">Crear rol</button>

                    <a href="{{ route('roles.index') }}" class="btn btn-secondary-custom">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
