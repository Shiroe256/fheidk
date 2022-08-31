fetchUser();

//fetch records from the database
function fetchUser() {
    $.ajax({
      url: "/get-user",
      method: 'get',
      success: function (response) {
    //    console.log(response[0].fhe_focal_lname);
       console.log(response);
       $("#fhe_focal_lname").val(response.fhe_focal_lname);
       $("#fhe_focal_fname").val(response.fhe_focal_fname);
       $("#fhe_focal_mname").val(response.fhe_focal_mname);
       $("#email").val(response.email);
       $("#contact").val(response.contact_no);
      }
    });
  }