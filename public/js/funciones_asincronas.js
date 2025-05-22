document.addEventListener('DOMContentLoaded', function () {
    const permissionsContainer = document.getElementById('permissions-container');
    const roleSelect = document.getElementById('role_id');
    const searchInput = document.getElementById('search');

    if (!permissionsContainer || !roleSelect || !searchInput) {
        console.error('No se encontraron los elementos necesarios.');
        return;
    }

    // Mostrar u ocultar el contenedor de permisos según el rol seleccionado
    roleSelect.addEventListener('change', function () {
        if (this.value) {
            permissionsContainer.style.display = 'block';
        } else {
            permissionsContainer.style.display = 'none';
        }
    });

    // Inicializar el estado del contenedor al cargar la página
    if (roleSelect.value) {
        fetchPermissions(roleSelect.value);
    } else {
        permissionsContainer.style.display = 'none';
    }

    // Manejar la búsqueda dinámica
    searchInput.addEventListener('input', function () {
        const query = this.value.trim();

        if (!query) {
            permissionsContainer.style.display = 'none';
            roleSelect.innerHTML = '<option value="">-- Selecciona un Rol --</option>';
            return;
        }

        // Realizar la búsqueda de roles
        fetch(`/api/roles?search=${encodeURIComponent(query)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error en la solicitud: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                // Actualizar el select con los roles encontrados
                roleSelect.innerHTML = '<option value="">-- Selecciona un Rol --</option>';
                if (data.roles && data.roles.length > 0) {
                    data.roles.forEach(role => {
                        const option = document.createElement('option');
                        option.value = role.id;
                        option.textContent = role.name;
                        roleSelect.appendChild(option);
                    });

                    // Seleccionar automáticamente el primer resultado
                    roleSelect.value = data.roles[0].id;

                    // Cargar los permisos del primer resultado
                    fetchPermissions(data.roles[0].id);
                } else {
                    console.warn('No se encontraron roles para la búsqueda.');
                    permissionsContainer.style.display = 'none';
                }
            })
            .catch(error => console.error('Error al buscar roles:', error));
    });

    // Función para obtener los permisos de un rol
    function fetchPermissions(roleId) {
        fetch(`/api/roles/${roleId}/permissions`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error al obtener permisos: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                // Actualizar el contenedor de permisos
                if (data.permissions && data.permissions.length > 0) {
                    permissionsContainer.innerHTML = `
                        <b><h3 class="mb-4">PERMISOS PARA EL ROL: <u><i>${data.role.name}</i></u></h3></b>
                        <form action="/roles/${roleId}/permissions" method="POST">
                            <input type="hidden" name="_token" value="${data.csrf_token}">
                            <input type="hidden" name="_method" value="PUT">
                            ${data.permissions.map(permission => `
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="permission_${permission.id}" name="permissions[]"
                                        value="${permission.name}" ${permission.assigned ? 'checked' : ''}>
                                    <label class="form-check-label" for="permission_${permission.id}">
                                        ${permission.name}
                                    </label>
                                </div>
                            `).join('')}
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success me-2">Actualizar Permisos</button>
                            </div>
                        </form>
                    `;
                    permissionsContainer.style.display = 'block';
                } else {
                    permissionsContainer.innerHTML = '<p>No hay permisos disponibles para este rol.</p>';
                    permissionsContainer.style.display = 'block';
                }
            })
            .catch(error => console.error('Error al obtener permisos:', error));
    }
});