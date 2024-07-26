document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var modal = document.getElementById('visitor-reserve');
    var closeModalButtons = document.querySelectorAll('[data-modal-toggle="visitor-reserve"]');
    var eventForm = document.getElementById('reserveForm');
    var eventTitleInput = document.getElementById('eventTitle');
    var eventStartInput = document.getElementById('datepicker-range-start');
    var eventEndInput = document.getElementById('datepicker-range-end');
    var startTimeInput = document.getElementById('start_time'); // Campo de hora de início
    var endTimeInput = document.getElementById('end_time'); // Campo de hora de término
    var currentEventDate = null;

    function formatDate(date) {
        var d = new Date(date);
        var day = String(d.getDate()).padStart(2, '0');
        var month = String(d.getMonth() + 1).padStart(2, '0');
        var year = d.getFullYear();
        return `${day}/${month}/${year}`;
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
            hiddenDays: [0],
            initialView: 'mes',
            dateClick: function (info) {
                currentEventDate = new Date(info.date); // Armazena a data clicada como um objeto Date
                if (modal) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }
                if (eventStartInput) {
                    var startDate = new Date(currentEventDate);
                    startDate.setDate(startDate.getDate());
                    eventStartInput.value = formatDate(startDate);
                }
                if (eventEndInput) {
                    var endDate = new Date(currentEventDate);
                    endDate.setDate(endDate.getDate());
                    eventEndInput.value = formatDate(endDate);
                }
                if (startTimeInput) {
                    startTimeInput.value = '08:00';
                }
                if (endTimeInput) {
                    endTimeInput.value = '18:00';
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

                            // Marque eventos atuais como verde
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
            eventMouseEnter: function (info) {
                tippy(info.el, {
                    content: `${info.event.title}<br>Início: ${formatDate(info.event.start)}<br>Fim: ${formatDate(info.event.end)}`,
                    allowHTML: true,
                    theme: 'light',
                });
            }
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
});
