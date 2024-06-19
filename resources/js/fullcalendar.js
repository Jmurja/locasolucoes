document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        contentHeight: 400,
        locale: 'pt-br',
        slotWidth: '10px',
        selectable: true,
        selectMirror: true,
        editable:true,
        events: 'reserves/json',
        initialView: 'dayGridMonth'
    });
    calendar.render();
});

var event = calendar.getEventById('eventId');
if (event) {
    event.setProp('title', 'Updated Event Title');
}
