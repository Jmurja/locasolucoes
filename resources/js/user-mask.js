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

    window.meu_callback = function (conteudo) {
        if (!("erro" in conteudo)) {
            if (!document.getElementById('rua').value) document.getElementById('rua').value = conteudo.logradouro;
            if (!document.getElementById('bairro').value) document.getElementById('bairro').value = conteudo.bairro;
            if (!document.getElementById('cidade').value) document.getElementById('cidade').value = conteudo.localidade;
        }
    }

    window.pesquisacep = function (valor) {
        var cep = valor.replace(/\D/g, '');

        if (cep !== "") {
            var validacep = /^[0-9]{8}$/;

            if (validacep.test(cep)) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => meu_callback(data))
                    .catch(error => {
                    });
            }
        }
    };

    window.meu_callback_cnpj = function (conteudo) {
        if (!("errors" in conteudo)) {
            if (!document.getElementById('company').value) document.getElementById('company').value = conteudo.razao_social;
            if (!document.getElementById('rua').value) document.getElementById('rua').value = conteudo.logradouro;
            if (!document.getElementById('bairro').value) document.getElementById('bairro').value = conteudo.bairro;
            if (!document.getElementById('cidade').value) document.getElementById('cidade').value = conteudo.municipio;
            if (!document.getElementById('cep').value) document.getElementById('cep').value = conteudo.cep.replace(/\D/g, '');

            let socioAdministrador = "";
            if (conteudo.qsa && conteudo.qsa.length > 0) {
                const socio = conteudo.qsa.find(p => p.qual === "Sócio-Administrador");
                socioAdministrador = socio ? socio.nome : "";
            }
            if (!document.getElementById('name').value) document.getElementById('name').value = socioAdministrador;
        }
    }

    window.pesquisacnpj = function (valor) {
        var cnpj = valor.replace(/\D/g, '');

        if (cnpj !== "") {
            var validacnpj = /^[0-9]{14}$/;

            if (validacnpj.test(cnpj)) {
                fetch(`https://brasilapi.com.br/api/cnpj/v1/${cnpj}`)
                    .then(response => response.json())
                    .then(data => meu_callback_cnpj(data))
                    .catch(error => {
                    });
            }
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
