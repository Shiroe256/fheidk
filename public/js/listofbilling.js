const ac_year = document.getElementById('ac_year');
const semester = document.getElementById('semester');
document.getElementById('new_billing').onclick = function () {
    var ac = ac_year.value;
    var sem = semester.value;
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: window.location.origin + "/new-billing",
        type: "PUT",
        data: "ac_year=" + ac + "&semester=" + sem,
        success: function (data) {
            window.location.href = data;
            // console.log(data);
        }
    });

};