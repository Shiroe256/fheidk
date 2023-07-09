// edit fee ajax request
$(document).on('click', '.btn_link_form1', function (e) {
    e.preventDefault();
    let reference_no = $(this).attr('id');
    // alert(reference_no);
    $.ajax({
      url: '/editlink',
      method: 'get',
      data: {
        reference_no: reference_no,
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
        // alert();
        // console.log(response);
        $('#link_form1').val(response.form1_link);
      }
    });
  });
  
  $("#frm_link_form1").submit(function (e) {
    e.preventDefault();
    const fd = new FormData(this);
    $("#btn_attach_form1").text('Attaching');
    $.ajax({
        url: '/updatelinkform1',
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
                    'Link Updated Successfully!',
                    'success'
                )
                .then(() => {
                    $("#btn_attach_form1").text('Attach');
                    $("#frm_link_form1")[0].reset();
                    $("#mod_upload_link_form1").modal('hide');
                    // Reload the specific div
                    $("#tbl_billing_attachments_div").load(location.href + " #tbl_billing_attachments_div");
                });
            } else if (response.status == 400) {
                let i = 1;
                let errorMessage = '';
                $.each(response.errors, function (key, err_values) {
                    console.log(err_values);
                    errorMessage = errorMessage + '<br />' + i++ + '. ' + err_values;
                })
                Swal.fire({
                    title: 'Oops... you missed something',
                    html: errorMessage,
                    icon: 'warning',
                })
                .then(() => {
                    $("#btn_attach_form1").text('Attach');
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: 'Invalid Link',
                text: 'Please provide a valid link to continue',
                icon: 'error',
            })
            .then(() => {
                $("#btn_attach_form1").text('Attach');
            });
        }
    });
});

// edit fee ajax request
$(document).on('click', '.btn_link_form2', function (e) {
    e.preventDefault();
    let reference_no = $(this).attr('id');
    // alert(reference_no);
    $.ajax({
      url: '/editlink',
      method: 'get',
      data: {
        reference_no: reference_no,
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
        // alert();
        // console.log(response);
        $('#link_form2').val(response.form2_link);
      }
    });
  });
  
  $("#frm_link_form2").submit(function (e) {
    e.preventDefault();
    const fd = new FormData(this);
    $("#btn_attach_form2").text('Attaching');
    $.ajax({
        url: '/updatelinkform2',
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
                    'Link Updated Successfully!',
                    'success'
                )
                .then(() => {
                    $("#btn_attach_form2").text('Attach');
                    $("#frm_link_form2")[0].reset();
                    $("#mod_upload_link_form2").modal('hide');
                    // Reload the specific div
                    $("#tbl_billing_attachments_div").load(location.href + " #tbl_billing_attachments_div");
                });
            } else if (response.status == 400) {
                let i = 1;
                let errorMessage = '';
                $.each(response.errors, function (key, err_values) {
                    console.log(err_values);
                    errorMessage = errorMessage + '<br />' + i++ + '. ' + err_values;
                })
                Swal.fire({
                    title: 'Oops... you missed something',
                    html: errorMessage,
                    icon: 'warning',
                })
                .then(() => {
                    $("#btn_attach_form2").text('Attach');
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: 'Invalid Link',
                text: 'Please provide a valid link to continue',
                icon: 'error',
            })
            .then(() => {
                $("#btn_attach_form2").text('Attach');
            });
        }
    });
});

// edit fee ajax request
$(document).on('click', '.btn_link_form3', function (e) {
    e.preventDefault();
    let reference_no = $(this).attr('id');
    // alert(reference_no);
    $.ajax({
      url: '/editlink',
      method: 'get',
      data: {
        reference_no: reference_no,
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
        // alert();
        // console.log(response);
        $('#link_form3').val(response.form3_link);
      }
    });
  });
  
  $("#frm_link_form3").submit(function (e) {
    e.preventDefault();
    const fd = new FormData(this);
    $("#btn_attach_form3").text('Attaching');
    $.ajax({
        url: '/updatelinkform3',
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
                    'Link Updated Successfully!',
                    'success'
                )
                .then(() => {
                    $("#btn_attach_form3").text('Attach');
                    $("#frm_link_form3")[0].reset();
                    $("#mod_upload_link_form3").modal('hide');
                    // Reload the specific div
                    $("#tbl_billing_attachments_div").load(location.href + " #tbl_billing_attachments_div");
                });
            } else if (response.status == 400) {
                let i = 1;
                let errorMessage = '';
                $.each(response.errors, function (key, err_values) {
                    console.log(err_values);
                    errorMessage = errorMessage + '<br />' + i++ + '. ' + err_values;
                })
                Swal.fire({
                    title: 'Oops... you missed something',
                    html: errorMessage,
                    icon: 'warning',
                })
                .then(() => {
                    $("#btn_attach_form3").text('Attach');
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: 'Invalid Link',
                text: 'Please provide a valid link to continue',
                icon: 'error',
            })
            .then(() => {
                $("#btn_attach_form3").text('Attach');
            });
        }
    });
});

