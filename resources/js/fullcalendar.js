document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var modalToggleButton = document.getElementById('modalToggleButton');
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
