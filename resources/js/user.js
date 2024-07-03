console.log('arquivo carregado')

function limpa_formulário_cep() {
    // Limpa valores do formulário de cep.
    document.getElementById('rua').value = ("");
    document.getElementById('bairro').value = ("");
    document.getElementById('cidade').value = ("");
}

window.meu_callback = function (conteudo) {
    if (!("erro" in conteudo)) {
        // Atualiza os campos com os valores.
        document.getElementById('rua').value = (conteudo.logradouro);
        document.getElementById('bairro').value = (conteudo.bairro);
        document.getElementById('cidade').value = (conteudo.localidade);
    } else {
        // CEP não Encontrado.
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}

window.pesquisacep = function (valor) {
    // Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    // Verifica se campo cep possui valor informado.
    if (cep != "") {
        // Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        // Valida o formato do CEP.
        if (validacep.test(cep)) {
            // Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('rua').value = "...";
            document.getElementById('bairro').value = "...";
            document.getElementById('cidade').value = "...";

            // Cria um elemento javascript.
            var script = document.createElement('script');

            // Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

            // Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);
        } else {
            // cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } else {
        // cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
};
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    const cpfCnpjInput = document.getElementById('cpf_cnpj');
    const passwordInput = document.getElementById('password');
    const cepInput = document.getElementById('cep');

    const errorMessages = {
        name: "O nome é obrigatório e deve ter entre 3 e 50 caracteres.",
        email: "O email é obrigatório e deve conter '@'.",
        phone: "O telefone é obrigatório e deve ter entre 10 e 15 caracteres.",
        cpfCnpj: "O CPF/CNPJ é obrigatório e deve ter 11 ou 14 caracteres.",
        password: "A senha é obrigatória e deve ter pelo menos 6 caracteres.",
        cep: "O CEP é obrigatório e deve ter 8 caracteres."
    };

    function showError(input, message) {
        const parent = input.parentElement;
        let errorElement = parent.querySelector('small');
        if (!errorElement) {
            errorElement = document.createElement('small');
            errorElement.classList.add('text-red-500', 'text-xs');
            parent.appendChild(errorElement);
        }
        errorElement.innerText = message;
    }

    function clearError(input) {
        const parent = input.parentElement;
        const errorElement = parent.querySelector('small');
        if (errorElement) {
            parent.removeChild(errorElement);
        }
    }

    function validateInput(input, type) {
        let isValid = true;
        const value = input.value.trim();

        if (value === '') {
            showError(input, errorMessages[type]);
            isValid = false;
        } else {
            switch (type) {
                case 'name':
                    if (value.length < 3 || value.length > 50) {
                        showError(input, errorMessages[type]);
                        isValid = false;
                    } else {
                        clearError(input);
                    }
                    break;
                case 'email':
                    if (!value.includes('@')) {
                        showError(input, errorMessages[type]);
                        isValid = false;
                    } else {
                        clearError(input);
                    }
                    break;
                case 'phone':
                    if (value.length < 10 || value.length > 15) {
                        showError(input, errorMessages[type]);
                        isValid = false;
                    } else {
                        clearError(input);
                    }
                    break;
                case 'cpfCnpj':
                    if (value.length !== 11 && value.length !== 14) {
                        showError(input, errorMessages[type]);
                        isValid = false;
                    } else {
                        clearError(input);
                    }
                    break;
                case 'password':
                    if (value.length < 6) {
                        showError(input, errorMessages[type]);
                        isValid = false;
                    } else {
                        clearError(input);
                    }
                    break;
                case 'cep':
                    if (value.length !== 8) {
                        showError(input, errorMessages[type]);
                        isValid = false;
                    } else {
                        clearError(input);
                    }
                    break;
            }
        }

        return isValid;
    }

    nameInput.addEventListener('blur', () => validateInput(nameInput, 'name'));
    nameInput.addEventListener('input', () => validateInput(nameInput, 'name'));
    emailInput.addEventListener('blur', () => validateInput(emailInput, 'email'));
    emailInput.addEventListener('input', () => validateInput(emailInput, 'email'));
    phoneInput.addEventListener('blur', () => validateInput(phoneInput, 'phone'));
    phoneInput.addEventListener('input', () => validateInput(phoneInput, 'phone'));
    cpfCnpjInput.addEventListener('blur', () => validateInput(cpfCnpjInput, 'cpfCnpj'));
    cpfCnpjInput.addEventListener('input', () => validateInput(cpfCnpjInput, 'cpfCnpj'));
    passwordInput.addEventListener('blur', () => validateInput(passwordInput, 'password'));
    passwordInput.addEventListener('input', () => validateInput(passwordInput, 'password'));
    cepInput.addEventListener('blur', () => validateInput(cepInput, 'cep'));
    cepInput.addEventListener('input', () => validateInput(cepInput, 'cep'));


    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const isNameValid = validateInput(nameInput, 'name');
        const isEmailValid = validateInput(emailInput, 'email');
        const isPhoneValid = validateInput(phoneInput, 'phone');
        const isCpfCnpjValid = validateInput(cpfCnpjInput, 'cpfCnpj');
        const isPasswordValid = validateInput(passwordInput, 'password');
        const isCepValid = validateInput(cepInput, 'cep');

        if (isNameValid && isEmailValid && isPhoneValid && isCpfCnpjValid && isPasswordValid && isCepValid) {
            form.submit();
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const viewButtons = document.querySelectorAll('.view-user-button');
    const viewModal = document.getElementById('view-modal');

    viewButtons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-user-id');
            const userName = this.getAttribute('data-user-name');
            const userEmail = this.getAttribute('data-user-email');
            const userPhone = this.getAttribute('data-user-phone');
            const userCpfCnpj = this.getAttribute('data-user-cpf_cnpj');
            const userCep = this.getAttribute('data-user-cep');
            const userRua = this.getAttribute('data-user-rua');
            const userBairro = this.getAttribute('data-user-bairro');
            const userCidade = this.getAttribute('data-user-cidade');
            const userRole = this.getAttribute('data-user-role');
            const userCreatedAt = this.getAttribute('data-user-created_at');
            const userUpdatedAt = this.getAttribute('data-user-updated_at');

            // Preenche os campos do modal com os dados do usuário
            viewModal.querySelector('.modal-user-name').textContent = userName;
            viewModal.querySelector('.modal-user-email').textContent = userEmail;
            viewModal.querySelector('.modal-user-phone').textContent = userPhone;
            viewModal.querySelector('.modal-user-cpf_cnpj').textContent = userCpfCnpj;
            viewModal.querySelector('.modal-user-cep').textContent = userCep;
            viewModal.querySelector('.modal-user-rua').textContent = userRua;
            viewModal.querySelector('.modal-user-bairro').textContent = userBairro;
            viewModal.querySelector('.modal-user-cidade').textContent = userCidade;
            viewModal.querySelector('.modal-user-role').textContent = userRole;
            viewModal.querySelector('.modal-user-created_at').textContent = userCreatedAt;
            viewModal.querySelector('.modal-user-updated_at').textContent = userUpdatedAt;

            // Abre o modal
            const modal = new bootstrap.Modal(viewModal);
            modal.show();
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Para o modal de visualização
    const viewButtons = document.querySelectorAll('.view-user-button');
    const viewModal = document.getElementById('view-modal');

    viewButtons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-user-id');
            const userName = this.getAttribute('data-user-name');
            const userEmail = this.getAttribute('data-user-email');
            const userPhone = this.getAttribute('data-user-phone');
            const userCpfCnpj = this.getAttribute('data-user-cpf_cnpj');
            const userCep = this.getAttribute('data-user-cep');
            const userRua = this.getAttribute('data-user-rua');
            const userBairro = this.getAttribute('data-user-bairro');
            const userCidade = this.getAttribute('data-user-cidade');
            const userRole = this.getAttribute('data-user-role');
            const userCreatedAt = this.getAttribute('data-user-created_at');
            const userUpdatedAt = this.getAttribute('data-user-updated_at');

            // Preenche os campos do modal com os dados do usuário
            viewModal.querySelector('.modal-user-name').textContent = userName;
            viewModal.querySelector('.modal-user-email').textContent = userEmail;
            viewModal.querySelector('.modal-user-phone').textContent = userPhone;
            viewModal.querySelector('.modal-user-cpf_cnpj').textContent = userCpfCnpj;
            viewModal.querySelector('.modal-user-cep').textContent = userCep;
            viewModal.querySelector('.modal-user-rua').textContent = userRua;
            viewModal.querySelector('.modal-user-bairro').textContent = userBairro;
            viewModal.querySelector('.modal-user-cidade').textContent = userCidade;
            viewModal.querySelector('.modal-user-role').textContent = userRole;
            viewModal.querySelector('.modal-user-created_at').textContent = userCreatedAt;
            viewModal.querySelector('.modal-user-updated_at').textContent = userUpdatedAt;

            // Abre o modal
            const modal = new bootstrap.Modal(viewModal);
            modal.show();
        });
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('[data-modal-toggle="edit-modal"]');
    const editModal = document.getElementById('edit-modal');
    const editForm = document.getElementById('edit-user-form');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-user-id');
            const userName = this.getAttribute('data-user-name');
            const userEmail = this.getAttribute('data-user-email');
            const userPhone = this.getAttribute('data-user-phone');
            const userCpfCnpj = this.getAttribute('data-user-cpf_cnpj');
            const userCep = this.getAttribute('data-user-cep');
            const userRua = this.getAttribute('data-user-rua');
            const userBairro = this.getAttribute('data-user-bairro');
            const userCidade = this.getAttribute('data-user-cidade');
            const userRole = this.getAttribute('data-user-role');

            // Preenche os campos do modal com os dados do usuário
            editModal.querySelector('input[name="name"]').value = userName;
            editModal.querySelector('input[name="email"]').value = userEmail;
            editModal.querySelector('input[name="phone"]').value = userPhone;
            editModal.querySelector('input[name="cpf_cnpj"]').value = userCpfCnpj;
            editModal.querySelector('input[name="cep"]').value = userCep;
            editModal.querySelector('input[name="rua"]').value = userRua;
            editModal.querySelector('input[name="bairro"]').value = userBairro;
            editModal.querySelector('input[name="cidade"]').value = userCidade;
            editModal.querySelector('select[name="role"]').value = userRole;

            // Define a action do formulário para o usuário específico
            editForm.action = `/users/${userId}`;

            // Adiciona evento blur no campo CEP do modal de edição
            const cepInput = editModal.querySelector('input[name="cep"]');
            cepInput.addEventListener('blur', function () {
                pesquisacep(this.value);
            });

            // Abre o modal (caso não esteja usando Bootstrap, pode precisar ajustar a lógica de abertura do modal)
            const modal = new bootstrap.Modal(editModal);
            modal.show();
        });
    });
});
