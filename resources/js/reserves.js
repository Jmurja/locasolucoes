document.addEventListener('DOMContentLoaded', function () {
    const editUserModal = document.getElementById('editUser');
    const editUserForm = document.getElementById('editUserForm');
    document.querySelectorAll('button[data-modal-target="editUser"]').forEach(button => {
        button.addEventListener('click', () => {
            const userId = button.getAttribute('data-user_id');
            const name = button.getAttribute('data-name');
            const email = button.getAttribute('data-email');
            const phone = button.getAttribute('data-phone');
            const mobile = button.getAttribute('data-mobile');
            const role = button.getAttribute('data-role');
            const cpfCnpj = button.getAttribute('data-cpf-cnpj');
            const userNotes = button.getAttribute('data-user-notes');
            const country = button.getAttribute('data-country');
            const state = button.getAttribute('data-state');
            const city = button.getAttribute('data-city');
            const neighborhood = button.getAttribute('data-neighborhood');
            const street = button.getAttribute('data-street');
            const number = button.getAttribute('data-number');
            const zipcode = button.getAttribute('data-zipcode');

            const form = document.getElementById('editUserForm');
            form.setAttribute('action', form.getAttribute('action').replace(':id', userId));

            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_phone').value = phone;
            document.getElementById('edit_mobile').value = mobile;
            document.getElementById('edit_role').value = role;
            document.getElementById('edit_cpf_cnpj').value = cpfCnpj;
            document.getElementById('edit_user_notes').value = userNotes;
            document.getElementById('edit_country').value = country;
            document.getElementById('edit_state').value = state;
            document.getElementById('edit_city').value = city;
            document.getElementById('edit_neighborhood').value = neighborhood;
            document.getElementById('edit_street').value = street;
            document.getElementById('edit_number').value = number;
            document.getElementById('edit_zipcode').value = zipcode;

            editUserModal.classList.remove('hidden');
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
});
document.addEventListener('DOMContentLoaded', function () {
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
            viewModal.querySelector('.modal-reserve-name').textContent = reserve.user.name;
            viewModal.querySelector('.modal-reserve-phone').textContent = reserve.user.phone;
            viewModal.querySelector('.modal-reserve-start').textContent = reserve.start_date;
            viewModal.querySelector('.modal-reserve-end').textContent = reserve.end_date;
            viewModal.querySelector('.modal-reserve-notes').textContent = reserve.reserve_notes;
            viewModal.querySelector('.modal-reserve-created').textContent = reserve.created_at;

            // Show the modal
            const modal = new bootstrap.Modal(viewModal);
            modal.show();
        });
    });
});
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
            editModal.querySelector('input[name="start_date"]').value = reserve.start_date.replace(' ', 'T');
            editModal.querySelector('input[name="end_date"]').value = reserve.end_date.replace(' ', 'T');
            editModal.querySelector('input[name="reserve_notes"]').value = reserve.reserve_notes;

            // Update the form action with the correct reserve ID
            editForm.action = editForm.action.replace('reserve-id-placeholder', reserveId);

            // Show the modal
            const modal = new bootstrap.Modal(editModal);
            modal.show();
        });
    });
});
