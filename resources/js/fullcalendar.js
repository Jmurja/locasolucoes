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
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialView: 'dayGridMonth',
        events: '/reserves/json',
        dateClick: function (info) {
            currentEventDate = info.dateStr;
            eventStartInput.value = currentEventDate;
            modalToggleButton.click();
        },
        eventDidMount: function (info) {
            var tooltip = new Tooltip(info.el, {
                title: info.event.extendedProps.description,
                placement: 'top',
                trigger: 'hover',
                container: 'body'
            });
        }
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
            document.querySelector('[data-modal-toggle="tenant-reserve"]').click();
        }
    });
});
