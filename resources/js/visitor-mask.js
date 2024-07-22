document.addEventListener("DOMContentLoaded", function () {
    function setMask(input, maskFunction) {
        input.addEventListener('input', maskFunction);
    }

    function maskCpfCnpj(value) {
        value = value.replace(/\D/g, '');
        if (value.length <= 11) {
            value = value.replace(/(\d{3})(\d)/, "$1.$2");
            value = value.replace(/(\d{3})(\d)/, "$1.$2");
            value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
        } else {
            value = value.replace(/^(\d{2})(\d)/, "$1.$2");
            value = value.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
            value = value.replace(/\.(\d{3})(\d)/, ".$1/$2");
            value = value.replace(/(\d{4})(\d)/, "$1-$2");
        }
        return value;
    }

    function maskPhone(value) {
        value = value.replace(/\D/g, '');
        value = value.replace(/(\d{2})(\d)/, "($1) $2");
        value = value.replace(/(\d{5})(\d)/, "$1-$2");
        return value;
    }

    function maskCep(value) {
        value = value.replace(/\D/g, '');
        value = value.replace(/(\d{5})(\d)/, "$1-$2");
        return value;
    }

    function maskDate(value) {
        value = value.replace(/\D/g, '');
        value = value.replace(/(\d{2})(\d)/, "$1/$2");
        value = value.replace(/(\d{2})(\d)/, "$1/$2");
        value = value.replace(/(\d{4})(\d)/, "$1$2");
        return value;
    }

    function applyMask(event) {
        const {target} = event;
        if (target.id === 'eventCpfCnpj') {
            target.value = maskCpfCnpj(target.value);
        } else if (target.id === 'visitorPhone') {
            target.value = maskPhone(target.value);
        } else if (target.id === 'eventCep') {
            target.value = maskCep(target.value);
        } else if (target.id === 'datepicker-range-start' || target.id === 'datepicker-range-end') {
            target.value = maskDate(target.value);
        }
    }

    const cpfCnpjField = document.getElementById('eventCpfCnpj');
    const phoneField = document.getElementById('visitorPhone');
    const cepField = document.getElementById('eventCep');
    const startDateField = document.getElementById('datepicker-range-start');
    const endDateField = document.getElementById('datepicker-range-end');

    [cpfCnpjField, phoneField, cepField, startDateField, endDateField].forEach(field => {
        if (field) {
            field.addEventListener('input', applyMask);
        }
    });
});
