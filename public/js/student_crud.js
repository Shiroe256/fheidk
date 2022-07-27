$(document).ready(function () {

    fetchTempStudent();

    // function fetchTempStudent(){
    //     $.ajax({
    //         type: "GET",
    //         url: "/get-tempstudents",
    //         dataType: "json",
    //         success: function(response){
    //             // console.log(response.students);
    //             $('#tbl_list_of_students_form_2').html("");
    //             $.each(response.tbl_billing_details_temp, function (key, item){
    //                 $('#tbl_list_of_students_form_2').append(
    //                     '<tr>\
    //                         <td class="text-center"><input type="checkbox"></td>\
    //                         <td class="text-left">'+item.hei_name+'</td>\
    //                         <td class="text-left">'+item.reference_no+'</td>\
    //                         <td>'+item.stud_lname+'</td>\
    //                         <td>'+item.stud_fname+'</td>\
    //                         <td>'+item.stud_mname+'</td>\
    //                         <td>'+item.degree_program+'</td>\
    //                         <td class="text-center">'+item.year_level+'</td>\
    //                         <td class="text-left">'+item.remarks+'</td>\
    //                         <td class="text-left">'+item.stud_status+'</td>\
    //                         <td class="text-left"></td>\
    //                         <td class="text-center">\<div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_new_student_info"><i class="far fa-edit"></i></button></div></td>\
    //                     </tr>'
    //                 );
    //             });
    //         }
    //     });
    // }

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
                console.log(response.errors);
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