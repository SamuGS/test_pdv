document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');

    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    }
});
