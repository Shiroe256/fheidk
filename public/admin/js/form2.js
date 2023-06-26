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
            $('#stud_bplace').val(response.stud_birth_place);
            $('#stud_mother_lname').val(response.m_lname);
            $('#stud_mother_fname').val(response.m_fname);
            $('#stud_mother_mname').val(response.m_mname);
            $('#stud_father_lname').val(response.f_lname);
            $('#stud_father_fname').val(response.f_fname);
            $('#stud_father_mname').val(response.f_mname);
            $('#stud_present_province').val(response.present_province);
            $('#stud_present_city').val(response.present_city);
            $('#stud_present_barangay').val(response.present_barangay);
            $('#stud_present_street').val(response.present_street);
            $('#stud_present_zipcode').val(response.present_zipcode);
            $('#stud_present_province').val(response.present_province);
            $('#stud_permanent_city').val(response.permanent_city);
            $('#stud_permanent_barangay').val(response.permanent_barangay);
            $('#stud_permanent_street').val(response.permanent_street);
            $('#stud_permanent_zipcode').val(response.permanent_zipcode);
            $('#stud_contact').val(response.stud_phone_no);
            $('#stud_alt_ontact').val(response.stud_alt_phone_no);
            $('#stud_email').val(response.stud_email);
            $('#stud_alt_email').val(response.stud_alt_email);
            $('#stud_course_enrolled').val(response.degree_program);
            $('#stud_year_level').val(response.year_level);
            $('#stud_academic_units').val(response.academic_unit);
            $('#stud_tuition_amount').val(response.tuition_fee);
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
