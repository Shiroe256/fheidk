// edit fee ajax request
$(document).on('click', '.btn_link_form1', function (e) {
    e.preventDefault();
    let reference_no = $(this).attr('id');
    $.ajax({
      url: '/admin/editlink',
      method: 'get',
      data: {
        reference_no: reference_no,
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
        alert();
        $('#link_form1').val(response.form1_link);
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