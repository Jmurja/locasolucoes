document.addEventListener('DOMContentLoaded', function () {
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

    applyPhoneMask(document.getElementById('phone'));
    applyCepMask(document.getElementById('cep'));
    applyCpfCnpjMask(document.getElementById('cpf_cnpj'));

    function applyMasksToEditModal() {
        applyPhoneMask(document.getElementById('edit-phone'));
        applyCepMask(document.getElementById('edit-cep'));
        applyCpfCnpjMask(document.getElementById('edit-cpf_cnpj'));
    }

    document.querySelector('[data-modal-toggle="edit-modal"]').addEventListener('click', function () {
        applyMasksToEditModal();
    });

    document.getElementById('edit-modal').addEventListener('show.bs.modal', function () {
        applyMasksToEditModal();
    });

    function limpa_formulário_cep() {
        document.getElementById('rua').value = "";
        document.getElementById('bairro').value = "";
        document.getElementById('cidade').value = "";
    }

    window.meu_callback = function (conteudo) {
        if (!("erro" in conteudo)) {
            document.getElementById('rua').value = conteudo.logradouro;
            document.getElementById('bairro').value = conteudo.bairro;
            document.getElementById('cidade').value = conteudo.localidade;
        } else {
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    window.pesquisacep = function (valor) {
        var cep = valor.replace(/\D/g, '');

        if (cep !== "") {
            var validacep = /^[0-9]{8}$/;

            if (validacep.test(cep)) {
                document.getElementById('rua').value = "...";
                document.getElementById('bairro').value = "...";
                document.getElementById('cidade').value = "...";

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

    function limpa_formulário_cnpj() {
        document.getElementById('company').value = "";
        document.getElementById('rua').value = "";
        document.getElementById('bairro').value = "";
        document.getElementById('cidade').value = "";
        document.getElementById('cep').value = "";
        document.getElementById('name').value = "";
    }

    window.meu_callback_cnpj = function (conteudo) {
        if (!("errors" in conteudo)) {
            document.getElementById('company').value = conteudo.razao_social;
            document.getElementById('rua').value = conteudo.logradouro;
            document.getElementById('bairro').value = conteudo.bairro;
            document.getElementById('cidade').value = conteudo.municipio;
            document.getElementById('cep').value = conteudo.cep.replace(/\D/g, '');

            let socioAdministrador = "";
            if (conteudo.qsa && conteudo.qsa.length > 0) {
                const socio = conteudo.qsa.find(p => p.qual === "Sócio-Administrador");
                socioAdministrador = socio ? socio.nome : "";
            }
            document.getElementById('name').value = socioAdministrador;
        } else {
            limpa_formulário_cnpj();
            alert("CNPJ não encontrado.");
        }
    }

    window.pesquisacnpj = function (valor) {
        var cnpj = valor.replace(/\D/g, '');

        if (cnpj !== "") {
            var validacnpj = /^[0-9]{14}$/;

            if (validacnpj.test(cnpj)) {
                document.getElementById('company').value = "...";
                document.getElementById('rua').value = "...";
                document.getElementById('bairro').value = "...";
                document.getElementById('cidade').value = "...";
                document.getElementById('cep').value = "...";
                document.getElementById('name').value = "...";

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

    document.getElementById('cep').addEventListener('blur', function () {
        pesquisacep(this.value);
    });

    document.getElementById('cpf_cnpj').addEventListener('blur', function () {
        pesquisacnpj(this.value);
    });

    document.getElementById('user-form').addEventListener('submit', function (event) {
        const role = document.getElementById('role');
        const roleError = document.getElementById('role-error');

        if (role.value === 'Selecione a Categoria' || role.value === '') {
            event.preventDefault();
            roleError.classList.remove('hidden');
        } else {
            roleError.classList.add('hidden');
        }
    });
});
