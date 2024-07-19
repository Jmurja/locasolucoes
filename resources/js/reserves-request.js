document.addEventListener('DOMContentLoaded', function () {
    console.log('carregado');

    // Função para limpar os campos de endereço
    function limpa_formulário_cep() {
        document.getElementById('eventStreet').value = "";
        document.getElementById('eventNeighborhood').value = "";
        document.getElementById('eventCity').value = "";
    }

    // Função para limpar os campos de CNPJ
    function limpa_formulário_cnpj() {
        document.getElementById('eventResponsible').value = "";
        document.getElementById('eventCompany').value = "";
        document.getElementById('eventCep').value = "";
        limpa_formulário_cep();
    }

    // Callback para preencher os campos de endereço
    window.meu_callback = function (conteudo) {
        if (!("erro" in conteudo)) {
            document.getElementById('eventStreet').value = conteudo.logradouro;
            document.getElementById('eventNeighborhood').value = conteudo.bairro;
            document.getElementById('eventCity').value = conteudo.localidade;
        } else {
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    // Função para buscar o CEP
    window.pesquisacep = function (valor) {
        var cep = valor.replace(/\D/g, '');

        if (cep !== "") {
            var validacep = /^[0-9]{8}$/;

            if (validacep.test(cep)) {
                document.getElementById('eventStreet').value = "...";
                document.getElementById('eventNeighborhood').value = "...";
                document.getElementById('eventCity').value = "...";

                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => meu_callback(data))
                    .catch(error => {
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    });
            } else {
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } else {
            limpa_formulário_cep();
        }
    };

    // Callback para preencher os campos de CNPJ
    window.callback_cnpj = function (conteudo) {
        if (!("erro" in conteudo)) {
            document.getElementById('eventResponsible').value = conteudo.qsa[0].nome;
            document.getElementById('eventCompany').value = conteudo.nome;
            document.getElementById('eventCep').value = conteudo.cep.replace(/\D/g, '');
            pesquisacep(conteudo.cep.replace(/\D/g, ''));
        } else {
            limpa_formulário_cnpj();
            alert("CNPJ não encontrado.");
        }
    }

    // Função para buscar o CNPJ
    window.pesquisacnpj = function (valor) {
        var cnpj = valor.replace(/\D/g, '');

        if (cnpj !== "") {
            var validacnpj = /^[0-9]{14}$/;

            if (validacnpj.test(cnpj)) {
                document.getElementById('eventResponsible').value = "...";
                document.getElementById('eventCompany').value = "...";
                document.getElementById('eventCep').value = "...";
                limpa_formulário_cep();

                fetch(`https://www.receitaws.com.br/v1/cnpj/${cnpj}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('CNPJ não encontrado.');
                        }
                        return response.json();
                    })
                    .then(data => callback_cnpj(data))
                    .catch(error => {
                        limpa_formulário_cnpj();
                        alert(error.message);
                    });
            } else {
                limpa_formulário_cnpj();
                alert("Formato de CNPJ inválido.");
            }
        } else {
            limpa_formulário_cnpj();
        }
    };

    // Adiciona o listener ao campo de input de CNPJ para buscar os dados ao perder o foco
    document.getElementById('eventCpfCnpj').addEventListener('blur', function () {
        pesquisacnpj(this.value);
    });
});
