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

    function validateFields() {
        const name = document.getElementById('edit_name').value;
        const nameError = document.getElementById('name-error');
        nameError.classList.toggle('hidden', name.trim() !== '' && name.length >= 3);

        const description = document.getElementById('edit_description').value;
        const descriptionError = document.getElementById('description-error');
        descriptionError.classList.toggle('hidden', description.trim() !== '' && description.length >= 5);
    }

    function addValidationListeners() {
        document.getElementById('edit_name').addEventListener('input', validateFields);
        document.getElementById('edit_name').addEventListener('blur', validateFields);

        document.getElementById('edit_description').addEventListener('input', validateFields);
        document.getElementById('edit_description').addEventListener('blur', validateFields);

        const priceFields = [
            document.getElementById('edit_price_per_hour'),
            document.getElementById('edit_price_per_day'),
            document.getElementById('edit_price_per_month')
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
            const response = await fetch(`/itens-locacao/${itemId}`);
            const data = await response.json();

            document.getElementById('edit-form').action = `/itens-locacao/${itemId}`;
            document.getElementById('edit_user_id').value = data.user_id;
            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_description').value = data.description;
            document.getElementById('edit_price_per_hour').value = data.price_per_hour;
            document.getElementById('edit_price_per_day').value = data.price_per_day;
            document.getElementById('edit_price_per_month').value = data.price_per_month;
            document.getElementById('edit_status').value = data.status;
            document.getElementById('edit_rental_item_notes').value = data.rental_item_notes;

            const priceFieldsUpdate = [
                document.getElementById('edit_price_per_hour'),
                document.getElementById('edit_price_per_day'),
                document.getElementById('edit_price_per_month')
            ];

            applyMaskToFields(priceFieldsUpdate);
            addValidationListeners();
            setupFormSubmission('edit-form', priceFieldsUpdate);

            const editModal = document.getElementById('edit-modal');
            centerModals(); // Centraliza o modal
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
            deleteForm.action = `/itens-locacao/${itemId}`;
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

    // Função para buscar e preencher os dados no modal de visualização
    async function fetchAndPopulateViewModal(itemId) {
        const response = await fetch(`/itens-locacao/${itemId}`);
        const data = await response.json();

        const modal = document.getElementById('view-modal');
        modal.querySelector('[data-field="name"]').innerText = data.name;
        modal.querySelector('[data-field="status"]').innerText = data.status;
        modal.querySelector('[data-field="description"]').innerText = data.description;
        modal.querySelector('[data-field="price_per_hour"]').innerText = `R$ ${data.price_per_hour}`;
        modal.querySelector('[data-field="price_per_day"]').innerText = `R$ ${data.price_per_day}`;
        modal.querySelector('[data-field="price_per_month"]').innerText = `R$ ${data.price_per_month}`;
        modal.querySelector('[data-field="rental_item_notes"]').innerText = data.rental_item_notes;

        modal.classList.remove('hidden');
        modal.setAttribute('aria-hidden', 'false');
        modal.setAttribute('role', 'dialog');
    }

    // Event listener para botões que abrem o modal de visualização
    document.querySelectorAll('.view-item-btn').forEach(button => {
        button.addEventListener('click', () => {
            const itemId = button.getAttribute('data-id');
            fetchAndPopulateViewModal(itemId);
        });
    });

    // Event listener para o botão de fechar o modal
    document.querySelectorAll('[data-modal-toggle="view-modal"]').forEach(button => {
        button.addEventListener('click', () => {
            const viewModal = document.getElementById('view-modal');
            viewModal.classList.add('hidden');
            viewModal.setAttribute('aria-hidden', 'true');
            viewModal.removeAttribute('role');
        });
    });
});
