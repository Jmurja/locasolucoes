function limpa_formulário_cep() {
    // Limpa valores do formulário de cep.
    document.getElementById('eventStreet').value = ("");
    document.getElementById('eventNeighborhood').value = ("");
    document.getElementById('eventCity').value = ("");
}

window.meu_callback = function (conteudo) {
    if (!("erro" in conteudo)) {
        // Atualiza os campos com os valores.
        document.getElementById('eventStreet').value = (conteudo.logradouro);
        document.getElementById('eventNeighborhood').value = (conteudo.bairro);
        document.getElementById('eventCity').value = (conteudo.localidade);
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
            document.getElementById('eventStreet').value = "...";
            document.getElementById('eventNeighborhood').value = "...";
            document.getElementById('eventCity').value = "...";

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

function limpa_formulário_cnpj() {
    // Limpa valores do formulário de cnpj.
    document.getElementById('eventResponsible').value = ("");
    document.getElementById('eventCompany').value = ("");
    document.getElementById('eventCep').value = ("");
    limpa_formulário_cep();
}

window.callback_cnpj = function (conteudo) {
    if (!("erro" in conteudo)) {
        // Atualiza os campos com os valores.
        document.getElementById('eventResponsible').value = (conteudo.qsa[0].nome);
        document.getElementById('eventCompany').value = (conteudo.nome);
        document.getElementById('eventCep').value = (conteudo.cep.replace(/\D/g, ''));
        pesquisacep(conteudo.cep.replace(/\D/g, '')); // Chama a função para buscar o endereço completo
    } else {
        // CNPJ não Encontrado.
        limpa_formulário_cnpj();
        alert("CNPJ não encontrado.");
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
            document.getElementById('eventCep').value = "...";
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
};
