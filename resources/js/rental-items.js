import SimpleMaskMoney from 'simple-mask-money';

const optionsUSD = {
    negativeSignAfter: false,
    prefix: 'R$',
    suffix: '',
    fixed: true,
    fractionDigits: 2,
    decimalSeparator: ',',
    thousandsSeparator: '.',
    cursor: 'end'
};

document.addEventListener('DOMContentLoaded', function () {
    const priceFieldsCreate = [
        document.getElementById('price_per_hour'),
        document.getElementById('price_per_day'),
        document.getElementById('price_per_month')
    ];

    function applyMaskToFields(fields) {
        fields.forEach(field => {
            if (field && !field.dataset.maskApplied) {
                SimpleMaskMoney.setMask(field, optionsUSD);
                field.dataset.maskApplied = 'true';
            }
        });
    }

    function convertFieldsToNumber(fields) {
        fields.forEach(field => {
            field.value = SimpleMaskMoney.formatToNumber(field.value);
        });
    }

    function validateFields(itemId) {
        const name = document.getElementById(`edit_name_${itemId}`).value;
        const nameError = document.getElementById(`name-error_${itemId}`);
        nameError.classList.toggle('hidden', name.trim() !== '' && name.length >= 3);

        const description = document.getElementById(`edit_description_${itemId}`).value;
        const descriptionError = document.getElementById(`description-error_${itemId}`);
        descriptionError.classList.toggle('hidden', description.trim() !== '' && description.length >= 5);
    }

    function addValidationListeners(itemId) {
        document.getElementById(`edit_name_${itemId}`).addEventListener('input', () => validateFields(itemId));
        document.getElementById(`edit_name_${itemId}`).addEventListener('blur', () => validateFields(itemId));

        document.getElementById(`edit_description_${itemId}`).addEventListener('input', () => validateFields(itemId));
        document.getElementById(`edit_description_${itemId}`).addEventListener('blur', () => validateFields(itemId));

        const priceFields = [
            document.getElementById(`edit_price_per_hour_${itemId}`),
            document.getElementById(`edit_price_per_day_${itemId}`),
            document.getElementById(`edit_price_per_month_${itemId}`)
        ];

        priceFields.forEach(field => {
            field.addEventListener('input', () => validateFields(itemId));
            field.addEventListener('blur', () => validateFields(itemId));
        });
    }

    function setupFormSubmission(formId, priceFields) {
        const form = document.getElementById(formId);
        form.addEventListener('submit', function (event) {
            const itemId = formId.split('-').pop(); // Obtem o ID a partir do formId
            validateFields(itemId);
            const errors = document.querySelectorAll('.error:not(.hidden)');
            if (errors.length > 0) {
                event.preventDefault();
            } else {
                convertFieldsToNumber(priceFields);
            }
        });
    }

    function centerModals() {
        document.querySelectorAll('.modal').forEach(modal => {
            modal.style.display = 'flex';
            modal.style.alignItems = 'center';
            modal.style.justifyContent = 'center';
        });
    }

    applyMaskToFields(priceFieldsCreate);

    document.querySelectorAll('.edit-item-btn').forEach(button => {
        button.addEventListener('click', async () => {
            const itemId = button.getAttribute('data-id');
            const response = await fetch(`/rental-items/${itemId}`);
            const data = await response.json();

            document.getElementById(`edit_user_id_${itemId}`).value = data.user_id;
            document.getElementById(`edit_name_${itemId}`).value = data.name;
            document.getElementById(`edit_description_${itemId}`).value = data.description;
            document.getElementById(`edit_price_per_hour_${itemId}`).value = data.price_per_hour;
            document.getElementById(`edit_price_per_day_${itemId}`).value = data.price_per_day;
            document.getElementById(`edit_price_per_month_${itemId}`).value = data.price_per_month;
            document.getElementById(`edit_status_${itemId}`).value = data.status;
            document.getElementById(`edit_rental_item_notes_${itemId}`).value = data.rental_item_notes;

            const priceFieldsUpdate = [
                document.getElementById(`edit_price_per_hour_${itemId}`),
                document.getElementById(`edit_price_per_day_${itemId}`),
                document.getElementById(`edit_price_per_month_${itemId}`)
            ];

            applyMaskToFields(priceFieldsUpdate);
            addValidationListeners(itemId);
            setupFormSubmission(`edit-form-${itemId}`, priceFieldsUpdate);

            const editModal = document.getElementById(`edit-modal-${itemId}`);
            centerModals(); // Centraliza o modal
            editModal.classList.remove('hidden');
            editModal.setAttribute('aria-hidden', 'false');
            editModal.setAttribute('role', 'dialog');
        });
    });

    document.querySelectorAll('[data-modal-toggle^="edit-modal"]').forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-toggle').split('-').pop();
            const editModal = document.getElementById(`edit-modal-${modalId}`);
            editModal.classList.add('hidden');
            editModal.setAttribute('aria-hidden', 'true');
            editModal.removeAttribute('role');
        });
    });

    document.querySelectorAll('.delete-item-btn').forEach(button => {
        button.addEventListener('click', async () => {
            const itemId = button.getAttribute('data-id');
            const deleteForm = document.querySelector('#delete-modal form');
            deleteForm.action = `/rental-items/${itemId}`;

            const deleteModal = document.getElementById('delete-modal');
            deleteModal.classList.remove('hidden');
            deleteModal.setAttribute('aria-hidden', 'false');
            deleteModal.setAttribute('role', 'dialog');
        });
    });

    document.querySelectorAll('[data-modal-hide="delete-modal"]').forEach(button => {
        button.addEventListener('click', () => {
            const deleteModal = document.getElementById('delete-modal');
            deleteModal.classList.add('hidden');
            deleteModal.setAttribute('aria-hidden', 'true');
            deleteModal.removeAttribute('role');
        });
    });
});
