var on = [];
var off = [];
var changes = [];
var reference_no = $('#btn_save').val();

$('#select_course').change(function () {
    $(".course-settings").each(function () {
        $(this).addClass("d-none");
    });
    $('#course_' + $(this).val()).removeClass("d-none");
});
$('.toggleall').change(function () {
    var toggle = $(this).is(":checked");
    $('#settings_' + $(this).attr('id').substring(10) + ' input:checkbox').prop("checked", toggle);
    $('#settings_' + $(this).attr('id').substring(10) + ' input:checkbox').change();
});

$('[id^="switch_"]').change(function (index) {
    if (changes.indexOf($(this).attr("id")) === -1) {
        changes.push($(this).attr("id"));
    }
    changes.forEach(element => {
        if ($(this).is(':checked')) {
            console.log($(this).val());
        } else {
            console.log($(this).val());
        }
    });
    resetCounter($('[id^="checked_ctr_"'));
});

function resetCounter(elements) {
    for (const key in elements) {
        var count = 0;
        var total = 0;
        if (Object.hasOwnProperty.call(elements, key)) {
            const element = elements[key];
            var identifier = element.id.substring(12) + '_1';
            count += $('#settings_' + identifier + ' input:checked').length;
            total += $('#settings_' + identifier + ' input:checkbox').length;
            identifier = element.id.substring(12) + '_2';
            count += $('#settings_' + identifier + ' input:checked').length;
            total += $('#settings_' + identifier + ' input:checkbox').length;
            element.innerHTML = count + '/' + total;
        }
    }
};

$('#btn_save').click(function () {
    changes.forEach(element => {
        $('#' + element).each(function (index) {
            if ($(this).is(':checked')) {
                on.push($(this).val());
            } else {
                off.push($(this).val());
            }
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: window.location.origin + "/save-settings",
        type: "PUT",
        data: {
            on: on,
            off: off,
            reference_no: reference_no
        },
        success: function (data) {
            window.location.href = "/billings/" + data;
        }
    });
});