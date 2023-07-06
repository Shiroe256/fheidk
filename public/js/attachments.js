// edit fee ajax request
$(document).on('click', '.2', function (e) {
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