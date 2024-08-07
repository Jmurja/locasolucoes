document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('rental-form');
    const fields = [
        {id: 'user_id', minLength: 1},
        {id: 'name', minLength: 3},
        {id: 'description', minLength: 5},
        {id: 'price_per_hour', minLength: 1},
        {id: 'price_per_day', minLength: 1},
        {id: 'price_per_month', minLength: 1},
        {id: 'status', minLength: 1},
        {id: 'rental_item_notes', minLength: 1},
    ];

    const errorMessages = {
        user_id: 'Responsável é obrigatório.',
        name: 'Nome é obrigatório e deve ter pelo menos 3 caracteres.',
        description: 'Descrição é obrigatória e deve ter pelo menos 5 caracteres.',
        price_per_hour: 'Valor por hora é obrigatório.',
        price_per_day: 'Valor por dia é obrigatório.',
        price_per_month: 'Valor por mês é obrigatório.',
        status: 'Status é obrigatório.',
        rental_item_notes: 'Observações são obrigatórias.'
    };

    const validateField = (field) => {
        const input = document.getElementById(field.id);
        const error = document.getElementById(`${field.id}-error`);
        if (input.value.trim().length < field.minLength) {
            input.classList.add('border-red-500');
            error.textContent = errorMessages[field.id];
            error.classList.remove('hidden');
            return false;
        } else {
            input.classList.remove('border-red-500');
            error.textContent = '';
            error.classList.add('hidden');
            return true;
        }
    };

    fields.forEach(field => {
        const input = document.getElementById(field.id);
        input.addEventListener('blur', () => validateField(field));
        input.addEventListener('input', () => validateField(field));
    });

    form.addEventListener('submit', function (event) {
        let isValid = true;
        fields.forEach(field => {
            if (!validateField(field)) {
                isValid = false;
            }
        });

        if (!isValid) {
            event.preventDefault();
        }
    });
});
