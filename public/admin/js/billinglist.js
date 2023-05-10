fetchBillingListAdmin()
fetchuserlist()

$('#tbl_tosf').DataTable();

//fetch records from the database
function fetchBillingListAdmin() {
    $.ajax({
      url: "/admin/fetchbillinglist",
      method: 'get',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
        // const tbl_billing_list_admin = document.getElementById('tbl_billing_list_admin');
        // tbl_billing_list_admin.innerHTML(response);
        $("#tbl_billing_list_admin").html(response);
        $("#tbl_manage_billing_list").DataTable({
          "order": [[0, "asc"]],
          orderCellsTop: true,
          fixedHeader: true
        });
      }
    });
  }

  function fetchuserlist() {
    $.ajax({
      url: "/admin/fetchuserlist",
      method: 'get',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
        $("#tbl_user_list_div").html(response);
        $("#tbl_user_list").DataTable({
          "order": [[0, "asc"]],
          orderCellsTop: true,
          fixedHeader: true
        });
      }
    });
  }

  function managebillinglistsearch() {
    var acYear = document.getElementById("select_ac_year").value;
    var semester = document.getElementById("select_semester").value;
    var billingStatus = document.getElementById("select_billing_status").value;
  
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    
    // Send AJAX request to the server
    $.ajax({
      url: "/admin/managebillinglistsearch",
      type: "POST",
      data: {
        ac_year: acYear,
        semester: semester,
        billing_status: billingStatus
      },
      success: function (response) {
        // Update the table with the retrieved data
        $("#tbl_billing_list_admin").html(response);
        $("#tbl_manage_billing_list").DataTable({
          "order": [[0, "asc"]],
          orderCellsTop: true,
          fixedHeader: true
        });
      }
    });
  }

  //add new school fee
  // add new student ajax request
$("#btn_save_tosf").submit(function (e) {
  e.preventDefault();
  const fd = new FormData(this);
  $("#btn_save_tosf").text('Adding...');

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
    success: function (response) {
      if (response.status == 200) {
        Swal.fire(
          'Added!',
          'New Fee Added Successfully!',
          'success'
        )
        fetchTempStudent();
        fetchTempSummary();
        $("#btn_add_student").text('Add Student');
        $("#frm_add_student")[0].reset();
        $("#mod_new_student_info").modal('hide');
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
        $("#btn_add_student").text('Add Student');
      }
    }
  });
});
//end of new add student