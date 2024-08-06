import SimpleMaskMoney from 'simple-mask-money';

document.addEventListener('DOMContentLoaded', function () {
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
            field.value = SimpleMaskMoney.formatToNumber(field.value).toFixed(2);
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
        const nameField = document.getElementById('edit_name');
        const descriptionField = document.getElementById('edit_description');

        if (nameField) {
            nameField.addEventListener('input', validateFields);
            nameField.addEventListener('blur', validateFields);
        }

        if (descriptionField) {
            descriptionField.addEventListener('input', validateFields);
            descriptionField.addEventListener('blur', validateFields);
        }

        const priceFields = [
            document.getElementById('edit_price_per_hour'),
            document.getElementById('edit_price_per_day'),
            document.getElementById('edit_price_per_month'),
            document.getElementById('price_per_hour'),
            document.getElementById('price_per_day'),
            document.getElementById('price_per_month')
        ];

        priceFields.forEach(field => {
            if (field) {
                field.addEventListener('input', validateFields);
                field.addEventListener('blur', validateFields);
            }
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

    document.querySelectorAll('.edit-item-btn').forEach(button => {
        button.addEventListener('click', async () => {
            const rentalItem = button.getAttribute('data-id');
            try {
                const response = await fetch(`/api/itens-locacao/${rentalItem}`);
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();
                console.log('data', data)

                document.getElementById('edit-form').action = `/itens-locacao/${rentalItem}`;
                document.getElementById('edit_user_id').value = data.user_id;
                document.getElementById('edit_name').value = data.name;
                document.getElementById('edit_description').value = data.description;
                document.getElementById('edit_price_per_hour').value = SimpleMaskMoney.formatToCurrency(data.price_per_hour, optionsUSD);
                document.getElementById('edit_price_per_day').value = SimpleMaskMoney.formatToCurrency(data.price_per_day, optionsUSD);
                document.getElementById('edit_price_per_month').value = SimpleMaskMoney.formatToCurrency(data.price_per_month, optionsUSD);
                document.getElementById('edit_status').value = data.status;
                document.getElementById('edit_rental_item_notes').value = data.rental_item_notes;


                const imagePreviewsContainer = document.getElementById('edit-image-previews');
                imagePreviewsContainer.innerHTML = '';

                console.log('Uploads:', data.uploads);
                if (data.uploads) {
                    data.uploads.forEach(upload => {
                        const imgElement = document.createElement('img');
                        imgElement.src = `/storage/${upload.file_path}`;
                        imgElement.classList.add('w-full', 'h-auto', 'rounded-lg');
                        imagePreviewsContainer.appendChild(imgElement);
                    });
                }

                const deleteBtn = document.querySelector('.delete-button')
                deleteBtn.addEventListener('click', async () => {
                    const rentalItem = deleteBtn.getAttribute('data-rentalItem-id');
                    await axios.delete(`/api/delete-image/${rentalItem}`).then((r) => r)

                })

                const priceFieldsUpdate = [
                    document.getElementById('edit_price_per_hour'),
                    document.getElementById('edit_price_per_day'),
                    document.getElementById('edit_price_per_month')
                ];

                applyMaskToFields(priceFieldsUpdate);
                addValidationListeners();
                setupFormSubmission('edit-form', priceFieldsUpdate);

                const editModal = document.getElementById('edit-modal');
                centerModals();
                editModal.classList.remove('hidden');
                editModal.setAttribute('aria-hidden', 'false');
                editModal.setAttribute('role', 'dialog');
            } catch (error) {
                console.error('Erro ao buscar dados do item de locação:', error);
            }
        });
    });

    document.getElementById('multiple_files').addEventListener('change', function (event) {
        const files = event.target.files;
        const imagePreviewsContainer = document.getElementById('image-previews');
        imagePreviewsContainer.innerHTML = '';

        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.classList.add('w-full', 'h-auto', 'rounded-lg');
                imagePreviewsContainer.appendChild(imgElement);
            };
            reader.readAsDataURL(file);
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

    document.querySelectorAll('.view-item-btn').forEach(button => {
        button.addEventListener('click', () => {
            const itemId = button.getAttribute('data-id');
            fetchAndPopulateViewModal(itemId);
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

    const priceFieldsCreate = [
        document.getElementById('price_per_hour'),
        document.getId('price_per_day'),
        document.getElementById('price_per_month')
    ];

    applyMaskToFields(priceFieldsCreate);
    addValidationListeners();
    setupFormSubmission('create-form', priceFieldsCreate);
});
