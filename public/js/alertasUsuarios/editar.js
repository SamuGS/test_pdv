document.addEventListener('DOMContentLoaded', () => {
    // Evitar caché del navegador al volver atrás
    window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
            window.location.reload();
        }
    });

    const botones = document.getElementsByName('btnActualizar');

    botones.forEach(boton => {
        boton.addEventListener('click', function (event) {
            event.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción cambiará información del usuario.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, continuar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            });
        });
    });

    // ✅ Verificar y mostrar mensaje desde sessionStorage
    const successMessage = sessionStorage.getItem('successMessage');
    if (successMessage) {
        Swal.fire({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            text: successMessage,
            timer: 4000,
            icon: 'success',
            timerProgressBar: true
        });

        // Borrar para que no se repita
        sessionStorage.removeItem('successMessage');
    }
});
