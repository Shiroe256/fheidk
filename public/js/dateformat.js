$(document).ready(function () {
    $('.date').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoApply: true,
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $('.date').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD'));
    });
    
});