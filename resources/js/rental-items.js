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
    validateValues();
    const valueError = document.getElementById('value-error');
    if (!valueError.classList.contains('hidden')) {
        event.preventDefault();
    }
});
