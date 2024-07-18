import SimpleMaskMoney from 'simple-mask-money';

const optionsUSD = {
    afterFormat(e) {
        console.log('afterFormat', e);
    },
    allowNegative: false,
    beforeFormat(e) {
        console.log('beforeFormat', e);
    },
    negativeSignAfter: false,
    prefix: '$',
    suffix: '',
    fixed: true,
    fractionDigits: 2,
    decimalSeparator: ',',
    thousandsSeparator: '.',
    cursor: 'end'
};

document.addEventListener('DOMContentLoaded', function () {
    const pricePerHourCreate = document.getElementById('price_per_hour');
    const pricePerDayCreate = document.getElementById('price_per_day');
    const pricePerMonthCreate = document.getElementById('price_per_month');

    SimpleMaskMoney.setMask(pricePerHourCreate, optionsUSD);
    SimpleMaskMoney.setMask(pricePerDayCreate, optionsUSD);
    SimpleMaskMoney.setMask(pricePerMonthCreate, optionsUSD);

    function convertToNumberCreate() {
        pricePerHourCreate.value = SimpleMaskMoney.formatToNumber(pricePerHourCreate.value);
        pricePerDayCreate.value = SimpleMaskMoney.formatToNumber(pricePerDayCreate.value);
        pricePerMonthCreate.value = SimpleMaskMoney.formatToNumber(pricePerMonthCreate.value);
    }

    const formCreate = document.getElementById('rental-form');
    formCreate.addEventListener('submit', function (event) {
        convertToNumberCreate();
    });

    // Parte de atualização
    const pricePerHourUpdate = document.getElementById('edit_price_per_hour');
    const pricePerDayUpdate = document.getElementById('edit_price_per_day');
    const pricePerMonthUpdate = document.getElementById('edit_price_per_month');

    function applyMaskToUpdateFields() {
        SimpleMaskMoney.setMask(pricePerHourUpdate, optionsUSD);
        SimpleMaskMoney.setMask(pricePerDayUpdate, optionsUSD);
        SimpleMaskMoney.setMask(pricePerMonthUpdate, optionsUSD);
    }

    function convertToNumberUpdate() {
        pricePerHourUpdate.value = SimpleMaskMoney.formatToNumber(pricePerHourUpdate.value);
        pricePerDayUpdate.value = SimpleMaskMoney.formatToNumber(pricePerDayUpdate.value);
        pricePerMonthUpdate.value = SimpleMaskMoney.formatToNumber(pricePerMonthUpdate.value);
    }

    const formUpdate = document.getElementById('edit-form');
    formUpdate.addEventListener('submit', function (event) {
        convertToNumberUpdate();
    });

    // Adicionando evento de abertura do modal para aplicar máscara
    document.querySelectorAll('[data-modal-toggle="edit-modal"]').forEach(button => {
        button.addEventListener('click', function () {
            applyMaskToUpdateFields();
        });
    });
});

function validateName() {
    const name = document.getElementById('name').value;
    const nameError = document.getElementById('name-error');
    if (name.trim() === '' || name.length < 3) {
        nameError.classList.remove('hidden');
    } else {
        nameError.classList.add('hidden');
    }
}

function validateDescription() {
    const description = document.getElementById('description').value;
    const descriptionError = document.getElementById('description-error');
    if (description.trim() === '' || description.length < 5) {
        descriptionError.classList.remove('hidden');
    } else {
        descriptionError.classList.add('hidden');
    }
}

function validatePrice(field) {
    const price = document.getElementById(field).value;
    const priceError = document.getElementById(`${field}-error`);
    if (price.trim() !== '' && isNaN(price)) {
        priceError.classList.remove('hidden');
    } else {
        priceError.classList.add('hidden');
    }
}

function validateValues() {
    const pricePerHour = document.getElementById('price_per_hour').value;
    const pricePerDay = document.getElementById('price_per_day').value;
    const pricePerMonth = document.getElementById('price_per_month').value;
    const valueError = document.getElementById('value-error');

    if (pricePerHour.trim() === '' && pricePerDay.trim() === '' && pricePerMonth.trim() === '') {
        valueError.classList.remove('hidden');
    } else {
        valueError.classList.add('hidden');
    }
}

document.getElementById('name').addEventListener('input', validateName);
document.getElementById('name').addEventListener('blur', validateName);

document.getElementById('description').addEventListener('input', validateDescription);
document.getElementById('description').addEventListener('blur', validateDescription);

document.getElementById('price_per_hour').addEventListener('input', () => {
    validatePrice('price_per_hour');
    validateValues();
});
document.getElementById('price_per_hour').addEventListener('blur', () => {
    validatePrice('price_per_hour');
    validateValues();
});

document.getElementById('price_per_day').addEventListener('input', () => {
    validatePrice('price_per_day');
    validateValues();
});
document.getElementById('price_per_day').addEventListener('blur', () => {
    validatePrice('price_per_day');
    validateValues();
});

document.getElementById('price_per_month').addEventListener('input', () => {
    validatePrice('price_per_month');
    validateValues();
});
document.getElementById('price_per_month').addEventListener('blur', () => {
    validatePrice('price_per_month');
    validateValues();
});

document.getElementById('rental-form').addEventListener('submit', function (event) {
    validateName();
    validateDescription();
    validateValues();

    const nameError = document.getElementById('name-error');
    const descriptionError = document.getElementById('description-error');
    const valueError = document.getElementById('value-error');

    if (!nameError.classList.contains('hidden') || !descriptionError.classList.contains('hidden') || !valueError.classList.contains('hidden')) {
        event.preventDefault();
    }
});

document.getElementById('edit-form').addEventListener('submit', function (event) {
    validateName();
    validateDescription();
    validateValues();

    const nameError = document.getElementById('name-error');
    const descriptionError = document.getElementById('description-error');
    const valueError = document.getElementById('value-error');

    if (!nameError.classList.contains('hidden') || !descriptionError.classList.contains('hidden') || !valueError.classList.contains('hidden')) {
        event.preventDefault();
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const viewButtons = document.querySelectorAll('.view-item-btn');

    viewButtons.forEach(button => {
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
});
