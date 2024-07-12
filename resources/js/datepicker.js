const $datepickerEl = document.getElementById('datepicker-custom');

// optional options with default values and callback functions
const options = {
    defaultDatepickerId: null,
    autohide: false,
    format: 'dd/mm/yyyy',
    maxDate: null,
    minDate: null,
    orientation: 'bottom',
    buttons: false,
    autoSelectToday: false,
    title: null,
    rangePicker: false,
    onShow: () => {
    },
    onHide: () => {
    },
};

const instanceOptions = {
    id: 'datepicker-custom-example',
    override: true
};
