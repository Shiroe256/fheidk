$(document).ready(function () {

    fetchTempStudent();

    $(document).on('click', '#btn_add_student', function(e){
        e.preventDefault();
        
        var data={
            'stud_lname': $('#lname').val(),
            'stud_fname': $('#fname').val(),
            'stud_mname': $('#mname').val(),
        }
        
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

        $("#btn_add_student").text('Adding...');
        $.ajax({
            url: "/newtempstudent",
            method: 'post',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.status == 200) {
                    Swal.fire(
                        'Added!',
                        'Student Added Successfully!',
                        'success'
                    )
                    fetchTempStudent();
                }
                $("#btn_add_student").text('Add Student');
                $("#frm_add_student")[0].reset();
                $("#mod_new_student_info").modal('hide');
            }
        });
    });



}); 


//nilabas ko para ma call ko sa iba
function fetchTempStudent() {
    $.ajax({
        url: "/get-tempstudents",
        method: 'get',
        success: function (response) {
            $("#show_all_students").html(response);
            $("#tbl_students").DataTable({
                "order": [[3, "asc"]],
                orderCellsTop: true,
                fixedHeader: true,
                columnDefs: [
                    { orderable: false, targets: [0, -1] }
                ]
            });
        }
    });
}