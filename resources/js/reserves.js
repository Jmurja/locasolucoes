document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-reserve-button');
    const editModal = document.getElementById('edit-modal');
    const editForm = document.getElementById('editForm');

    editButtons.forEach(button => {
        button.addEventListener('click', async function () {
            const reserveId = this.getAttribute('data-reserve-id');

            const response = await fetch(`/reserves/${reserveId}`);
            const reserve = await response.json();

            editModal.querySelector('select[name="user_id"]').value = reserve.user_id;
            editModal.querySelector('input[name="title"]').value = reserve.title;
            editModal.querySelector('select[name="status"]').value = reserve.rentalitem.status;
            editModal.querySelector('input[name="start_date"]').value = reserve.start_date.replace(' ', 'T');
            editModal.querySelector('input[name="end_date"]').value = reserve.end_date.replace(' ', 'T');
            editModal.querySelector('input[name="reserve_notes"]').value = reserve.reserve_notes;
            editForm.action = editForm.action.replace('reserve-id-placeholder', reserveId);

            editModal.classList.remove('hidden');
        });
    });
    const viewButtons = document.querySelectorAll('.view-reserve-button');
    const viewModal = document.getElementById('view-modal');

    viewButtons.forEach(button => {
        button.addEventListener('click', async function () {
            const reserveId = this.getAttribute('data-reserve-id');
            const response = await fetch(`/reserves/${reserveId}`);
            const reserve = await response.json();

            viewModal.querySelector('#modal-reserve-user').textContent = reserve.user.name;
            viewModal.querySelector('#modal-reserve-space').textContent = reserve.rentalitem.name;
            viewModal.querySelector('#modal-reserve-company').textContent = reserve.user.company;
            viewModal.querySelector('#modal-reserve-start').textContent = reserve.start_date;
            viewModal.querySelector('#modal-reserve-end').textContent = reserve.end_date;
            viewModal.querySelector('#modal-reserve-notes').textContent = reserve.reserve_notes; // Preenchendo o campo de observações
            viewModal.classList.remove('hidden');
        });
    });
    const modal = document.getElementById('delete-modal');
    const deleteForm = document.getElementById('delete-form');
    const buttons = document.querySelectorAll('[data-modal-toggle="delete-modal"]');
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-reserve-id');
            deleteForm.setAttribute('action', `/reserves/${userId}`);
        });
    });
    const userSelect = document.getElementById('user_id');
    const userNameInput = document.getElementById('name');
    if (userSelect) {
        userSelect.addEventListener('change', function () {
            const selectedOption = userSelect.options[userSelect.selectedIndex];
            const userName = selectedOption.getAttribute('data-name');
            userNameInput.value = userName;
        });
        const event = new Event('change');
        userSelect.dispatchEvent(event);
    }
});
