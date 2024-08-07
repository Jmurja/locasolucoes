document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-reserve-button');
    const editModal = document.getElementById('edit-modal');
    const editForm = document.getElementById('editForm');

    editButtons.forEach(button => {
        button.addEventListener('click', async function () {
            const reserveId = this.getAttribute('data-reserve-id');
            console.log('Reserve ID:', reserveId);

            try {
                const response = await fetch(`api/reservas/${reserveId}`);
                if (!response.ok) {
                    throw new Error('Erro ao buscar dados da reserva');
                }
                const reserve = await response.json();
                console.log('Reserve Data:', reserve);

                if (editModal) {
                    editModal.querySelector('select[name="user_id"]').value = reserve.user_id || '';
                    editModal.querySelector('input[name="title"]').value = reserve.title || '';
                    editModal.querySelector('select[name="rental_item_id"]').value = reserve.rental_item_id || '';
                    editModal.querySelector('input[name="start_date"]').value = formatDate(reserve.start_date) || '';
                    editModal.querySelector('input[name="end_date"]').value = formatDate(reserve.end_date) || '';
                    editModal.querySelector('select[name="start_time"]').value = formatTime(reserve.start_date) || '';
                    editModal.querySelector('select[name="end_time"]').value = formatTime(reserve.end_date) || '';
                    editModal.querySelector('input[name="reserve_notes"]').value = reserve.reserve_notes || '';
                    editModal.querySelector('select[name="reserve_status"]').value = reserve.reserve_status || '';

                    editForm.action = `/reservas/${reserveId}`;
                    editModal.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Erro:', error);
            }
        });
    });

    const viewButtons = document.querySelectorAll('.view-reserve-button');
    const viewModal = document.getElementById('view-modal');

    viewButtons.forEach(button => {
        button.addEventListener('click', async function () {
            const reserveId = this.getAttribute('data-reserve-id');

            try {
                const response = await fetch(`/reservas/${reserveId}`);
                if (!response.ok) {
                    throw new Error('Erro ao buscar dados da reserva');
                }
                const reserve = await response.json();

                if (viewModal) {
                    viewModal.querySelector('#modal-reserve-user').textContent = reserve.user?.name || 'N/A';
                    viewModal.querySelector('#modal-reserve-space').textContent = reserve.rentalitem?.name || 'N/A';
                    viewModal.querySelector('#modal-reserve-company').textContent = reserve.user?.company || 'N/A';
                    viewModal.querySelector('#modal-reserve-start').textContent = formatDate(reserve.start_date) || 'N/A';
                    viewModal.querySelector('#modal-reserve-end').textContent = formatDate(reserve.end_date) || 'N/A';
                    viewModal.querySelector('#modal-reserve-start-time').textContent = formatTime(reserve.start_date) || 'N/A';
                    viewModal.querySelector('#modal-reserve-end-time').textContent = formatTime(reserve.end_date) || 'N/A';
                    viewModal.querySelector('#modal-reserve-notes').textContent = reserve.reserve_notes || 'N/A';

                    viewModal.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Erro:', error);
            }
        });
    });

    const modal = document.getElementById('delete-modal');
    const deleteForm = document.getElementById('delete-form');
    const buttons = document.querySelectorAll('[data-modal-toggle="delete-modal"]');
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-reserve-id');
            deleteForm.setAttribute('action', `/reservas/${userId}`);
        });
    });

    const userSelect = document.getElementById('user_id');
    const userNameInput = document.getElementById('name');
    if (userSelect) {
        userSelect.addEventListener('change', function () {
            const selectedOption = userSelect.options[userSelect.selectedIndex];
            const userName = selectedOption.getAttribute('data-name');
            userNameInput.value = userName;
        });
        const event = new Event('change');
        userSelect.dispatchEvent(event);
    }

    function formatDate(dateTime) {
        const date = new Date(dateTime);
        if (isNaN(date)) return '';
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }

    function formatTime(dateTime) {
        const date = new Date(dateTime);
        if (isNaN(date)) return '';
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        return `${hours}:${minutes}`;
    }

    const closeModalButtons = document.querySelectorAll('[data-modal-toggle="view-modal"], [data-modal-toggle="edit-modal"], [data-modal-toggle="delete-modal"]');
    closeModalButtons.forEach(button => {
        button.addEventListener('click', function () {
            const modal = document.getElementById(button.getAttribute('data-modal-toggle'));
            if (modal) {
                modal.classList.add('hidden');
            }
        });
    });

    const conflictMessage = document.getElementById('conflict-message');
    if (conflictMessage) {
        setTimeout(() => {
            conflictMessage.style.transition = "opacity 0.5s ease";
            conflictMessage.style.opacity = 0;
            setTimeout(() => {
                conflictMessage.remove();
            }, 1000);
        }, 1000);
    }

    const fieldsToValidate = ['title', 'start_date', 'end_date', 'start_time', 'end_time'];

    fieldsToValidate.forEach(fieldId => {
        const field = document.getElementById(`update_${fieldId}`);
        if (field) {
            field.addEventListener('blur', validateField);
            field.addEventListener('input', validateField);
        }
    });

    function validateField(event) {
        const field = event.target;
        const value = field.value;
        let errorMessage = '';

        if (!value) {
            errorMessage = 'Este campo é obrigatório.';
        } else {
            if (field.type === 'date') {
                const date = new Date(value);
                if (isNaN(date)) {
                    errorMessage = 'Por favor, insira uma data válida.';
                }
            } else if (field.type === 'time') {
                const timePattern = /^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/;
                if (!timePattern.test(value)) {
                    errorMessage = 'Por favor, insira um horário válido.';
                }
            }
        }

        const errorElement = field.nextElementSibling;
        if (errorMessage) {
            if (!errorElement) {
                const error = document.createElement('span');
                error.classList.add('text-red-500', 'text-sm');
                error.textContent = errorMessage;
                field.after(error);
            } else {
                errorElement.textContent = errorMessage;
            }
        } else {
            if (errorElement) {
                errorElement.remove();
            }
        }
    }


});
document.addEventListener('DOMContentLoaded', () => {
    const reserveForm = document.getElementById('reserve-form');

    const fields = {
        user_id: {
            element: document.getElementById('user_id'),
            errorElement: document.createElement('p'),
            message: 'Responsável é obrigatório.'
        },
        rental_item_id: {
            element: document.getElementById('rental_item_id'),
            errorElement: document.createElement('p'),
            message: 'Espaço é obrigatório.'
        },
        start_date: {
            element: document.getElementById('start_date'),
            errorElement: document.createElement('p'),
            message: 'Data de Início é obrigatória.'
        },
        end_date: {
            element: document.getElementById('end_date'),
            errorElement: document.createElement('p'),
            message: 'Data de Término é obrigatória.'
        },
        start_time: {
            element: document.getElementById('start_time'),
            errorElement: document.createElement('p'),
            message: 'Hora de Início é obrigatória.'
        },
        end_time: {
            element: document.getElementById('end_time'),
            errorElement: document.createElement('p'),
            message: 'Hora de Término é obrigatória.'
        },
        title: {
            element: document.getElementById('title'),
            errorElement: document.createElement('p'),
            message: 'Título da Reserva deve ter pelo menos 5 caracteres.'
        },
        reserve_status: {
            element: document.getElementById('reserve_status'),
            errorElement: document.createElement('p'),
            message: 'Status da Reserva é obrigatório.'
        },
        reserve_notes: {
            element: document.getElementById('reserve_notes'),
            errorElement: document.createElement('p'),
            message: 'Observações devem ter pelo menos 5 caracteres.'
        }
    };

    Object.values(fields).forEach(field => {
        field.errorElement.classList.add('text-red-500', 'text-xs', 'mt-1');
        field.errorElement.style.display = 'none';
        field.element.parentNode.appendChild(field.errorElement);

        field.element.addEventListener('blur', () => validateField(field));
        field.element.addEventListener('input', () => validateField(field));
    });

    function validateField(field) {
        let isValid = true;

        if (field.element.id === 'title' || field.element.id === 'reserve_notes') {
            if (field.element.value.trim().length < 5) {
                field.errorElement.textContent = field.message;
                field.errorElement.style.display = 'block';
                field.element.classList.add('border-red-500');
                isValid = false;
            } else {
                field.errorElement.textContent = '';
                field.errorElement.style.display = 'none';
                field.element.classList.remove('border-red-500');
                isValid = true;
            }
        } else {
            if (!field.element.value.trim()) {
                field.errorElement.textContent = field.message;
                field.errorElement.style.display = 'block';
                field.element.classList.add('border-red-500');
                isValid = false;
            } else {
                field.errorElement.textContent = '';
                field.errorElement.style.display = 'none';
                field.element.classList.remove('border-red-500');
                isValid = true;
            }
        }

        return isValid;
    }

    reserveForm.addEventListener('submit', (e) => {
        let valid = true;
        Object.values(fields).forEach(field => {
            if (!validateField(field)) {
                valid = false;
            }
        });
        if (!valid) {
            e.preventDefault();
        }
    });
});
