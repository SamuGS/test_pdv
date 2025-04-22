document.addEventListener('DOMContentLoaded', function () {
    //se crea la función para el toast que mostrará la alerta
    function showToast(icon, title) {
        Swal.fire({
            toast: true, // Para mostrar como un toast
            position: 'top-end', // Ubicación de la alerta
            icon: icon, // Tipos de icono: success, error, warning, info
            title: title,
            showConfirmButton: false, // No mostrar botón de confirmación
            timer: 5000, // Tiempo visible de la alerta
            timerProgressBar: false, // Sin barra de progreso
            customClass: {
                popup: 'colored-toast', // Clase personalizada para los colores
            },
        });
    }

    // Función para validar campos vacíos
    function camposRequeridosVacios(formulario){
        const inputs = formulario.querySelectorAll('input[required], select[required], textarea[required]');
        for(let input of inputs){
            if(!input.value.trim()){
                return true; // Si hay un campo vacío, retorna true
            }
        }
        return false; // Si no hay campos vacíos, retorna false
    }

    // GUARDAR REGISTRO
    const btnCreate = document.getElementById('btn-create');
    const formCreate = document.getElementById('form-create');

    if (btnCreate && formCreate) {
        btnCreate.addEventListener('click', function (event) {
            event.preventDefault();

            if (camposRequeridosVacios(formCreate)) {
                showToast('warning', 'Por favor completa todos los campos obligatorios');
                return;
            }

            formCreate.requestSubmit();
            showToast('success', 'Registro guardado correctamente');
        });
    }

    // ACTUALIZAR REGISTRO
    const btnUpdate = document.getElementById('btn-update');
    const formEdit = document.getElementById('form-edit');

    if (btnUpdate && formEdit) {
        btnUpdate.addEventListener('click', function (event) {
            event.preventDefault();

            if (camposRequeridosVacios(formEdit)) {
                showToast('warning', 'Por favor completa todos los campos obligatorios');
                return;
            }

            formEdit.requestSubmit();
            showToast('success', 'Registro actualizado correctamente');
        });
    }

    // CAMBIAR ESTADO DE REGISTRO
    const btnEstado = document.querySelectorAll('[id^="btn-estado-"]');
    btnEstado.forEach(btn => {
        btn.addEventListener('click', function (event) {
            event.preventDefault();
            const id = btn.id.split('-')[2];
            const formEstado = document.getElementById('form-estado-' + id);
            formEstado.submit();

            showToast('info', 'Estado actualizado correctamente');
        });
    });
});
