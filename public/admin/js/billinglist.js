fetchBillingListAdmin();
fetchuserlist();
fetchtosflist();

//fetch records from the database
function fetchBillingListAdmin() {
    $.ajax({
      url: "/admin/fetchbillinglist",
      method: 'get',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
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

  function fetchtosflist() {
    var hei_uii = $('#hei_uii').val();
    $.ajax({
      url: "/admin/fetchtosflist",
      method: 'get',
      data: {
        _token: '{{ csrf_token() }}',
        hei_uii: hei_uii
      },
      success: function (response) {
        $("#tbl_tosf_div").html(response);
        $("#tbl_tosf").DataTable({
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
$("#frm_add_tosf").submit(function (e) {
  e.preventDefault();
  const fd = new FormData(this);
  $("#btn_save_tosf").text('Adding...');

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: '/admin/newfee',
    method: 'post',
    data: fd,
    cache: false,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (response) {
      if (response.status == 200) {
        // Swal.fire(
        //   'Added!',
        //   'New Fee Added Successfully!',
        //   'success'
        // )

        alert('successful')
        fetchtosflist();
        $("#btn_save_tosf").text('Save');
        $("#frm_add_tosf")[0].reset();
        $("#modal_add_tosf").modal('hide');
      } else if (response.status == 400) {
        // let i = 1;
        // let errorMessage = '';
        // $.each(response.errors, function (key, err_values) {
        //   console.log(err_values);
        //   errorMessage = errorMessage + '<br />' + i++ + '. ' + err_values;
        // })
        // Swal.fire({
        //   // position: 'top',
        //   title: 'Oops... you missed something',
        //   html: errorMessage,
        //   icon: 'warning',

        // })
        alert('unsuccessful')
        $("#btn_save_tosf").text('Save');
      }
    }
  });
});
//end of new add student