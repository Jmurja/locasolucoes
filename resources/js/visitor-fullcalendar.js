document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var modal = document.getElementById('visitor-reserve');
    var closeModalButtons = document.querySelectorAll('[data-modal-toggle="visitor-reserve"]');
    var eventForm = document.getElementById('eventForm');
    var eventTitleInput = document.getElementById('eventTitle');
    var eventStartInput = document.getElementById('eventStart');
    var currentEventDate = null;

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
                document.querySelector('[data-modal-toggle="crud-modal"]').click();
            }
        });
    }
});
