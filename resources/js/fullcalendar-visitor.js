document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var modal = document.getElementById('visitor-reserve');
    var modalContent = modal.querySelector('.relative');
    var closeModalButtons = document.querySelectorAll('[data-modal-toggle="visitor-reserve"]');
    var eventForm = document.getElementById('eventForm');
    var eventTitleInput = document.getElementById('eventTitle');
    var eventStartInput = document.getElementById('eventStart');
    var currentEventDate = null;

    function openModal() {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10); // Timeout to allow the browser to register the class removal
    }

    function closeModal() {
        modal.classList.remove('opacity-100');
        modalContent.classList.remove('scale-100', 'opacity-100');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300); // Duration of the transition
    }

    if (calendarEl) {
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
            initialView: 'mes',
            dateClick: function (info) {
                currentEventDate = info.dateStr;
                eventStartInput.value = currentEventDate + 'T00:00';
                openModal();
            },
            events: '/reserves/json'
        });

        calendar.render();
    }

    if (closeModalButtons) {
        closeModalButtons.forEach(function (button) {
            button.addEventListener('click', closeModal);
        });
    }

    if (eventForm) {
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
                closeModal();
            }
        });
    }
});
