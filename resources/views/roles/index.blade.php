@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Card para la gestión de roles -->
    <div class="card cardModulo">
        <div class="encabezadoModulo">
            <h2 class="mb-0">Gestión de Roles y Permisos</h2>
            <a href="{{ route('roles.create') }}" class="btn botonNuevo">
                <i class="bi bi-plus-circle"></i> Agregar Rol
            </a>
        </div>
    </div>

    <!-- Tabla de roles -->
    <div class="card">        
        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
            <table class="tablaPersonalizada">
                <thead>
                    <tr>
                        <th>Rol</th>
                        <th>Permisos</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach ($role->permissions as $permission)
                                    <span class="badge bg-primary">{{ $permission->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $role->estado == '1' ? 'Activado' : 'Desactivado' }}</td>
                            <td class="acciones">
                                <!-- Botón Actualizar -->                               
                                <button class="btn botonAcciones boton1" onclick="showPermissions({{ $role->id }}, '{{ $role->name }}')">
                                    <i class="bi bi-pencil-square"></i> Actualizar
                                </button>
                            
                                <!-- Botón Activar/Desactivar -->
                                <form action="{{ route('roles.toggleEstado', $role->id) }}" method="POST" style="display:inline;" id="form-estado-{{ $role->id }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn botonAcciones boton2 {{ $role->estado == 1 ? 'btn-danger' : 'btn-success' }}" id="btn-estado-{{ $role->id }}">
                                        <i class="bi {{ $role->estado == 1 ? 'bi-x-circle' : 'bi-check-circle' }}"></i>
                                        {{ $role->estado == 1 ? 'Desactivar' : 'Activar' }}
                                    </button>
                                </form>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para edición de permisos -->
<div class="modal fade" id="permissionsModal" tabindex="-1" aria-labelledby="permissionsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="permissions-form" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="permissionsModalLabel">Editar Permisos para el Rol: <span id="role-name"></span></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div id="permissions-list">
            <!-- Aquí se cargarán los permisos dinámicamente -->
            <p>Cargando permisos...</p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Actualizar Permisos</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('page_js')
<script>
    function showPermissions(roleId, roleName) {
        const modal = new bootstrap.Modal(document.getElementById('permissionsModal'));
        const permissionsList = document.getElementById('permissions-list');
        const roleNameSpan = document.getElementById('role-name');
        const permissionsForm = document.getElementById('permissions-form');

        // Mostrar nombre del rol
        roleNameSpan.textContent = roleName;

        // Establecer acción del formulario
        permissionsForm.action = `/roles/${roleId}/permissions`;

        // Resetear contenido
        permissionsList.innerHTML = '<p>Cargando permisos...</p>';

        // Obtener permisos
        fetch(`/api/roles/${roleId}/permissions`)
            .then(response => response.json())
            .then(data => {
                if (data.permissions && data.permissions.length > 0) {
                    permissionsList.innerHTML = data.permissions.map(permission => `
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="permission_${permission.id}" name="permissions[]"
                                value="${permission.name}" ${permission.assigned ? 'checked' : ''}>
                            <label class="form-check-label" for="permission_${permission.id}">
                                ${permission.name}
                            </label>
                        </div>
                    `).join('');
                } else {
                    permissionsList.innerHTML = '<p>No hay permisos disponibles.</p>';
                }

                modal.show(); // Mostrar modal cuando todo esté listo
            })
            .catch(error => {
                console.error('Error al cargar permisos:', error);
                permissionsList.innerHTML = '<p>Error al cargar permisos.</p>';
                modal.show();
            });
    }
</script>
@endsection