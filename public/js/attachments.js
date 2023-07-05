// edit fee ajax request
$(document).on('click', '.btn_link_form1', function (e) {
    e.preventDefault();
    let reference_no = $(this).attr('id');

    alert(reference_no);
    $.ajax({
      url: '/editlink',
      method: 'get',
      data: {
        reference_no: reference_no,
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
        alert();
        console.log(response);
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
                $("#btn_attach_form1").text('Attach');
                $("#frm_link_form1")[0].reset();
                alert('test');
                $("#mod_upload_link_form1").hide();
                //   location.reload(); // Reload the current pa
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
                $("#btn_attach_form1").text('Attach');
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: 'Error',
                text: 'An error occurred while processing the request.',
                icon: 'error',
            });
        }
    });
});