// edit fee ajax request
$(document).on('click', '.btn_link_reg_cert', function (e) {
    e.preventDefault();
    let reference_no = $(this).attr('id');
    // alert(reference_no);
    $.ajax({
      url: '/editlink',
      method: 'get',
      data: {
        reference_no: reference_no,
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
        // alert();
        // console.log(response);
        $('#link_reg_cert').val(response.reg_cert_link);
      }
    });
  });
  
  $("#frm_link_reg_cert").submit(function (e) {
    e.preventDefault();
    const fd = new FormData(this);
    $("#btn_attach_reg_cert").text('Attaching');
    $.ajax({
        url: '/updatelinknrc',
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
                    'Link Updated Successfully!',
                    'success'
                )
                .then(() => {
                    $("#btn_attach_reg_cert").text('Attach');
                    $("#frm_link_reg_cert")[0].reset();
                    $("#mod_upload_link_reg_cert").modal('hide');
                    // Reload the specific div
                    $("#tbl_billing_attachments_div").load(location.href + " #tbl_billing_attachments_div");
                });
            } else if (response.status == 400) {
                let i = 1;
                let errorMessage = '';
                $.each(response.errors, function (key, err_values) {
                    console.log(err_values);
                    errorMessage = errorMessage + '<br />' + i++ + '. ' + err_values;
                })
                Swal.fire({
                    title: 'Oops... you missed something',
                    html: errorMessage,
                    icon: 'warning',
                })
                .then(() => {
                    $("#btn_attach_reg_cert").text('Attach');
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: 'Invalid Link',
                text: 'Please provide a valid link to continue',
                icon: 'error',
            })
            .then(() => {
                $("#btn_attach_reg_cert").text('Attach');
            });
        }
    });
});

// edit fee ajax request
$(document).on('click', '.btn_link_cor', function (e) {
    e.preventDefault();
    let reference_no = $(this).attr('id');
    // alert(reference_no);
    $.ajax({
      url: '/editlink',
      method: 'get',
      data: {
        reference_no: reference_no,
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
        // alert();
        // console.log(response);
        $('#link_cor').val(response.cor_link);
      }
    });
  });
  
  $("#frm_link_cor").submit(function (e) {
    e.preventDefault();
    const fd = new FormData(this);
    $("#btn_attach_cor").text('Attaching');
    $.ajax({
        url: '/updatelinkcor',
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
                    'Link Updated Successfully!',
                    'success'
                )
                .then(() => {
                    $("#btn_attach_cor").text('Attach');
                    $("#frm_link_cor")[0].reset();
                    $("#mod_upload_link_cor").modal('hide');
                    // Reload the specific div
                    $("#tbl_billing_attachments_div").load(location.href + " #tbl_billing_attachments_div");
                });
            } else if (response.status == 400) {
                let i = 1;
                let errorMessage = '';
                $.each(response.errors, function (key, err_values) {
                    console.log(err_values);
                    errorMessage = errorMessage + '<br />' + i++ + '. ' + err_values;
                })
                Swal.fire({
                    title: 'Oops... you missed something',
                    html: errorMessage,
                    icon: 'warning',
                })
                .then(() => {
                    $("#btn_attach_cor").text('Attach');
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: 'Invalid Link',
                text: 'Please provide a valid link to continue',
                icon: 'error',
            })
            .then(() => {
                $("#btn_attach_cor").text('Attach');
            });
        }
    });
});

