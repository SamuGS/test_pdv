@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Gestión de Roles y Permisos</h2>

        <!-- Seleccionar un rol -->
        <form action="{{ route('roles.index') }}" method="GET" class="mb-4">
            <div class="mb-3">
                <label for="role_id" class="form-label">Seleccionar Rol</label>
                <select class="form-control" id="role_id" name="role_id" onchange="this.form.submit()">
                    <option value="">-- Selecciona un Rol --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ isset($selectedRole) && $selectedRole->id == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        @if (isset($selectedRole))
            <h3 class="mb-4">Permisos para el Rol: {{ $selectedRole->name }}</h3>

            <!-- Formulario para actualizar permisos -->
            <form action="{{ route('roles.update.permissions') }}" method="POST">
                @csrf
                <input type="hidden" name="role_id" value="{{ $selectedRole->id }}">

                <div class="mb-3">
                    @foreach ($permissions as $permission)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]"
                                value="{{ $permission->name }}"
                                {{ $selectedRole->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                            <label class="form-check-label" for="permission_{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-success">Actualizar Permisos</button>
            </form>
        @endif
    </div>
@endsection