document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        contentHeight: 400,
        locale: 'pt-br',
        slotWidth: '10px',
        selectable: true,
        selectMirror: true,
        editable: true,
        eventDrop: function (info) {
            alert(info.event.title + " was dropped on " + info.event.start.toISOString());

            if (!confirm("Are you sure about this change?")) {
                info.revert();
            }
        },
        events: '/reserves/json',
        initialView: 'dayGridMonth'

    });
    calendar.render();
});

var event = calendar.getEventById('eventId');
if (event) {
    event.setProp('title', 'Updated Event Title');
}
