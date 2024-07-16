document.addEventListener('DOMContentLoaded', function () {
    // Modal de edição
    const editButtons = document.querySelectorAll('.edit-reserve-button');
    const editModal = document.getElementById('edit-modal');
    const editForm = document.getElementById('editForm');

    editButtons.forEach(button => {
        button.addEventListener('click', async function () {
            const reserveId = this.getAttribute('data-reserve-id');

            // Fetch the reserve data from the server
            const response = await fetch(`/reserves/${reserveId}`);
            const reserve = await response.json();

            // Fill the modal with the reserve data
            editModal.querySelector('select[name="user_id"]').value = reserve.user_id;
            editModal.querySelector('input[name="title"]').value = reserve.title;
            editModal.querySelector('select[name="rental_item_id"]').value = reserve.rental_item_id;
            editModal.querySelector('input[name="start_date"]').value = reserve.start_date.split(' ')[0]; // Data de início
            editModal.querySelector('input[name="start_time"]').value = reserve.start_date.split(' ')[1]; // Hora de início
            editModal.querySelector('input[name="end_date"]').value = reserve.end_date.split(' ')[0]; // Data de término
            editModal.querySelector('input[name="end_time"]').value = reserve.end_date.split(' ')[1]; // Hora de término
            editModal.querySelector('input[name="reserve_notes"]').value = reserve.reserve_notes;

            // Update the form action with the correct reserve ID
            editForm.action = `/reserves/${reserveId}`;

            // Show the modal
            editModal.classList.remove('hidden');
        });
    });

    // Modal de visualização
    const viewButtons = document.querySelectorAll('.view-reserve-button');
    const viewModal = document.getElementById('view-modal');

    viewButtons.forEach(button => {
        button.addEventListener('click', async function () {
            const reserveId = this.getAttribute('data-reserve-id');

            // Fetch the reserve data from the server
            const response = await fetch(`/reserves/${reserveId}`);
            const reserve = await response.json();

            // Fill the modal with the reserve data
            viewModal.querySelector('#modal-reserve-user').textContent = reserve.user.name;
            viewModal.querySelector('#modal-reserve-space').textContent = reserve.rentalitem.name;
            viewModal.querySelector('#modal-reserve-company').textContent = reserve.user.company;
            viewModal.querySelector('#modal-reserve-start').textContent = reserve.start_date;
            viewModal.querySelector('#modal-reserve-end').textContent = reserve.end_date;
            viewModal.querySelector('#modal-reserve-notes').textContent = reserve.reserve_notes; // Preenchendo o campo de observações

            // Show the modal
            viewModal.classList.remove('hidden');
        });
    });

    // Modal de exclusão
    const modal = document.getElementById('delete-modal');
    const deleteForm = document.getElementById('delete-form');
    const buttons = document.querySelectorAll('[data-modal-toggle="delete-modal"]');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const reserveId = this.getAttribute('data-reserve-id');
            deleteForm.setAttribute('action', `/reserves/${reserveId}`);
        });
    });

    // Modal de criação - Atualizar campo de nome
    const userSelect = document.getElementById('user_id');
    const userNameInput = document.getElementById('name');

    if (userSelect) {
        userSelect.addEventListener('change', function () {
            const selectedOption = userSelect.options[userSelect.selectedIndex];
            const userName = selectedOption.getAttribute('data-name');
            userNameInput.value = userName;
        });

        // Trigger change event on load to set the initial value
        const event = new Event('change');
        userSelect.dispatchEvent(event);
    }

    // Fechar modal ao clicar no botão de fechar
    const closeModalButton = document.getElementById('close-modal');
    closeModalButton.addEventListener('click', function () {
        editModal.classList.add('hidden');
    });
});
