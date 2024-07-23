document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var modal = document.getElementById('tenant-reserve');
    var closeModalButton = modal.querySelector('[data-modal-toggle="tenant-reserve"]');

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

    if (closeModalButton) {
        closeModalButton.addEventListener('click', function () {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });
    }
});
