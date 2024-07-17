document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');
    let modal = document.getElementById('visitor-reserve');
    let confirmationModal = document.getElementById('confirmation-modal');
    let closeModalButtons = document.querySelectorAll('[data-modal-toggle="visitor-reserve"]');
    let closeConfirmationModalButtons = document.querySelectorAll('[data-modal-toggle="confirmation-modal"]');
    let eventForm = document.getElementById('eventForm');
    let eventTitleInput = document.getElementById('eventTitle');
    let currentEventDate = null;

    if (calendarEl) {
        let calendar = new FullCalendar.Calendar(calendarEl, {
            contentHeight: 500,
            locale: 'pt-br',
            selectable: true,
            selectMirror: true,
            editable: true,
            themeSystem: 'slate',
            views: {
                mes: {
                    type: 'dayGridMonth',
                    buttonText: 'Mês',
                },
            },
            initialView: 'mes',
            dateClick: function (info) {
                if (modal) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }
            },
            events: '/reserves/json'
        });

        calendar.render();
    }

    if (closeModalButtons) {
        closeModalButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                if (modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            });
        });
    }

    if (closeConfirmationModalButtons) {
        closeConfirmationModalButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                if (confirmationModal) {
                    confirmationModal.classList.add('hidden');
                    confirmationModal.classList.remove('flex');
                }
            });
        });
    }

    if (eventForm) {
        eventForm.addEventListener('submit', function (e) {
            e.preventDefault();
            console.log('Form submission initiated'); // Log para depuração

            // Enviar dados do formulário via AJAX
            let formData = new FormData(eventForm);
            fetch(eventForm.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: formData
            }).then(response => {
                if (response.ok) {
                    console.log('Response OK'); // Log para depuração
                    return response.json();
                } else {
                    throw new Error('Erro ao solicitar reserva');
                }
            }).then(data => {
                console.log('Data received:', data); // Log para depuração
                if (data.success) {
                    // Fechar o modal de reserva
                    if (modal) {
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    }

                    // Abrir o modal de confirmação
                    if (confirmationModal) {
                        confirmationModal.classList.remove('hidden');
                        confirmationModal.classList.add('flex');
                    }
                }
            }).catch(error => {
                console.error('Erro:', error);
            });
        });
    }
});
