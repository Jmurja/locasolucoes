console.log('arquivo carregado');

function limpa_formulário_cep() {
    // Limpa valores do formulário de cep.
    document.getElementById('rua').value = ("");
    document.getElementById('bairro').value = ("");
    document.getElementById('cidade').value = ("");
}

function limpa_formulário_cnpj() {
    // Limpa valores do formulário de cnpj.
    document.getElementById('eventResponsible').value = ("");
    document.getElementById('eventCompany').value = ("");
    document.getElementById('cep').value = ("");
    limpa_formulário_cep();
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

window.callback_cnpj = function (conteudo) {
    if (!("erro" in conteudo)) {
        // Atualiza os campos com os valores.
        document.getElementById('eventResponsible').value = (conteudo.qsa[0].nome);
        document.getElementById('eventCompany').value = (conteudo.nome);
        document.getElementById('cep').value = (conteudo.cep.replace(/\D/g, ''));
        pesquisacep(conteudo.cep.replace(/\D/g, '')); // Chama a função para buscar o endereço completo
    } else {
        // CNPJ não Encontrado.
        limpa_formulário_cnpj();
        alert("CNPJ não encontrado.");
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
}

window.pesquisacnpj = function (valor) {
    // Nova variável "cnpj" somente com dígitos.
    var cnpj = valor.replace(/\D/g, '');

    // Verifica se campo cnpj possui valor informado.
    if (cnpj != "") {
        // Expressão regular para validar o CNPJ.
        var validacnpj = /^[0-9]{14}$/;

        // Valida o formato do CNPJ.
        if (validacnpj.test(cnpj)) {
            // Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('eventResponsible').value = "...";
            document.getElementById('eventCompany').value = "...";
            document.getElementById('cep').value = "...";
            limpa_formulário_cep();

            // Cria um elemento javascript.
            var script = document.createElement('script');

            // Sincroniza com o callback.
            script.src = 'https://www.receitaws.com.br/v1/cnpj/' + cnpj + '?callback=callback_cnpj';

            // Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);
        } else {
            // cnpj é inválido.
            limpa_formulário_cnpj();
            alert("Formato de CNPJ inválido.");
        }
    } else {
        // cnpj sem valor, limpa formulário.
        limpa_formulário_cnpj();
    }
}

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
    cpfCnpjInput.addEventListener('blur', () => pesquisacnpj(cpfCnpjInput.value)); // Remove validação, apenas pesquisa CNPJ
    cpfCnpjInput.addEventListener('input', () => clearError(cpfCnpjInput)); // Limpa erro ao digitar
    passwordInput.addEventListener('blur', () => validateInput(passwordInput, 'password'));
    passwordInput.addEventListener('input', () => validateInput(passwordInput, 'password'));
    cepInput.addEventListener('blur', () => validateInput(cepInput, 'cep'));
    cepInput.addEventListener('input', () => validateInput(cepInput, 'cep'));

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const isNameValid = validateInput(nameInput, 'name');
        const isEmailValid = validateInput(emailInput, 'email');
        const isPhoneValid = validateInput(phoneInput, 'phone');
        const isPasswordValid = validateInput(passwordInput, 'password');
        const isCepValid = validateInput(cepInput, 'cep');

        if (isNameValid && isEmailValid && isPhoneValid && isPasswordValid && isCepValid) {
            form.submit();
        }
    });
});
