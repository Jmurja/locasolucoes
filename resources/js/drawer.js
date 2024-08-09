document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('toggleDrawer');
    const drawer = document.getElementById('drawer-bottom-example');
    const overlay = document.getElementById('overlay');
    const closeButton = drawer.querySelector('[data-drawer-hide]');

    toggleButton.addEventListener('click', function () {
        drawer.classList.toggle('transform-none');
        drawer.classList.toggle('translate-y-full');
        overlay.classList.toggle('hidden');
    });

    closeButton.addEventListener('click', function () {
        drawer.classList.add('translate-y-full');
        drawer.classList.remove('transform-none');
        overlay.classList.add('hidden');
    });
});
