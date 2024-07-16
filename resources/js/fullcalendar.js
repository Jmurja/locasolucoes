document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var eventForm = document.getElementById('eventForm');
    var eventTitleInput = document.getElementById('eventTitle');
    var eventStartInput = document.getElementById('eventStart');
    var currentEventDate = null;

    var calendar = new FullCalendar.Calendar(calendarEl, {
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

        dateClick: function (info) {
            currentEventDate = info.dateStr;
            eventStartInput.value = currentEventDate + 'T00:00';
            openModal('visitor-reserve'); // Função para abrir o modal
        },

        events: '/reserves/json',
        initialView: 'mes'
    });

    calendar.render();

    eventForm.addEventListener('submit', function (e) {
        e.preventDefault();
        if (eventTitleInput.value) {
            calendar.addEvent({
                title: eventTitleInput.value,
                start: currentEventDate,
                allDay: true
            });
            eventTitleInput.value = '';
            eventStartInput.value = '';
            closeModal('visitor-reserve'); // Função para fechar o modal
        }
    });

    document.querySelectorAll('[data-modal-close]').forEach(function (closeButton) {
        closeButton.addEventListener('click', function () {
            var modalId = closeButton.getAttribute('data-modal-close');
            closeModal(modalId);
        });
    });

    document.querySelectorAll('.modal').forEach(function (modal) {
        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                closeModal(modal.id);
            }
        });
    });
});

function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
}
