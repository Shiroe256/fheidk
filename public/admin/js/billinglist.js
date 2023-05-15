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

      // Setup - add a text input to each footer cell
      $('.col_search').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    });

      $("#tbl_tosf").DataTable({
        initComplete: function () {
          // Apply the search
          this.api()
              .columns()
              .every(function () {
                  var that = this;

                  $('input', this).on('keyup change clear', function () {
                      if (that.search() !== this.value) {
                          that.search(this.value).draw();
                      }
                  });
              });
      },
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

//upload new school fee
// upload new fee ajax request
$("#frm_upload_tosf").submit(function (e) {
  e.preventDefault();
  const fd = new FormData(this);
  $("#btn_upload_tosf").text('Uploading...');

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: '/admin/import',
    method: 'post',
    data: fd,
    cache: false,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (response) {
      if (response.status == 200) {
        Swal.fire(
          'Upload!',
          'New Fees Uploaded Successfully!',
          'success'
        )

        fetchtosflist();

        $("#btn_upload_tosf").text('Save');
        $("#frm_upload_tosf")[0].reset();
        $("#modal_tosf").modal('hide');
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
        $("#btn_upload_tosf").text('Upload');
      }
    }
  });
});
//end of upload new fee

//add new school fee
// add new fee ajax request
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
        Swal.fire(
          'Added!',
          'New Fee Added Successfully!',
          'success'
        )

        fetchtosflist();

        $("#btn_save_tosf").text('Save');
        $("#frm_add_tosf")[0].reset();
        $("#modal_add_tosf").modal('hide');
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
        $("#btn_save_tosf").text('Save');
      }
    }
  });
});
//end of add new fee

// edit fee ajax request
$(document).on('click', '.btn_update_fee', function (e) {
  e.preventDefault();
  let id = $(this).attr('id');
  $.ajax({
    url: '/admin/editfee',
    method: 'get',
    data: {
      uid: id,
      _token: '{{ csrf_token() }}'
    },
    success: function (response) {
      $('#update_tosf_id').val(response.uid);
      $('#update_tosf_program').val(response.course_enrolled);
      $('#update_tosf_year_level').val(response.year_level);
      $('#update_tosf_semester').val(response.semester);
      $('#update_tosf_type_of_fee').val(response.type_of_fee);
      $('#update_tosf_category').val(response.category);
      $('#update_tosf_coverage').val(response.coverage);
      $('#update_tosf_amount').val(response.amount);

    }
  });
});

// update students ajax request
$("#frm_update_tosf").submit(function (e) {
  e.preventDefault();
  const fd = new FormData(this);
  $("#btn_update_tosf").text('Updating...');
  $.ajax({
    url: '/admin/updatefee',
    method: 'post',
    data: fd,
    cache: false,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (response) {
      if (response.status == 200) {
        Swal.fire(
          'Updated!',
          'Fee Updated Successfully!',
          'success'
        )
        fetchtosflist();
        $("#btn_update_tosf").text('Update');
        $("#frm_update_tosf")[0].reset();
        $("#modal_update_tosf").modal('hide');
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
        $("#btn_update_tosf").text('Update');
      }
    }
  });
});

//Delete function
//Main check box is checked
$(document).on('click', 'input[name=main_tosf_checkbox]', function () {
  if (this.checked) {
    $('input[name="tosf_checkbox"]').each(function () {
      this.checked = true;
    });
  } else {
    $('input[name="tosf_checkbox"]').each(function () {
      this.checked = false;
    });
  }
  btnDeleteToggle();
});

//all checkbox in a page is checked
$(document).on('change', 'input[name="tosf_checkbox"]', function () {
  if ($('input[name="tosf_checkbox"]').length == $('input[name="tosf_checkbox"]:checked').length) {
    $('input[name="main_tosf_checkbox"]').prop('checked', true);
  } else {
    $('input[name="main_tosf_checkbox"]').prop('checked', false);
  }
  btnDeleteToggle();
});

//Delete data
$(document).on('click', '#btn_tosf_remove', function () {
  var checkedFees = [];
  $($('input[name="tosf_checkbox"]:checked')).each(function () {
    checkedFees.push($(this).val());
  });
  let id = checkedFees;

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/admin/deletefee',
        method: 'delete',
        data: {
          uid: id
        },
        success: function (response) {
          console.log(response);
          Swal.fire(
            'Deleted!',
            'Fee has been deleted.',
            'success'
          )
          $('#btn_tosf_remove').addClass('d-none');
          fetchtosflist();
        }
      });
    }
  })
});

//Delete button hide and show
function btnDeleteToggle() {
  if ($('input[name="tosf_checkbox"]:checked').length > 0) {
    $('#btn_tosf_remove').html('');
    $('#btn_tosf_remove').append('<i class="far fa-trash-alt"></i>&nbsp;Remove Fee (' + $('input[name="tosf_checkbox"]:checked').length + ')').removeClass('d-none');
  } else {
    $('#btn_tosf_remove').addClass('d-none');
  }
}



