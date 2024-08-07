document.addEventListener('DOMContentLoaded', function () {
    const editForm = document.getElementById('edit-form');
    const editFields = [
        {id: 'edit_user_id', minLength: 1},
        {id: 'edit_name', minLength: 3},
        {id: 'edit_description', minLength: 5},
        {id: 'edit_price_per_hour', minLength: 1},
        {id: 'edit_price_per_day', minLength: 1},
        {id: 'edit_price_per_month', minLength: 1},
        {id: 'edit_status', minLength: 1},
        {id: 'edit_rental_item_notes', minLength: 1},
    ];

    const editErrorMessages = {
        edit_user_id: 'Responsável é obrigatório.',
        edit_name: 'Nome é obrigatório e deve ter pelo menos 3 caracteres.',
        edit_description: 'Descrição é obrigatória e deve ter pelo menos 5 caracteres.',
        edit_price_per_hour: 'Valor por hora é obrigatório.',
        edit_price_per_day: 'Valor por dia é obrigatório.',
        edit_price_per_month: 'Valor por mês é obrigatório.',
        edit_status: 'Status é obrigatório.',
        edit_rental_item_notes: 'Observações são obrigatórias.'
    };

    const validateEditField = (field) => {
        const input = document.getElementById(field.id);
        const error = document.getElementById(`${field.id}-error`);
        if (input.value.trim().length < field.minLength) {
            input.classList.add('border-red-500');
            error.textContent = editErrorMessages[field.id];
            error.classList.remove('hidden');
            return false;
        } else {
            input.classList.remove('border-red-500');
            error.textContent = '';
            error.classList.add('hidden');
            return true;
        }
    };

    editFields.forEach(field => {
        const input = document.getElementById(field.id);
        input.addEventListener('blur', () => validateEditField(field));
        input.addEventListener('input', () => validateEditField(field));
    });

    editForm.addEventListener('submit', function (event) {
        let isValid = true;
        editFields.forEach(field => {
            if (!validateEditField(field)) {
                isValid = false;
            }
        });

        if (!isValid) {
            event.preventDefault();
        }
    });
});
