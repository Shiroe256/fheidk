$(document).ready(function () {
    //billingmanagement.blade.php

    // if ($('#billing_forms_div').is(':visible')) {
    //     $("#summary_billing_div").hide(300);
    //     $("#billing_exceptions_div").hide(300);
    // }
    // if($('#summary_billing_div').is(':visible')){
    //     $("#billing_forms_div").hide(300);
    //     $("#billing_exceptions_div").hide(300);
    // }
    // if($('#billing_exceptions_div').is(':visible')){
    //     $("#billing_forms_div").hide(300);
    //     $("#summary_billing_div").hide(300);
    // }

    if ($('#billing_status').val(3)) {
        $("#btn_exceptions").hide(300);
    }

    $('#btn_forms').on('click', function (event) {
        alert();
        $("#summary_billing_div").hide(300);
       
        $("#billing_forms_div").show(300);

    });


});