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
});
