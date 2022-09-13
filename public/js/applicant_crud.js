fetchTempApplicants();

// add new applicant ajax request
$("#frm_add_applicant").submit(function (e) {
  e.preventDefault();
  const fd = new FormData(this);
  $("#btn_add_applicant").text('Adding...');

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: '/newtempapplicants',
    method: 'post',
    data: fd,
    cache: false,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (response) {
      if (response.status == 200) {
        Swal.fire(
          'Added!',
          'Applicant Added Successfully!',
          'success'
        )
        fetchTempApplicants();
        fetchTempSummary();
        $("#btn_add_applicant").text('Add Applicant');
        $("#frm_add_applicant")[0].reset();
        $("#mod_admission_entrance").modal('hide');
      } else if (response.status == 400) {
        let i = 1;
        let errorMessage = '';
        $.each(response.errors, function (key, err_values) {
          console.log(err_values);
          errorMessage = errorMessage + '<br />' + i++ + '. ' + err_values;
        })
        Swal.fire({
          // position: 'top',
          title: 'Oops... you missed something',
          html: errorMessage,
          icon: 'warning',

        })
        $("#btn_add_applicant").text('Add Applicant');
      }
    }
  });
});
//end of add new applicant

$(document).on('change', '#course_applied', function (e) {
  e.preventDefault();
  let course = $("#course_applied option:selected").text();
      $("#degree_program_applied").val($("#course_applied option:selected").text());
});

//set inputs value
$(document).on('change', '#applied_hei_campus', function (e) {
  e.preventDefault();
  let campus = $("#applied_hei_campus option:selected").text();
  let hei_uii = $("#applied_hei_campus option:selected").attr('id');
  $("#applied_selected_campus").val(campus);
  $("#hei_uii").val(hei_uii);
});

//fetch records from the database
function fetchTempApplicants() {
  let reference_no = $("#reference_no").val();
  $.ajax({
    url: "/get-tempapplicants",
    method: 'get',
    data: {
      reference_no: reference_no,
      _token: '{{ csrf_token() }}'
    },
    success: function (response) {
      $("#show_all_applicants").html(response);
      $("#tbl_applicants").DataTable({
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