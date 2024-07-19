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

    const priceFieldsUpdate = [
        document.getElementById('edit_price_per_hour'),
        document.getElementById('edit_price_per_day'),
        document.getElementById('edit_price_per_month')
    ];

    function applyMaskToFields(fields) {
        fields.forEach(field => {
            if (!field.dataset.maskApplied) {
                SimpleMaskMoney.setMask(field, optionsUSD);
                field.dataset.maskApplied = 'true';
            }
        });
    }

    function convertFieldsToNumber(fields) {
        fields.forEach(field => field.value = SimpleMaskMoney.formatToNumber(field.value));
    }

    function validateFields() {
        const name = document.getElementById('name').value;
        const nameError = document.getElementById('name-error');
        nameError.classList.toggle('hidden', name.trim() !== '' && name.length >= 3);

        const description = document.getElementById('description').value;
        const descriptionError = document.getElementById('description-error');
        descriptionError.classList.toggle('hidden', description.trim() !== '' && description.length >= 5);

        const priceFields = [
            document.getElementById('price_per_hour'),
            document.getElementById('price_per_day'),
            document.getElementById('price_per_month')
        ];

        priceFields.forEach(field => {
            const priceError = document.getElementById(`${field.id}-error`);
            priceError.classList.toggle('hidden', !isNaN(field.value) && field.value.trim() !== '');
        });

        const valueError = document.getElementById('value-error');
        const allPricesEmpty = priceFields.every(field => field.value.trim() === '');
        valueError.classList.toggle('hidden', !allPricesEmpty);
    }

    function addValidationListeners() {
        document.getElementById('name').addEventListener('input', validateFields);
        document.getElementById('name').addEventListener('blur', validateFields);

        document.getElementById('description').addEventListener('input', validateFields);
        document.getElementById('description').addEventListener('blur', validateFields);

        const priceFields = [
            document.getElementById('price_per_hour'),
            document.getElementById('price_per_day'),
            document.getElementById('price_per_month')
        ];

        priceFields.forEach(field => {
            field.addEventListener('input', validateFields);
            field.addEventListener('blur', validateFields);
        });
    }

    function setupFormSubmission(formId, priceFields) {
        const form = document.getElementById(formId);
        form.addEventListener('submit', function (event) {
            validateFields();
            const errors = document.querySelectorAll('.error:not(.hidden)');
            if (errors.length > 0) {
                event.preventDefault();
            } else {
                convertFieldsToNumber(priceFields);
            }
        });
    }

    applyMaskToFields(priceFieldsCreate);
    addValidationListeners();
    setupFormSubmission('rental-form', priceFieldsCreate);

    document.querySelectorAll('[data-modal-toggle="edit-modal"]').forEach(button => {
        button.addEventListener('click', () => {
            applyMaskToFields(priceFieldsUpdate);
        });
    });

    setupFormSubmission('edit-form', priceFieldsUpdate);

    document.querySelectorAll('.view-item-btn').forEach(button => {
        button.addEventListener('click', async () => {
            const itemId = button.getAttribute('data-id');
            const response = await fetch(`/rental-items/${itemId}`);
            const data = await response.json();

            document.querySelector('#view-modal dd[data-field="name"]').innerText = data.name;
            document.querySelector('#view-modal dd[data-field="description"]').innerText = data.description;
            document.querySelector('#view-modal dd[data-field="price_per_hour"]').innerText = `R$ ${data.price_per_hour}`;
            document.querySelector('#view-modal dd[data-field="price_per_day"]').innerText = `R$ ${data.price_per_day}`;
            document.querySelector('#view-modal dd[data-field="price_per_month"]').innerText = `R$ ${data.price_per_month}`;
            document.querySelector('#view-modal dd[data-field="status"]').innerText = data.status;
            document.querySelector('#view-modal dd[data-field="rental_item_notes"]').innerText = data.rental_item_notes;

            const viewModal = document.getElementById('view-modal');
            viewModal.classList.remove('hidden');
            viewModal.setAttribute('aria-hidden', 'false');
            viewModal.setAttribute('role', 'dialog');
        });
    });

    document.querySelectorAll('[data-modal-toggle="view-modal"]').forEach(button => {
        button.addEventListener('click', () => {
            const viewModal = document.getElementById('view-modal');
            viewModal.classList.add('hidden');
            viewModal.setAttribute('aria-hidden', 'true');
            viewModal.removeAttribute('role');
        });
    });

    document.querySelectorAll('.edit-item-btn').forEach(button => {
        button.addEventListener('click', async () => {
            const itemId = button.getAttribute('data-id');
            const response = await fetch(`/rental-items/${itemId}`);
            const data = await response.json();

            document.getElementById('edit_user_id').value = data.user_id;
            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_description').value = data.description;
            document.getElementById('edit_price_per_hour').value = data.price_per_hour;
            document.getElementById('edit_price_per_day').value = data.price_per_day;
            document.getElementById('edit_price_per_month').value = data.price_per_month;
            document.getElementById('edit_status').value = data.status;
            document.getElementById('edit_rental_item_notes').value = data.rental_item_notes;

            const editModal = document.getElementById('edit-modal');
            editModal.classList.remove('hidden');
            editModal.setAttribute('aria-hidden', 'false');
            editModal.setAttribute('role', 'dialog');
        });
    });

    document.querySelectorAll('[data-modal-toggle="edit-modal"]').forEach(button => {
        button.addEventListener('click', () => {
            const editModal = document.getElementById('edit-modal');
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
