//Process Billing
$(document).on('click', '#btn_forward_to_afms', function () {
  let id = $("#reference_no").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to access this while being reviewed by the CHED-AFMS.",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, forward to CHED-AFMS'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/admin/forwardtoafms',
        method: 'post',
        data: {
          reference_no: id
        },
        success: function (response) {
          Swal.fire(
            'Forwarded!',
            'This billing is now being reviewed by the CHED-AFMS, please wait for the update.',
            'success'
          ).then(() => {
            window.location.href = '/admin/managebillinglist';
          });
        }
      });
    }
  })
});

//Process Billing
$(document).on('click', '#btn_revision_to_hei', function () {
  let id = $("#reference_no").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
    title: 'Are you sure?',
    text: "The HEI will be able to edit this billing once returned.",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, return to HEI for revision'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/admin/forrevision',
        method: 'post',
        data: {
          reference_no: id
        },
        success: function (response) {
          Swal.fire(
            'Returned to HEI!',
            'This billing is now returned to the HEI for revision.',
            'success'
          ).then(() => {
            window.location.href = '/admin/managebillinglist';
          });
        }
      });
    }
  })
});

//Process Billing
$(document).on('click', '#btn_approve_form1', function () {
  let id = $("#reference_no").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
    title: 'Are you sure?',
    text: "Approve Billing Form 1",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, return approve form 1'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/admin/approveform1',
        method: 'post',
        data: {
          reference_no: id
        },
        success: function (response) {
          Swal.fire(
            'Approved Form 1!',
            'Form 1 is now approved for billing.',
            'success'
          ).then(() => {
            // Reload the specific div
            $("#tbl_billing_attachments_div").load(location.href + " #tbl_billing_attachments_div");
          });
        }
      });
    }
  })
});