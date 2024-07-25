document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var modal = document.getElementById('tenant-reserve');
    var closeModalButton = modal.querySelector('[data-modal-toggle="tenant-reserve"]');
    var eventStartInput = document.getElementById('eventStart');
    var eventEndInput = document.getElementById('eventEnd');
    var eventStartTimeInput = document.getElementById('start_time');
    var eventEndTimeInput = document.getElementById('end_time');

    function formatDate(dateStr) {
        var date = new Date(dateStr);
        date.setMinutes(date.getMinutes() + date.getTimezoneOffset());
        return date.toLocaleDateString('pt-BR');
    }

    function adjustEndDate(dateStr) {
        var date = new Date(dateStr);
        const calendarView = calendar.view.type;
        console.log('view type', calendar.view.type)
        if (calendarView === 'mes') {
            date.setDate(date.getDate() - 1);
        }
        return date.toISOString().split('T')[0];
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
                semana: {
                    type: 'timeGridWeek',
                    buttonText: 'Semana',
                },
                dia: {
                    type: 'timeGridDay',
                    buttonText: 'Dia',
                }
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'mes,semana,dia'
            },
            initialView: 'mes',
            hiddenDays: [0],
            slotMinTime: '08:00:00',
            slotMaxTime: '17:00:00',
            dateClick: function (info) {
                if (modal) {
                    eventStartInput.value = formatDate(info.dateStr);
                    eventEndInput.value = formatDate(info.dateStr);
                    eventStartTimeInput.value = '08:00';
                    eventEndTimeInput.value = '09:00';
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }
            },
            select: function (info) {
                if (modal) {
                    eventStartInput.value = formatDate(info.startStr.split('T')[0]);
                    eventEndInput.value = formatDate(adjustEndDate(info.endStr.split('T')[0]));
                    eventStartTimeInput.value = info.startStr.split('T')[1]?.slice(0, 5) || '08:00';
                    eventEndTimeInput.value = info.endStr.split('T')[1]?.slice(0, 5) || '09:00';
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }
            },
            events: '/reserves/json',
            eventDrop: function (info) {
                if (modal) {
                    eventStartInput.value = formatDate(info.event.startStr.split('T')[0]);
                    eventEndInput.value = formatDate(adjustEndDate(info.event.endStr.split('T')[0]));
                    eventStartTimeInput.value = info.event.startStr.split('T')[1]?.slice(0, 5);
                    eventEndTimeInput.value = info.event.endStr.split('T')[1]?.slice(0, 5);
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }
            },
            eventResize: function (info) {
                if (modal) {
                    eventStartInput.value = formatDate(info.event.startStr.split('T')[0]);
                    eventEndInput.value = formatDate(adjustEndDate(info.event.endStr.split('T')[0]));
                    eventStartTimeInput.value = info.event.startStr.split('T')[1]?.slice(0, 5);
                    eventEndTimeInput.value = info.event.endStr.split('T')[1]?.slice(0, 5);
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }
            }
        });
        calendar.render();
    }

    if (closeModalButton) {
        closeModalButton.addEventListener('click', function () {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });
    }
});
