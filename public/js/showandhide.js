$(document).ready(function () {
    //billingmanagement.blade.php
    $('#btn_yes').on('click', function (event) {
        $(this).closest('.modal').one('hidden.bs.modal', function () {
            $("#summary_billing_div").show(300);
            $("#btn_forms").show(300);
            $("#billing_forms_div").hide(300);
            if ($('#summary_billing_div').is(':visible')) {
                $("#billing_forms_div").hide(300);
                $("#btn_run_billing_checker").hide(300);
                $("#billing_exceptions_div").hide(300);
            }
        });
    });

    $('#btn_no').on('click', function (event) {
        $(this).closest('.modal').one('hidden.bs.modal', function () {
            $("#billing_exceptions_div").show(300);
            $("#btn_forms").show(300);
            $("#billing_forms_div").hide(300);
            if ($('#billing_exceptions_div').is(':visible')) {
                $("#billing_forms_div").hide(300);
                $("#summary_billing_div").hide(300);
            }
        });
    });

    $('#btn_forms').on('click', function (event) {
        $("#summary_billing_div").hide(300);
        $("#btn_run_billing_checker").show(300);
        $("#btn_forms").hide(300);
        $("#billing_forms_div").show(300);
        $("#billing_exceptions_div").hide(300);
    });

    if ($('#billing_forms_div').is(':visible')) {
        $("#summary_billing_div").hide(300);
        $("#billing_exceptions_div").hide(300);
    }

    $('#showPass').on('click', function (event) {
        if ($('#showPass').is(":checked")) {
           $('#password').attr('type', 'text');
        } else {
            $('#password').attr('type', 'password');
        }
    });
    
});