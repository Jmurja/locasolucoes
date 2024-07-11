document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-user-button');
    const viewButtons = document.querySelectorAll('.view-user-button');
    const deleteButtons = document.querySelectorAll('.delete-button');
    const closeModalButtons = document.querySelectorAll('button[data-modal-toggle]');
    const editModal = document.getElementById('edit-modal');
    const viewModal = document.getElementById('view-modal');
    const deleteModal = document.getElementById('delete-modal');

    function populateEditForm(button) {
        const userId = button.getAttribute('data-user-id');
        const userName = button.getAttribute('data-user-name');
        const userEmail = button.getAttribute('data-user-email');
        const userPhone = button.getAttribute('data-user-phone');
        const userCpfCnpj = button.getAttribute('data-user-cpf_cnpj');
        const userCep = button.getAttribute('data-user-cep');
        const userRua = button.getAttribute('data-user-rua');
        const userBairro = button.getAttribute('data-user-bairro');
        const userCidade = button.getAttribute('data-user-cidade');
        const userRole = button.getAttribute('data-user-role');
        const userResponsavel = button.getAttribute('data-user-responsavel');
        const userStatus = button.getAttribute('data-user-status');

        document.getElementById('edit-name').value = userName;
        document.getElementById('edit-email').value = userEmail;
        document.getElementById('edit-phone').value = userPhone;
        document.getElementById('edit-cpf_cnpj').value = userCpfCnpj;
        document.getElementById('edit-cep').value = userCep;
        document.getElementById('edit-rua').value = userRua;
        document.getElementById('edit-bairro').value = userBairro;
        document.getElementById('edit-cidade').value = userCidade;

        const roleSelect = document.getElementById('edit-role');
        roleSelect.value = userRole;

        document.getElementById('edit-responsavel').value = userResponsavel;
        document.getElementById('edit-status').value = userStatus;

        const form = document.getElementById('edit-user-form');
        form.action = `/users/${userId}`;

        editModal.classList.remove('hidden');
        editModal.setAttribute('aria-hidden', 'false');
        editModal.setAttribute('role', 'dialog');
    }

    function populateViewModal(button) {
        const userName = button.getAttribute('data-user-name');
        const userEmail = button.getAttribute('data-user-email');
        const userPhone = button.getAttribute('data-user-phone');
        const userCpfCnpj = button.getAttribute('data-user-cpf_cnpj');
        const userCep = button.getAttribute('data-user-cep');
        const userRua = button.getAttribute('data-user-rua');
        const userBairro = button.getAttribute('data-user-bairro');
        const userCidade = button.getAttribute('data-user-cidade');
        const userRole = button.getAttribute('data-user-role');
        const userResponsavel = button.getAttribute('data-user-responsavel');
        const userStatus = button.getAttribute('data-user-status');
        const userCreatedAt = button.getAttribute('data-user-created_at');
        const userUpdatedAt = button.getAttribute('data-user-updated_at');

        document.querySelector('.modal-user-name').textContent = userName;
        document.querySelector('.modal-user-email').textContent = userEmail;
        document.querySelector('.modal-user-phone').textContent = userPhone;
        document.querySelector('.modal-user-cpf_cnpj').textContent = userCpfCnpj;
        document.querySelector('.modal-user-cep').textContent = userCep;
        document.querySelector('.modal-user-rua').textContent = userRua;
        document.querySelector('.modal-user-bairro').textContent = userBairro;
        document.querySelector('.modal-user-cidade').textContent = userCidade;
        document.querySelector('.modal-user-role').textContent = userRole;
        document.querySelector('.modal-user-responsavel').textContent = userResponsavel;
        document.querySelector('.modal-user-status').textContent = userStatus;
        document.querySelector('.modal-user-created_at').textContent = userCreatedAt;
        document.querySelector('.modal-user-updated_at').textContent = userUpdatedAt;

        viewModal.classList.remove('hidden');
        viewModal.setAttribute('aria-hidden', 'false');
        viewModal.setAttribute('role', 'dialog');
    }

    function populateDeleteForm(button) {
        const userId = button.getAttribute('data-user-id');
        const form = document.getElementById('delete-form');
        form.action = `/users/${userId}`;
        document.getElementById('delete-user-id').value = userId;

        deleteModal.classList.remove('hidden');
        deleteModal.setAttribute('aria-hidden', 'false');
        deleteModal.setAttribute('role', 'dialog');
    }

    function validateField(field) {
        const errorField = document.querySelector(`#${field.id}-error`);
        if (!field.value.trim()) {
            errorField.textContent = 'Este campo é obrigatório';
            field.classList.add('border-red-500');
        } else {
            errorField.textContent = '';
            field.classList.remove('border-red-500');
        }
    }

    function validateEditForm() {
        const requiredFields = ['edit-name', 'edit-email', 'edit-phone', 'edit-cpf_cnpj', 'edit-cep', 'edit-rua', 'edit-bairro', 'edit-cidade', 'edit-role', 'edit-responsavel', 'edit-status'];
        let isValid = true;

        requiredFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            validateField(field);
            if (!field.value.trim()) {
                isValid = false;
            }
        });

        return isValid;
    }

    document.getElementById('edit-user-form').addEventListener('submit', function (event) {
        if (!validateEditForm()) {
            event.preventDefault();
        }
    });

    const requiredFields = ['edit-name', 'edit-email', 'edit-phone', 'edit-cpf_cnpj', 'edit-cep', 'edit-rua', 'edit-bairro', 'edit-cidade', 'edit-role', 'edit-responsavel', 'edit-status'];

    requiredFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        field.addEventListener('blur', function () {
            validateField(field);
        });
        field.addEventListener('input', function () {
            validateField(field);
        });
    });

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            populateEditForm(this);
        });
    });

    viewButtons.forEach(button => {
        button.addEventListener('click', function () {
            populateViewModal(this);
        });
    });

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            populateDeleteForm(this);
        });
    });

    closeModalButtons.forEach(button => {
        button.addEventListener('click', function () {
            const targetModal = this.getAttribute('data-modal-toggle');
            const modal = document.getElementById(targetModal);

            modal.classList.add('hidden');
            modal.setAttribute('aria-hidden', 'true');
            modal.removeAttribute('role');
        });
    });

    window.addEventListener('click', function (event) {
        if (event.target == editModal) {
            editModal.classList.add('hidden');
            editModal.setAttribute('aria-hidden', 'true');
            editModal.removeAttribute('role');
        } else if (event.target == viewModal) {
            viewModal.classList.add('hidden');
            viewModal.setAttribute('aria-hidden', 'true');
            viewModal.removeAttribute('role');
        } else if (event.target == deleteModal) {
            deleteModal.classList.add('hidden');
            deleteModal.setAttribute('aria-hidden', 'true');
            deleteModal.removeAttribute('role');
        }
    });
});
