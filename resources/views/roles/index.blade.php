@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Card para el botón Agregar Rol -->
        <div class="card cardModulo">
            <div class="encabezadoModulo">
                <h2 class="mb-0">Gestión de Roles</h2>
                <a href="{{ route('roles.create') }}" class="btn botonNuevo">
                    <i class="bi bi-plus-circle"></i> Agregar Rol
                </a>
            </div>
        </div>

        <!-- Seleccionar un rol -->
        <div class="mb-4">
            <div class="d-flex align-items-end mb-4">
                <!-- Campo de búsqueda -->
                <div class="me-3 flex-grow-1">
                    <label for="search" class="form-label">Buscar Rol</label>
                    <input type="text" class="form-control" id="search" placeholder="Escribe el nombre del rol..." data-url="/api/roles">
                </div>

                <!-- Select para roles -->
                <div class="flex-grow-1">
                    <label for="role_id" class="form-label">Seleccionar Rol</label>
                    <select class="form-control" id="role_id" name="role_id">
                        <option value="">-- Selecciona un Rol --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ isset($selectedRole) && $selectedRole->id == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Campo oculto para el role_id -->
        <input type="hidden" name="role_id" id="hidden_role_id" value="{{ $selectedRole->id ?? '' }}">

        <div class="card cardModulo">
            <div class="card-body">
                <p>Selecciona un rol para ver y actualizar sus permisos.</p>
                <br>
                <hr>
                <br>
                <!-- Contenedor de permisos -->
                <div id="permissions-container" class="mb-3">            
                    @if (isset($selectedRole))            
                    <b><h3 class="mb-4">PERMISOS PARA EL ROL: <u><i>{{ $selectedRole->name }}</i></u></h3></b>
                    <!-- Los checkboxes de permisos -->
                    @foreach ($permissions as $permission)                    
                        <div class="form-check">                        
                        <input class="form-check-input" type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]"
                            value="{{ $permission->name }}"
                            {{ $selectedRole && $selectedRole->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                        <label class="form-check-label" for="permission_{{ $permission->id }}">
                            {{ $permission->name }}
                        </label>
                        </div>
                    @endforeach
                    @else                
                    @endif
                </div>

                <!-- Botón para actualizar permisos -->                
                <div class="d-flex justify-content-center">                    
                    <button type="submit" class="btn btn-success" id="update-permissions-btn" style="display: none;">Actualizar Permisos</button>                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_js')
    <script src="{{ asset('js/funciones_asincronas.js') }}"></script>
@endsection