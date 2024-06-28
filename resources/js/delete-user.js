document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('delete-modal');
    const deleteForm = document.getElementById('delete-form');
    const buttons = document.querySelectorAll('[data-modal-toggle="delete-modal"]');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-reserve-id');
            deleteForm.setAttribute('action', `/users/${userId}`);
        });
    });
});
