document.addEventListener('DOMContentLoaded', function () {
    const alert = document.querySelector('#alert-additional-content-3');
    const closeButton = alert.querySelector('[data-dismiss-target]');

    closeButton.addEventListener('click', function () {
        alert.style.display = 'none';
    });
});

document.querySelector('[data-drawer-hide="drawer-bottom-example"]').addEventListener('click', function () {
    const drawer = document.getElementById('drawer-bottom-example');
    const overlay = document.getElementById('overlay');
    drawer.classList.add('translate-y-full');
    overlay.classList.add('hidden');
});
document.addEventListener('DOMContentLoaded', function () {
    const successAlert = document.getElementById('success-alert');
    if (successAlert) {
        successAlert.style.display = 'block';
        setTimeout(() => {
            successAlert.style.display = 'none';
        }, 5000);
    }
});
