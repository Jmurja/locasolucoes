document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var modal = document.getElementById('visitor-reserve');
    var closeModalButtons = document.querySelectorAll('[data-modal-toggle="visitor-reserve"]');
    var eventForm = document.getElementById('reserveForm'); // Atualizado para reserveForm
    var eventTitleInput = document.getElementById('eventTitle');
    var eventStartInput = document.getElementById('datepicker-range-start'); // Campo de data atualizado
    var eventEndInput = document.getElementById('datepicker-range-end'); // Campo de data de término atualizado
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
                currentEventDate = info.dateStr; // Armazena a data clicada
                if (modal) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }
                if (eventStartInput) {
                    eventStartInput.value = formatDate(currentEventDate); // Preenche o campo de data no formato DD/MM/YYYY
                }
                if (eventEndInput) {
                    eventEndInput.value = formatDate(currentEventDate); // Preenche o campo de data de término no formato DD/MM/YYYY
                }
                if (startTimeInput) {
                    startTimeInput.value = '08:00'; // Define a hora de início padrão
                }
                if (endTimeInput) {
                    endTimeInput.value = '18:00'; // Define a hora de término padrão
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
                    start: currentEventDate + 'T' + startTimeInput.value,
                    end: currentEventDate + 'T' + endTimeInput.value,
                    allDay: false
                });
                eventTitleInput.value = '';
                eventStartInput.value = '';
                eventEndInput.value = '';
                startTimeInput.value = '';
                endTimeInput.value = '';
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
    }
});
