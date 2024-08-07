document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var modal = document.getElementById('tenant-reserve');
    var closeModalButton = modal.querySelector('[data-modal-toggle="tenant-reserve"]');
    var eventStartInput = document.getElementById('eventStart');
    var eventEndInput = document.getElementById('eventEnd');
    var eventStartTimeInput = document.getElementById('start_time');
    var eventEndTimeInput = document.getElementById('end_time');
    var tooltip = document.getElementById('tooltip');

    function formatDate(dateStr) {
        var date = new Date(dateStr);
        date.setMinutes(date.getMinutes() + date.getTimezoneOffset());
        return date.toLocaleDateString('pt-BR');
    }

    function adjustEndDate(dateStr) {
        var date = new Date(dateStr);
        const calendarView = calendar.view.type;
        if (calendarView === 'mes') {
            date.setDate(date.getDate() - 1);
        }
        return date.toISOString().split('T')[0];
    }

    if (calendarEl) {
        var calendar = new FullCalendar.Calendar(calendarEl, {
            contentHeight: 'auto',
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
                    slotDuration: '01:00:00', // Exibir intervalos de uma hora
                    slotLabelInterval: '01:00:00', // Etiquetas de uma em uma hora
                },
                dia: {
                    type: 'timeGridDay',
                    buttonText: 'Dia',
                    slotDuration: '01:00:00', // Exibir intervalos de uma hora
                    slotLabelInterval: '01:00:00', // Etiquetas de uma em uma hora
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
            slotMaxTime: '19:00:00', // Ajustar para exibir até as 19h
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
            events: function (fetchInfo, successCallback, failureCallback) {
                fetch('/reserves/json')
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (data) {
                        var events = data.map(function (event) {
                            var eventStartDate = new Date(event.start);
                            var eventEndDate = new Date(event.end);
                            var today = new Date();
                            today.setHours(0, 0, 0, 0);

                            if (eventEndDate < today) {
                                event.className = 'past-event';
                            } else if (eventStartDate <= today && eventEndDate >= today) {
                                event.className = 'today-event';
                            }

                            var currentStart = new Date(event.start);
                            var currentEnd = new Date(event.end);
                            var now = new Date();
                            if (currentStart <= now && currentEnd >= now) {
                                event.className = 'current-event';
                            }

                            return event;
                        });
                        successCallback(events);
                    })
                    .catch(function (error) {
                        failureCallback(error);
                    });
            },
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
            },
            eventMouseEnter: function (info) {
                var tooltipContent = `Evento: ${info.event.title}<br>Início: ${formatDate(info.event.startStr)}<br>Fim: ${formatDate(info.event.endStr)}`;
                tooltip.innerHTML = tooltipContent;
                tooltip.classList.remove('hidden');
                tooltip.classList.add('block');

                var rect = info.el.getBoundingClientRect();
                var tooltipRect = tooltip.getBoundingClientRect();
                tooltip.style.left = `${rect.left + (rect.width / 2) - (tooltipRect.width / 2)}px`;
                tooltip.style.top = `${rect.top - tooltipRect.height - 10}px`;
            },
            eventMouseLeave: function () {
                tooltip.classList.add('hidden');
                tooltip.classList.remove('block');
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
