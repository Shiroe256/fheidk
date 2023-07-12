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
    confirmButtonText: 'Yes, approve form 1'
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
            'Form 1 has been approved for billing.',
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

//Process Billing
$(document).on('click', '#btn_reject_form1', function () {
  let id = $("#reference_no").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
    title: 'Are you sure?',
    text: "Reject Billing Form 1",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, reject form 1'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/admin/rejectform1',
        method: 'post',
        data: {
          reference_no: id
        },
        success: function (response) {
          Swal.fire(
            'Rejected Form 1!',
            'Form 1 has been rejected for billing.',
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

//Process Billing
$(document).on('click', '#btn_approve_form2', function () {
  let id = $("#reference_no").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
    title: 'Are you sure?',
    text: "Approve Billing Form 2",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, approve form 2'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/admin/approveform2',
        method: 'post',
        data: {
          reference_no: id
        },
        success: function (response) {
          Swal.fire(
            'Approved Form 2!',
            'Form 2 has been approved for billing.',
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

//Process Billing
$(document).on('click', '#btn_reject_form2', function () {
  let id = $("#reference_no").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
    title: 'Are you sure?',
    text: "Reject Billing Form 2",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, reject form 2'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/admin/rejectform2',
        method: 'post',
        data: {
          reference_no: id
        },
        success: function (response) {
          Swal.fire(
            'Rejected Form 2!',
            'Form 2 has been rejected for billing.',
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

//Process Billing
$(document).on('click', '#btn_approve_form3', function () {
  let id = $("#reference_no").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
    title: 'Are you sure?',
    text: "Approve Billing Form 3",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, approve form 3'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/admin/approveform3',
        method: 'post',
        data: {
          reference_no: id
        },
        success: function (response) {
          Swal.fire(
            'Approved Form 3!',
            'Form 3 has been approved for billing.',
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

//Process Billing
$(document).on('click', '#btn_reject_form3', function () {
  let id = $("#reference_no").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
    title: 'Are you sure?',
    text: "Reject Billing Form 3",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, reject form 3'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/admin/rejectform3',
        method: 'post',
        data: {
          reference_no: id
        },
        success: function (response) {
          Swal.fire(
            'Rejected Form 3!',
            'Form 3 has been rejected for billing.',
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

//Process Billing
$(document).on('click', '#btn_approve_reg_cert', function () {
  let id = $("#reference_no").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
    title: 'Are you sure?',
    text: "Approve Registrar Certification",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, approve registrar certification'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/admin/approveregcert',
        method: 'post',
        data: {
          reference_no: id
        },
        success: function (response) {
          Swal.fire(
            'Approved Registrar Certification!',
            'Registrar certification has been approved for billing.',
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

//Process Billing
$(document).on('click', '#btn_reject_reg_cert', function () {
  let id = $("#reference_no").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
    title: 'Are you sure?',
    text: "Reject Registrar Certification",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, reject registrar certification'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/admin/rejectregcert',
        method: 'post',
        data: {
          reference_no: id
        },
        success: function (response) {
          Swal.fire(
            'Rejected Registrar Certification!',
            'Registration certification has been rejected for billing.',
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

//Process Billing
$(document).on('click', '#btn_approve_cor', function () {
  let id = $("#reference_no").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
    title: 'Are you sure?',
    text: "Approve COR",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, approve cor'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/admin/approvecor',
        method: 'post',
        data: {
          reference_no: id
        },
        success: function (response) {
          Swal.fire(
            'Approved COR!',
            'COR has been approved for billing.',
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

//Process Billing
$(document).on('click', '#btn_reject_cor', function () {
  let id = $("#reference_no").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
    title: 'Are you sure?',
    text: "Reject COR",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, reject cor'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/admin/rejectcor',
        method: 'post',
        data: {
          reference_no: id
        },
        success: function (response) {
          Swal.fire(
            'Rejected COR!',
            'COR has been rejected for billing.',
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

//Process Billing
$(document).on('click', '#btn_approve_hei_bank_cert', function () {
  let id = $("#reference_no").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
    title: 'Are you sure?',
    text: "Approve HEI Bank Certification",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, approve hei bank certification'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/admin/approveheibankcert',
        method: 'post',
        data: {
          reference_no: id
        },
        success: function (response) {
          Swal.fire(
            'Approved HEI Bank Certification!',
            'HEI Bank Certification has been approved for billing.',
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

//Process Billing
$(document).on('click', '#btn_reject_hei_bank_cert', function () {
  let id = $("#reference_no").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
    title: 'Are you sure?',
    text: "Reject HEI Bank Certification",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, reject hei bank certification'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/admin/rejectheibankcert',
        method: 'post',
        data: {
          reference_no: id
        },
        success: function (response) {
          Swal.fire(
            'Rejected HEI Bank Certification!',
            'HEI Bank Certification has been rejected for billing.',
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

//Process Billing
$(document).on('click', '#btn_approve_bank_cert', function () {
  let id = $("#reference_no").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
    title: 'Are you sure?',
    text: "Approve Bank Certification",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, approve bank certification'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/admin/approvebankcert',
        method: 'post',
        data: {
          reference_no: id
        },
        success: function (response) {
          Swal.fire(
            'Approved Bank Certification!',
            'Bank Certification has been approved for billing.',
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

//Process Billing
$(document).on('click', '#btn_reject_bank_cert', function () {
  let id = $("#reference_no").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
    title: 'Are you sure?',
    text: "Reject Bank Certification",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, reject bank certification'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/admin/rejectbankcert',
        method: 'post',
        data: {
          reference_no: id
        },
        success: function (response) {
          Swal.fire(
            'Rejected Bank Certification!',
            'Bank Certification has been rejected for billing.',
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