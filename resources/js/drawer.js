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

    window.onload = function () {
        const overlay = document.getElementById('overlay'); // ou querySelector
        const drawer = document.getElementById('drawer'); // ou querySelector

        if (overlay && drawer) {
            overlay.addEventListener('click', function () {
                drawer.classList.add('translate-y-full');
                drawer.classList.remove('transform-none');
                overlay.classList.add('hidden');
            });
        } else {
            console.error('Overlay ou Drawer não encontrado!');
        }
    };
});