// edit fee ajax request
$(document).on('click', '.btn_link_hei_bank_cert', function (e) {
    e.preventDefault();
    let reference_no = $(this).attr('id');
    // alert(reference_no);
    $.ajax({
      url: '/editlink',
      method: 'get',
      data: {
        reference_no: reference_no,
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
        // alert();
        // console.log(response);
        $('#link_hei_bank_cert').val(response.hei_bank_cert_link);
      }
    });
  });
  
  $("#frm_link_hei_bank_cert").submit(function (e) {
    e.preventDefault();
    const fd = new FormData(this);
    $("#btn_attach_hei_bank_cert").text('Attaching');
    $.ajax({
        url: '/updatelinkheibankcert',
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
                    'Link Updated Successfully!',
                    'success'
                )
                .then(() => {
                    $("#btn_attach_hei_bank_cert").text('Attach');
                    $("#frm_link_hei_bank_cert")[0].reset();
                    $("#mod_upload_link_hei_bank_cert").modal('hide');
                    // Reload the specific div
                    $("#tbl_billing_attachments_div").load(location.href + " #tbl_billing_attachments_div");
                });
            } else if (response.status == 400) {
                let i = 1;
                let errorMessage = '';
                $.each(response.errors, function (key, err_values) {
                    console.log(err_values);
                    errorMessage = errorMessage + '<br />' + i++ + '. ' + err_values;
                })
                Swal.fire({
                    title: 'Oops... you missed something',
                    html: errorMessage,
                    icon: 'warning',
                })
                .then(() => {
                    $("#btn_attach_hei_bank_cert").text('Attach');
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: 'Invalid Link',
                text: 'Please provide a valid link to continue',
                icon: 'error',
            })
            .then(() => {
                $("#btn_attach_hei_bank_cert").text('Attach');
            });
        }
    });
});

// edit fee ajax request
$(document).on('click', '.btn_link_bank_cert', function (e) {
    e.preventDefault();
    let reference_no = $(this).attr('id');
    // alert(reference_no);
    $.ajax({
      url: '/editlink',
      method: 'get',
      data: {
        reference_no: reference_no,
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
        // alert();
        // console.log(response);
        $('#link_bank_cert').val(response.bank_cert_link);
      }
    });
  });
  
  $("#frm_link_bank_cert").submit(function (e) {
    e.preventDefault();
    const fd = new FormData(this);
    $("#btn_attach_bank_cert").text('Attaching');
    $.ajax({
        url: '/updatelinkbankcert',
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
                    'Link Updated Successfully!',
                    'success'
                )
                .then(() => {
                    $("#btn_attach_bank_cert").text('Attach');
                    $("#frm_link_bank_cert")[0].reset();
                    $("#mod_upload_link_bank_cert").modal('hide');
                    // Reload the specific div
                    $("#tbl_billing_attachments_div").load(location.href + " #tbl_billing_attachments_div");
                });
            } else if (response.status == 400) {
                let i = 1;
                let errorMessage = '';
                $.each(response.errors, function (key, err_values) {
                    console.log(err_values);
                    errorMessage = errorMessage + '<br />' + i++ + '. ' + err_values;
                })
                Swal.fire({
                    title: 'Oops... you missed something',
                    html: errorMessage,
                    icon: 'warning',
                })
                .then(() => {
                    $("#btn_attach_bank_cert").text('Attach');
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: 'Invalid Link',
                text: 'Please provide a valid link to continue',
                icon: 'error',
            })
            .then(() => {
                $("#btn_attach_bank_cert").text('Attach');
            });
        }
    });
});

<script>
  function myFunction2() {
    // Get all the status elements
    var statuses = [
      {{ $billings->form1_status }},
      {{ $billings->form2_status }},
      {{ $billings->form3_status }},
      {{ $billings->reg_cert_status }},
      {{ $billings->cor_status }},
      {{ $billings->hei_bank_cert_status }},
      {{ $billings->bank_cert_status }}
    ];

    // Check if all statuses are equal to 1
    var allStatusesEqualOne = statuses.every(function(status) {
      return status === 1;
    });

    // If all statuses are equal to 1, remove the d-none class from the button
    if (allStatusesEqualOne) {
      $('#btn_submit').removeClass('d-none');
    }
  }

  // Call the function when the document is ready
  $(document).ready(function() {
    myFunction2();
  });
</script>