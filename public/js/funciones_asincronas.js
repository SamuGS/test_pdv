document.addEventListener('DOMContentLoaded', function () {
    function buscarRoles(searchInputId, selectId) {
        const searchInput = document.getElementById(searchInputId);
        const select = document.getElementById(selectId);
        const roleIdInput = document.getElementById('hidden_role_id'); // Campo oculto para el role_id
        const permissionsContainer = document.getElementById('permissions-container'); // Contenedor de los checkboxes de permisos
        const updatePermissionsBtn = document.getElementById('update-permissions-btn'); // Botón para actualizar permisos

        if (!searchInput || !select || !roleIdInput || !permissionsContainer || !updatePermissionsBtn) {
            console.error('No se encontraron los elementos necesarios.');
            return;
        }

        // Define la URL para buscar roles
        const rolesUrl = searchInput.dataset.url;

        if (!rolesUrl) {
            console.error('La URL para buscar roles no está definida. Asegúrate de que el atributo data-url esté configurado.');
            return;
        }

        // Función para ocultar permisos y botón
        function ocultarPermisos() {
            permissionsContainer.innerHTML = ''; // Limpiar el contenedor de permisos
            permissionsContainer.style.display = 'none'; // Ocultar el contenedor de permisos
            updatePermissionsBtn.style.display = 'none'; // Ocultar el botón
            roleIdInput.value = ''; // Limpiar el campo oculto
        }

        // Función para cargar todos los roles en el select
        function cargarTodosLosRoles() {
            console.log('Intentando cargar todos los roles...');
            select.innerHTML = '<option value="">-- Selecciona un Rol --</option>'; // Restablecer el select
            fetch(`${rolesUrl}`, {
                credentials: 'same-origin' // Incluir credenciales para autenticación
            })
                .then(response => {
                    console.log('Respuesta recibida de la API:', response);
                    if (!response.ok) {
                        throw new Error(`Error en la solicitud: ${response.status}`);
                    }
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        throw new Error('La respuesta no es un JSON válido.');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Datos recibidos de la API:', data);
                    if (data.roles && data.roles.length > 0) {
                        data.roles.forEach(role => {
                            const option = document.createElement('option');
                            option.value = role.id;
                            option.textContent = role.name;
                            select.appendChild(option);
                        });
                        console.log('Roles cargados correctamente.');
                    } else {
                        console.warn('No se encontraron roles disponibles.');
                    }
                })
                .catch(error => console.error('Error al cargar roles:', error));
        }

        // Evento para manejar la búsqueda dinámica
        searchInput.addEventListener('input', function () {
            const query = this.value.trim();

            // Si el campo de búsqueda está vacío, recargar todos los roles
            if (!query) {
                ocultarPermisos();
                cargarTodosLosRoles();
                return;
            }

            // Buscar roles que coincidan con el texto ingresado
            fetch(`${rolesUrl}?search=${encodeURIComponent(query)}`, {
                credentials: 'same-origin'
            })
                .then(response => {
                    console.log('Respuesta recibida de la API para búsqueda:', response);
                    if (!response.ok) {
                        throw new Error(`Error en la solicitud: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Datos recibidos para búsqueda:', data);

                    // Limpiar el select antes de agregar las coincidencias
                    select.innerHTML = '<option value="">-- Selecciona un Rol --</option>';

                    if (data.roles && data.roles.length > 0) {
                        // Agregar las coincidencias al select
                        data.roles.forEach(role => {
                            const option = document.createElement('option');
                            option.value = role.id;
                            option.textContent = role.name;
                            select.appendChild(option);
                        });

                        // Seleccionar automáticamente el primer rol encontrado
                        select.value = data.roles[0].id;
                        console.log(`Primer rol seleccionado automáticamente: ${data.roles[0].name}`);

                        // Disparar manualmente el evento 'change' para cargar los permisos
                        select.dispatchEvent(new Event('change'));
                    } else {
                        console.warn('No se encontraron roles para la búsqueda.');
                    }
                })
                .catch(error => console.error('Error al buscar roles:', error));
        });

        // Evento para manejar el cambio de selección en el select
        select.addEventListener('change', function () {
            const roleId = select.value;

            if (!roleId) {
                // Si se selecciona la opción inicial, ocultar permisos y recargar roles
                ocultarPermisos();
                cargarTodosLosRoles(); // Recargar todos los roles
                return;
            }

            // Cargar permisos del rol seleccionado
            fetch(`/roles/permissions?role_id=${roleId}`, {
                credentials: 'same-origin'
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Error en la solicitud: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    permissionsContainer.innerHTML = ''; // Limpiar los permisos
                    permissionsContainer.style.display = 'block'; // Mostrar el contenedor

                    // Cargar los permisos del rol seleccionado
                    data.permissions.forEach(permission => {
                        const isChecked = data.rolePermissions.includes(permission.name);
                        const checkbox = `
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="permission_${permission.id}" name="permissions[]"
                                    value="${permission.name}" ${isChecked ? 'checked' : ''}>
                                <label class="form-check-label" for="permission_${permission.id}">
                                    ${permission.name}
                                </label>
                            </div>
                        `;
                        permissionsContainer.innerHTML += checkbox;
                    });

                    // Mostrar el botón de actualizar permisos
                    updatePermissionsBtn.style.display = 'block';
                })
                .catch(error => console.error('Error al cargar permisos:', error));
        });

        // Cargar todos los roles al iniciar
        cargarTodosLosRoles();
    }

    buscarRoles('search', 'role_id');
});