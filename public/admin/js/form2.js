fetchform2list();

//fetch records from the database
function fetchform2list() {
    var reference_no = $("#reference_no").val();
    var loadingIndicator = $("#loading_indicator"); // Element for displaying the loading indicator

  // Display the loading indicator
  loadingIndicator.show();
    $.ajax({
        url: "/admin/fetchform2list",
        method: 'get',
        data: {
            reference_no: reference_no,
            _token: '{{ csrf_token() }}'
        },
        success: function (response) {
            $("#tbl_form2_div").html(response);

            $("#tbl_form2").DataTable({
                "order": [1, "asc"],
                orderCellsTop: true,
                fixedHeader: true,
                'columnDefs': [{
                    'targets': [7], /* column index */
                    'orderable': false, /* true or false */
                }]
            });
        }
    });
}

//Update Products
$(document).on('click', '.btn_view_student_info', function (e) {
    e.preventDefault();
    let id = $(this).attr('id');
    $.ajax({
        url: '/admin/viewstudentinfo',
        method: 'get',
        data: {
            id: id,
            _token: '{{ csrf_token() }}'
        },
        success: function (response) {
            console.log(response);
            console.log(response.stud_id);
            $('#stud_id').val(response.stud_uid);
            $('#stud_lname').val(response.stud_lname);
            $('#stud_fname').val(response.stud_fname);
            $('#stud_mname').val(response.stud_mname);
            $('#stud_sex').val(response.stud_sex);
            $('#stud_bdate').val(response.stud_birth_date);
        }
    });
});


// $("#frm_update_products").submit(function (e) {
//     e.preventDefault();
//     const fd = new FormData(this);
//     $("#btn_update_products").text('Updating...');
//     $.ajax({
//         url: '/updateproducts',
//         method: 'post',
//         data: fd,
//         cache: false,
//         contentType: false,
//         processData: false,
//         dataType: 'json',
//         success: function (response) {
//             if (response.status == 200) {
//                 Swal.fire(
//                     'Updated!',
//                     'Products Updated Successfully!',
//                     'success'
//                 )
//                 fetchproductslist();
//                 $("#btn_update_products").text('Update');
//                 $("#frm_update_products")[0].reset();
//                 $("#mod_update_product").modal('hide');
//             } else if (response.status == 400) {
//                 let i = 1;
//                 let errorMessage = '';
//                 $.each(response.errors, function (key, err_values) {
//                     console.log(err_values);
//                     errorMessage = errorMessage + '<br />' + i++ + '. ' + err_values;
//                 })
//                 Swal.fire({
//                     // position: 'top',
//                     title: 'Oops... you missed something',
//                     html: errorMessage,
//                     icon: 'warning',

//                 })
//                 $("#btn_update_products").text('Update');
//             }
//         }
//     });
// });
