document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');
    let modalToggleButton = document.getElementById('modalToggleButton');
    let eventForm = document.getElementById('eventForm');
    let eventTitleInput = document.getElementById('eventTitle');
    let eventStartInput = document.getElementById('eventStart');
    let currentEventDate = null;

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

        dateClick: function (info) {
            currentEventDate = info.dateStr;
            eventStartInput.value = currentEventDate;
            modalToggleButton.click();
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


            document.querySelector('[data-modal-toggle="crud-modal"]').click();
        }
    });
});
