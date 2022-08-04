$(function() {

fetchTempStudent();

 // add new student ajax request
 $("#frm_add_student").submit(function(e) {
    e.preventDefault();
    const fd = new FormData(this);
    $("#btn_add_student").text('Adding...');
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
      url: '/newtempstudent',
      method: 'post',
      data: fd,
      cache: false,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function(response) {
        if (response.status == 200) {
          Swal.fire(
            'Added!',
            'Student Added Successfully!',
            'success'
          )
          fetchTempStudent();
        $("#btn_add_student").text('Add Student');
        $("#frm_add_student")[0].reset();
        $("#mod_new_student_info").modal('hide');
        }else if(response.status == 400) {
            let i = 1;
            let errorMessage = '';
            $.each(response.errors, function(key, err_values){
                console.log(err_values);
                errorMessage = errorMessage+'<br />'+ i++ + '. ' +err_values;
            })
            Swal.fire({
                // position: 'top',
                title: 'Oops... you missed something',
                html: errorMessage,
                icon:'warning', 

            })
        
            fetchTempStudent();
            $("#btn_add_student").text('Add Student');
          }
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
};