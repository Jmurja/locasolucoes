document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-user-button');
    const viewButtons = document.querySelectorAll('.view-user-button');
    const deleteButtons = document.querySelectorAll('.delete-button');
    const closeModalButtons = document.querySelectorAll('button[data-modal-toggle]');
    const editModal = document.getElementById('edit-modal');
    const viewModal = document.getElementById('view-modal');
    const deleteModal = document.getElementById('delete-modal');
    const createModal = document.getElementById('create-user');

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

    function validateCreateForm() {
        const requiredFields = ['name', 'email', 'phone', 'company', 'role', 'cpf_cnpj', 'cep', 'cidade', 'rua', 'bairro', 'password'];
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

    document.getElementById('create-user-form').addEventListener('submit', function (event) {
        if (!validateCreateForm()) {
            event.preventDefault();
        }
    });

    const requiredFieldsCreate = ['name', 'email', 'phone', 'company', 'role', 'cpf_cnpj', 'cep', 'cidade', 'rua', 'bairro', 'password'];

    requiredFieldsCreate.forEach(fieldId => {
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
        } else if (event.target == createModal) {
            createModal.classList.add('hidden');
            createModal.setAttribute('aria-hidden', 'true');
            createModal.removeAttribute('role');
        }
    });
});
