document.addEventListener('DOMContentLoaded', function () {
    console.log('carregado');

    // Função para limpar os campos de endereço
    function limpa_formulário_cep() {
        document.getElementById('eventStreet').value = "";
        document.getElementById('eventNeighborhood').value = "";
        document.getElementById('eventCity').value = "";
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

    // Função para limpar os campos de CNPJ
    function limpa_formulário_cnpj() {
        document.getElementById('eventCompany').value = "";
        document.getElementById('eventStreet').value = "";
        document.getElementById('eventNeighborhood').value = "";
        document.getElementById('eventCity').value = "";
        document.getElementById('eventCep').value = "";
        document.getElementById('visitorName').value = "";
    }

    // Callback para preencher os campos de CNPJ
    window.meu_callback_cnpj = function (conteudo) {
        if (!("errors" in conteudo)) {
            document.getElementById('eventCompany').value = conteudo.razao_social;
            document.getElementById('eventStreet').value = conteudo.logradouro;
            document.getElementById('eventNeighborhood').value = conteudo.bairro;
            document.getElementById('eventCity').value = conteudo.municipio;
            document.getElementById('eventCep').value = conteudo.cep.replace(/\D/g, '');

            // Encontrar o nome do sócio-administrador
            let socioAdministrador = "";
            if (conteudo.qsa && conteudo.qsa.length > 0) {
                const socio = conteudo.qsa.find(p => p.qual === "Sócio-Administrador");
                socioAdministrador = socio ? socio.nome : "";
            }
            document.getElementById('visitorName').value = socioAdministrador;
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
                document.getElementById('eventCompany').value = "...";
                document.getElementById('eventStreet').value = "...";
                document.getElementById('eventNeighborhood').value = "...";
                document.getElementById('eventCity').value = "...";
                document.getElementById('eventCep').value = "...";
                document.getElementById('visitorName').value = "...";

                fetch(`https://brasilapi.com.br/api/cnpj/v1/${cnpj}`)
                    .then(response => response.json())
                    .then(data => meu_callback_cnpj(data))
                    .catch(error => {
                        limpa_formulário_cnpj();
                        alert("CNPJ não encontrado.");
                    });
            } else {
                limpa_formulário_cnpj();
                alert("Formato de CNPJ inválido.");
            }
        } else {
            limpa_formulário_cnpj();
        }
    };

    // Adiciona o listener ao campo de input de CEP para buscar os dados ao perder o foco
    document.getElementById('eventCep').addEventListener('blur', function () {
        pesquisacep(this.value);
    });

    // Adiciona o listener ao campo de input de CNPJ para buscar os dados ao perder o foco
    document.getElementById('eventCpfCnpj').addEventListener('blur', function () {
        pesquisacnpj(this.value);
    });
});
