// resources/js/productos_busqueda.js

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('live-search');

    if (searchInput) {
        searchInput.addEventListener('keyup', function () {
            const query = this.value;

            fetch(`/productos/buscar?query=${encodeURIComponent(query)}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('resultados-productos').innerHTML = html;
                })
                .catch(error => {
                    console.error('Error al buscar productos:', error);
                });
        });
    }
});
