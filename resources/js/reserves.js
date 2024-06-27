document.addEventListener('DOMContentLoaded', function () {
    const editUserModal = document.getElementById('editUser');

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

    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('delete-modal');
        const deleteForm = document.getElementById('delete-form');
        const buttons = document.querySelectorAll('[data-modal-toggle="delete-modal"]');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-user-id');
                deleteForm.setAttribute('action', `/users/${userId}`);
            });
        });
    });
});
