document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-user-button');
    const viewButtons = document.querySelectorAll('.view-user-button');
    const deleteButtons = document.querySelectorAll('.delete-button');
    const closeModalButtons = document.querySelectorAll('button[data-modal-toggle]');
    const editModal = document.getElementById('edit-modal');
    const viewModal = document.getElementById('view-modal');
    const deleteForm = document.getElementById('delete-form');
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

        document.getElementById('edit-name').value = userName;
        document.getElementById('edit-email').value = userEmail;
        document.getElementById('edit-phone').value = userPhone;
        document.getElementById('edit-cpf_cnpj').value = userCpfCnpj;
        document.getElementById('edit-cep').value = userCep;
        document.getElementById('edit-rua').value = userRua;
        document.getElementById('edit-bairro').value = userBairro;
        document.getElementById('edit-cidade').value = userCidade;
        document.getElementById('edit-role').value = userRole;  // Adicionado para pré-selecionar o role

        const form = document.getElementById('edit-user-form');
        form.action = `/usuarios/${userId}`;

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
        document.querySelector('.modal-user-created_at').textContent = userCreatedAt;
        document.querySelector('.modal-user-updated_at').textContent = userUpdatedAt;

        viewModal.classList.remove('hidden');
        viewModal.setAttribute('aria-hidden', 'false');
        viewModal.setAttribute('role', 'dialog');
    }

    function setupDeleteForm(button) {
        const userId = button.getAttribute('data-user-id');
        deleteForm.action = `/usuarios/${userId}`;
        deleteModal.classList.remove('hidden');
        deleteModal.setAttribute('aria-hidden', 'false');
        deleteModal.setAttribute('role', 'dialog');
    }

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
            setupDeleteForm(this);
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

    function pesquisacep(valor) {
        var cep = valor.replace(/\D/g, '');

        if (cep.length === 8) {
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (!("erro" in data)) {
                        document.getElementById('edit-rua').value = data.logradouro;
                        document.getElementById('edit-bairro').value = data.bairro;
                        document.getElementById('edit-cidade').value = data.localidade;
                    } else {
                        showError('edit-cep', 'CEP não encontrado.');
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar CEP:', error);
                });
        } else {
            showError('edit-cep', 'Formato de CEP inválido.');
        }
    }

    const cepInput = document.getElementById('edit-cep');
    if (cepInput) {
        cepInput.addEventListener('blur', function () {
            pesquisacep(this.value);
        });
    }

    function applyPhoneMask(input) {
        input.addEventListener('input', function () {
            let value = input.value.replace(/\D/g, '');
            if (value.length > 10) {
                value = value.replace(/^(\d{2})(\d{5})(\d)/, '($1) $2-$3');
            } else {
                value = value.replace(/^(\d{2})(\d{4})(\d)/, '($1) $2-$3');
            }
            input.value = value;
        });
    }

    function applyCepMask(input) {
        input.addEventListener('input', function () {
            let value = input.value.replace(/\D/g, '');
            value = value.replace(/^(\d{5})(\d)/, '$1-$2');
            input.value = value;
        });
    }

    function applyCpfCnpjMask(input) {
        input.addEventListener('input', function () {
            let value = input.value.replace(/\D/g, '');
            if (value.length > 11) {
                value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d)/, '$1.$2.$3/$4-$5');
            } else {
                value = value.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            }
            input.value = value;
        });
    }

    function showError(inputId, message) {
        const input = document.getElementById(inputId);
        let errorElement = input.nextElementSibling;

        if (!errorElement || !errorElement.classList.contains('error-message')) {
            errorElement = document.createElement('div');
            errorElement.classList.add('error-message');
            errorElement.style.color = 'red';
            input.parentNode.insertBefore(errorElement, input.nextSibling);
        }

        errorElement.textContent = message;
        input.classList.add('border-red-500');
    }

    function clearError(inputId) {
        const input = document.getElementById(inputId);
        const errorElement = input.nextElementSibling;

        if (errorElement && errorElement.classList.contains('error-message')) {
            errorElement.remove();
        }

        input.classList.remove('border-red-500');
    }

    function validateInput(input) {
        input.addEventListener('blur', function () {
            validateField(input);
        });

        input.addEventListener('input', function () {
            validateField(input);
        });
    }

    function validateField(input) {
        const value = input.value.trim();
        const valueDigits = value.replace(/\D/g, '');

        if (input.id.includes('name') && value.length < 3) {
            showError(input.id, 'Nome deve conter pelo menos 3 caracteres.');
        } else if (input.id.includes('email') && !/^\S+@\S+\.\S+$/.test(value)) {
            showError(input.id, 'Email inválido.');
        } else if (input.id.includes('phone') && (valueDigits.length < 10 || valueDigits.length > 11)) {
            showError(input.id, 'Número de telefone inválido. Deve conter 10 ou 11 dígitos.');
        } else if (input.id.includes('company') && value.length < 3) {
            showError(input.id, 'Empresa deve conter pelo menos 3 caracteres.');
        } else if (input.id.includes('cpf_cnpj') && (valueDigits.length !== 11 && valueDigits.length !== 14)) {
            showError(input.id, 'CPF/CNPJ inválido. CPF deve conter 11 dígitos e CNPJ deve conter 14 dígitos.');
        } else if (input.id.includes('cep') && valueDigits.length !== 8) {
            showError(input.id, 'CEP inválido. Deve conter 8 dígitos.');
        } else if (input.id.includes('cidade') && value.length < 2) {
            showError(input.id, 'Cidade deve conter pelo menos 2 caracteres.');
        } else if (input.id.includes('rua') && value.length < 3) {
            showError(input.id, 'Rua deve conter pelo menos 3 caracteres.');
        } else if (input.id.includes('bairro') && value.length < 3) {
            showError(input.id, 'Bairro deve conter pelo menos 3 caracteres.');
        } else if (input.id.includes('password') && value.length < 8) {
            showError(input.id, 'Senha deve conter pelo menos 8 caracteres.');
        } else {
            clearError(input.id);
        }
    }

    function validateForm() {
        let isValid = true;
        const inputs = document.querySelectorAll('input[required], select[required]');
        inputs.forEach(input => {
            if (!input.value || input.value === 'Selecione a Categoria') {
                isValid = false;
                input.classList.add('border-red-500');
            } else {
                input.classList.remove('border-red-500');
            }
        });

        if (!isValid) {
            alert('Por favor, preencha todos os campos obrigatórios.');
        }

        return isValid;
    }


    function applyMasksAndValidations() {
        const fieldsToValidate = [
            'name', 'email', 'phone', 'company', 'cpf_cnpj',
            'cep', 'cidade', 'rua', 'bairro', 'password'
        ];

        fieldsToValidate.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                validateInput(field);
            }
        });

        applyPhoneMask(document.getElementById('phone'));
        applyCepMask(document.getElementById('cep'));
        applyCpfCnpjMask(document.getElementById('cpf_cnpj'));
    }

    applyMasksAndValidations();

    function applyMasksToEditModal() {
        const phoneInput = document.getElementById('edit-phone');
        const cepInput = document.getElementById('edit-cep');
        const cpfCnpjInput = document.getElementById('edit-cpf_cnpj');

        applyPhoneMask(phoneInput);
        applyCepMask(cepInput);
        applyCpfCnpjMask(cpfCnpjInput);

        validateInput(phoneInput);
        validateInput(cepInput);
        validateInput(cpfCnpjInput);

        const fieldsToValidate = [
            'edit-name', 'edit-email', 'edit-phone', 'edit-cpf_cnpj',
            'edit-cep', 'edit-cidade', 'edit-rua', 'edit-bairro'
        ];

        fieldsToValidate.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                validateInput(field);
            }
        });
    }

    document.querySelectorAll('[data-modal-toggle="edit-modal"]').forEach(button => {
        button.addEventListener('click', function () {
            applyMasksToEditModal();
        });
    });

    document.getElementById('edit-modal').addEventListener('show.bs.modal', function () {
        applyMasksToEditModal();
    });
});
