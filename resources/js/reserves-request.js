function limpa_formulário_cep() {
    document.getElementById('eventStreet').value = ("");
    document.getElementById('eventNeighborhood').value = ("");
    document.getElementById('eventCity').value = ("");
}

window.meu_callback = function (conteudo) {
    if (!("erro" in conteudo)) {
        document.getElementById('eventStreet').value = (conteudo.logradouro);
        document.getElementById('eventNeighborhood').value = (conteudo.bairro);
        document.getElementById('eventCity').value = (conteudo.localidade);
    } else {
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}

window.pesquisacep = function (valor) {
    var cep = valor.replace(/\D/g, '');

    if (cep != "") {
        var validacep = /^[0-9]{8}$/;

        if (validacep.test(cep)) {
            document.getElementById('eventStreet').value = "...";
            document.getElementById('eventNeighborhood').value = "...";
            document.getElementById('eventCity').value = "...";

            var script = document.createElement('script');

            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

            document.body.appendChild(script);
        } else {
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } else {
        limpa_formulário_cep();
    }
};

function limpa_formulário_cnpj() {
    document.getElementById('eventResponsible').value = ("");
    document.getElementById('eventCompany').value = ("");
    document.getElementById('eventCep').value = ("");
    limpa_formulário_cep();
}

window.callback_cnpj = function (conteudo) {
    if (!("erro" in conteudo)) {
        document.getElementById('eventResponsible').value = (conteudo.qsa[0].nome);
        document.getElementById('eventCompany').value = (conteudo.nome);
        document.getElementById('eventCep').value = (conteudo.cep.replace(/\D/g, ''));
        pesquisacep(conteudo.cep.replace(/\D/g, '')); // Chama a função para buscar o endereço completo
    } else {
        limpa_formulário_cnpj();
        alert("CNPJ não encontrado.");
    }
}

window.pesquisacnpj = function (valor) {
    var cnpj = valor.replace(/\D/g, '');

    if (cnpj != "") {
        var validacnpj = /^[0-9]{14}$/;

        if (validacnpj.test(cnpj)) {
            document.getElementById('eventResponsible').value = "...";
            document.getElementById('eventCompany').value = "...";
            document.getElementById('eventCep').value = "...";
            limpa_formulário_cep();

            var script = document.createElement('script');

            script.src = 'https://www.receitaws.com.br/v1/cnpj/' + cnpj + '?callback=callback_cnpj';

            document.body.appendChild(script);
        } else {
            limpa_formulário_cnpj();
            alert("Formato de CNPJ inválido.");
        }
    } else {
        limpa_formulário_cnpj();
    }
};
