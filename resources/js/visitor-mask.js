document.addEventListener("DOMContentLoaded", function () {
    const reserveForm = document.getElementById('reserveForm');

    reserveForm.addEventListener('input', applyMask);
    reserveForm.addEventListener('blur', validateField, true);
    reserveForm.addEventListener('submit', validateForm);

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

    function validateField(event) {
        const {target} = event;
        if (!target.checkValidity()) {
            target.classList.add('border-red-500');
            document.getElementById(target.id + 'Error').classList.remove('hidden');
        } else {
            target.classList.remove('border-red-500');
            document.getElementById(target.id + 'Error').classList.add('hidden');
        }
    }

    function validateForm(event) {
        const inputs = reserveForm.querySelectorAll('input[required], textarea[required], select[required]');
        let valid = true;

        inputs.forEach(input => {
            if (!input.checkValidity()) {
                valid = false;
                input.classList.add('border-red-500');
                document.getElementById(input.id + 'Error').classList.remove('hidden');
            }
        });

        if (!valid) {
            event.preventDefault();
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
