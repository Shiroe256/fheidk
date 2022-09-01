fetchUser();
fetchHeis();

//fetch records from the database
function fetchUser() {
  $.ajax({
    url: "/get-user",
    method: 'get',
    success: function (response) {
      $("#fhe_focal_lname").val(response.fhe_focal_lname);
      $("#fhe_focal_fname").val(response.fhe_focal_fname);
      $("#fhe_focal_mname").val(response.fhe_focal_mname);
      $("#email").val(response.email);
      $("#contact").val(response.contact_no);
      $("#user_avatar").val(response.avatar);
    }
  });
}

//fetch records from the database
function fetchHeis() {
  $.ajax({
    url: "/get-heis",
    method: 'get',
    success: function (response) {
      $('#hei_uii').val(response.hei_uii);
      $('#hei_name').val(response.hei_name);
      $('#hei_address').val(response.hei_prov_name.toLowerCase() + ', ' + response.hei_city_name.toLowerCase());
      $('#hei_email').val(response.hei_email);
      $('#hei_contact').val(response.hei_telno);
      $('#hei_website').val(response.hei_website);
      $('#hei_president_name').val(response.hei_head);
      $('#hei_president_contact').val(response.pres_contact_no);
      // $('#hei_president_email').val(response.pres_contact_no);
    }
  });
}

// update user ajax request
$("#frm_update_user").submit(function (e) {
  e.preventDefault();
  const fd = new FormData(this);

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: '/update-user',
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
          'User Updated Successfully!',
          'success'
        )
        $("#avatar_div").load(location.href + " #avatar_div");
        fetchUser();
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
      }
    }
  });
});