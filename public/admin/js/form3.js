fetchform3list();

//fetch records from the database
function fetchform3list() {
    var reference_no = $("#reference_no").val();
    var loadingIndicator = $("#loading_indicator"); // Element for displaying the loading indicator

  // Display the loading indicator
  loadingIndicator.show();
    $.ajax({
        url: "/admin/fetchform3list",
        method: 'get',
        data: {
            reference_no: reference_no,
            _token: '{{ csrf_token() }}'
        },
        success: function (response) {
            $("#tbl_form3_div").html(response);

            $("#tbl_form3").DataTable({
                "order": [1, "asc"],
                orderCellsTop: true,
                fixedHeader: true,
                'columnDefs': [{
                    'targets': [8], /* column index */
                    'orderable': false, /* true or false */
                }]
            });
        }
    });
}

$(document).on('click', '.btn_view_applicant_info', function (e) {
    e.preventDefault();
    let id = $(this).attr('id');
    $.ajax({
        url: '/admin/viewapplicantinfo',
        method: 'get',
        data: {
            id: id,
            _token: '{{ csrf_token() }}'
        },
        success: function (response) {
            console.log(response);
            // Get all input elements within the modal
            const inputs = document.querySelectorAll('#mod_applicant_info input');

            // Loop through each input element and set the readonly attribute
            inputs.forEach((input) => {
                input.setAttribute('readonly', 'true');
            });
            $('#stud_uid').val(response.stud_uid);
            $('#stud_fhe_award_no').val(response.fhe_award_no);
            $('#stud_id').val(response.stud_id);
            $('#stud_lname').val(response.stud_lname);
            $('#stud_fname').val(response.stud_fname);
            $('#stud_mname').val(response.stud_mname);
            $('#stud_sex').val(response.stud_sex);
            $('#stud_bdate').val(response.stud_birth_date);
            $('#stud_bplace').val(response.stud_birth_place);
        
            $('#stud_contact').val(response.stud_phone_no);
            $('#stud_alt_ontact').val(response.stud_alt_phone_no);
            $('#stud_email').val(response.stud_email);
            $('#stud_alt_email').val(response.stud_alt_email);
            $('#stud_course_enrolled').val(response.degree_program);
            $('#stud_year_level').val(response.year_level);
            $('#stud_entrance_and_admission_fee').val(response.entrance_and_admission_fee);
            
            $('#stud_total_fee').val(parseFloat(response.total_fee).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        }
    });
});