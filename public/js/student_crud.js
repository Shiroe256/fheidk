fetchTempStudent();
selectDegreePrograms();

// add new student ajax request
$("#frm_add_student").submit(function (e) {
  e.preventDefault();
  const fd = new FormData(this);
  $("#btn_add_student").text('Adding...');

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: '/newtempstudent',
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
          'Student Added Successfully!',
          'success'
        )
        fetchTempStudent();
        $("#btn_add_student").text('Add Student');
        $("#frm_add_student")[0].reset();
        $("#mod_new_student_info").modal('hide');
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
        $("#btn_add_student").text('Add Student');
      }
    }
  });
});
//end of new add student

// get tuition fee based on student's degree_program
$(document).on('change', '#total_unit', function (e) {
  e.preventDefault();
  let course = $("#course_enrolled option:selected").text();
  let total_unit = $("#total_unit").val();
  let year_level = $("#year_level").val();
  $.ajax({
    url: '/get-tuitionfee',
    method: 'get',
    data: {
      course_enrolled: course,
      total_unit: total_unit,
      year_level: year_level,
      _token: '{{ csrf_token() }}'
    },
    success: function (response) {
      console.log(response);
      $("#total_tuition").val(response);
    }
  });
});

if (($('#total_unit').val() !== null || $('#total_unit').val() !== '') && typeof str === 'string' && str.length === 0) {
  $(document).on('change', '#course_enrolled', function (e) {
    e.preventDefault();
    let course = $("#course_enrolled option:selected").text();
    let total_unit = $("#total_unit").val();
    let year_level = $("#year_level").val();
    $.ajax({
      url: '/get-tuitionfee',
      method: 'get',
      data: {
        course_enrolled: course,
        total_unit: total_unit,
        year_level: year_level,
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
        console.log(response);
        $("#total_tuition").val(response);
      }
    });
  });

  $(document).on('change', '#year_level', function (e) {
    e.preventDefault();
    let course = $("#course_enrolled option:selected").text();
    let total_unit = $("#total_unit").val();
    let year_level = $("#year_level").val();
    $.ajax({
      url: '/get-tuitionfee',
      method: 'get',
      data: {
        course_enrolled: course,
        total_unit: total_unit,
        year_level: year_level,
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
        console.log(response);
        $("#total_tuition").val(response);
      }
    });
  });
}

//get other school fee based on student's degree_program
$(document).on('change', '#course_enrolled', function (e) {
  e.preventDefault();
  let course = $("#course_enrolled option:selected").text();
  $.ajax({
    url: '/get-otherschoolfee',
    method: 'get',
    data: {
      course_enrolled: course,
      _token: '{{ csrf_token() }}'
    },
    success: function (response) {
      //console.log(response);
      //display amount
      $("#admission_fee").val(response[0].total_amount);
      $("#athletic_fee").val(response[1].total_amount);
      $("#computer_fee").val(response[2].total_amount);
      $("#cultural_fee").val(response[3].total_amount);
      $("#development_fee").val(response[4].total_amount);
      $("#entrance_fee").val(response[5].total_amount);
      $("#guidance_fee").val(response[6].total_amount);
      $("#handbook_fee").val(response[7].total_amount);
      $("#laboratory_fee").val(response[8].total_amount);
      $("#library_fee").val(response[9].total_amount);
      $("#medical_dental_fee").val(response[10].total_amount);
      $("#registration_fee").val(response[11].total_amount);
      $("#school_id_fee").val(response[12].total_amount);
      //set max amount allowed
      $("#admission_fee").attr("max", response[0].total_amount);
      $("#athletic_fee").attr("max", response[1].total_amount);
      $("#computer_fee").attr("max", response[2].total_amount);
      $("#cultural_fee").attr("max", response[3].total_amount);
      $("#development_fee").attr("max", response[4].total_amount);
      $("#entrance_fee").attr("max", response[5].total_amount);
      $("#guidance_fee").attr("max", response[6].total_amount);
      $("#handbook_fee").attr("max", response[7].total_amount);
      $("#laboratory_fee").attr("max", response[8].total_amount);
      $("#library_fee").attr("max", response[9].total_amount);
      $("#medical_dental_fee").attr("max", response[10].total_amount);
      $("#registration_fee").attr("max", response[11].total_amount);
      $("#school_id_fee").attr("max", response[12].total_amount);

      //disable keys if maximum amount is reached
      $('#admission_fee').on('keyup keydown change', function (e) {
        console.log($(this).val() > response[0].total_amount)
        if ($(this).val() > response[0].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[0].total_amount);
        }
      });

      $('#athletic_fee').on('keyup keydown change', function (e) {
        console.log($(this).val() > response[1].total_amount)
        if ($(this).val() > response[1].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[1].total_amount);
        }
      });

      $('#computer_fee').on('keyup keydown change', function (e) {
        console.log($(this).val() > response[2].total_amount)
        if ($(this).val() > response[2].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[2].total_amount);
        }
      });

      $('#cultural_fee').on('keyup keydown change', function (e) {
        console.log($(this).val() > response[3].total_amount)
        if ($(this).val() > response[3].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[3].total_amount);
        }
      });

      $('#development_fee').on('keyup keydown change', function (e) {
        console.log($(this).val() > response[4].total_amount)
        if ($(this).val() > response[4].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[4].total_amount);
        }
      });

      $('#development_fee').on('keyup keydown change', function (e) {
        console.log($(this).val() > response[4].total_amount)
        if ($(this).val() > response[4].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[4].total_amount);
        }
      });

      $('#entrance_fee').on('keyup keydown change', function (e) {
        console.log($(this).val() > response[5].total_amount)
        if ($(this).val() > response[5].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[5].total_amount);
        }
      });

      $('#guidance_fee').on('keyup keydown change', function (e) {
        console.log($(this).val() > response[6].total_amount)
        if ($(this).val() > response[6].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[6].total_amount);
        }
      });

      $('#handbook_fee').on('keyup keydown change', function (e) {
        console.log($(this).val() > response[7].total_amount)
        if ($(this).val() > response[7].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[7].total_amount);
        }
      });

      $('#laboratory_fee').on('keyup keydown change', function (e) {
        console.log($(this).val() > response[8].total_amount)
        if ($(this).val() > response[8].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[8].total_amount);
        }
      });

      $('#library_fee').on('keyup keydown change', function (e) {
        console.log($(this).val() > response[9].total_amount)
        if ($(this).val() > response[9].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[9].total_amount);
        }
      });

      $('#medical_dental_fee').on('keyup keydown change', function (e) {
        console.log($(this).val() > response[10].total_amount)
        if ($(this).val() > response[10].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[10].total_amount);
        }
      });

      $('#registration_fee').on('keyup keydown change', function (e) {
        console.log($(this).val() > response[11].total_amount)
        if ($(this).val() > response[11].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[11].total_amount);
        }
      });

      $('#school_id_fee').on('keyup keydown change', function (e) {
        console.log($(this).val() > response[12].total_amount)
        if ($(this).val() > response[12].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[12].total_amount);
        }
      });


    }
  });
});

/*
// get other school fee based on student's degree_program
$(document).on('change', '#course_enrolled', function (e) {
  e.preventDefault();
  let course = $("#course_enrolled").val();
  $.ajax({
    url: '/get-otherschoolfee',
    method: 'get',
    data: {
      course_enrolled: course,
      _token: '{{ csrf_token() }}'
    },
    success: function (response) {
      $("#edit_student_id").val(response.uid);
    }
  });
});
*/
// edit student ajax request
$(document).on('click', '.btn_update_student', function (e) {
  e.preventDefault();
  let id = $(this).attr('id');
  $.ajax({
    url: '/edit-tempstudent',
    method: 'get',
    data: {
      uid: id,
      _token: '{{ csrf_token() }}'
    },
    success: function (response) {
      $("#edit_student_id").val(response.uid);
      $("#edit_last_name").val(response.stud_lname);
      $("#edit_first_name").val(response.stud_fname);
      $("#edit_middle_name").val(response.stud_mname);
      $("#edit_extension_name").val(response.stud_ext_name);
      $("#edit_sex").val(response.stud_sex);
      $("#edit_birthdate").val(response.stud_birth_date);
      $("#edit_birthplace").val(response.stud_birth_place);
      $("#edit_m_lname").val(response.m_lname);
      $("#edit_m_fname").val(response.m_fname);
      $("#edit_m_mname").val(response.m_mname);
      $("#edit_f_lname").val(response.f_lname);
      $("#edit_f_fname").val(response.f_fname);
      $("#edit_f_mname").val(response.f_mname);
      $("#edit_present_province").val(response.present_prov);
      $("#edit_present_city").val(response.present_city);
      $("#edit_present_barangay").val(response.present_barangay);
      $("#edit_present_street").val(response.present_street);
      $("#edit_present_zipcode").val(response.present_zipcode);
      $("#edit_permanent_province").val(response.permanent_prov);
      $("#edit_permanent_city").val(response.permanent_city);
      $("#edit_permanent_barangay").val(response.permanent_barangay);
      $("#edit_permanent_street").val(response.permanent_street);
      $("#edit_permanent_zipcode").val(response.permanent_zipcode);
      $("#edit_mobile_number").val(response.stud_phone_no);
      $("#edit_alt_mobile_number").val(response.stud_alt_phone_no);
      $("#edit_email_address").val(response.stud_email);
      $("#edit_alt_email_address").val(response.stud_alt_email);
      $("#edit_course_enrolled").val(response.degree_program);
      $("#edit_year_level").val(response.year_level);
    }
  });
});

// update students ajax request
$("#frm_update_student").submit(function (e) {
  e.preventDefault();
  const fd = new FormData(this);
  $("#btn_update_student").text('Updating...');
  $.ajax({
    url: '/update-tempstudent',
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
          'Student Updated Successfully!',
          'success'
        )
        fetchTempStudent();
        $("#btn_update_student").text('Update Student');
        $("#frm_update_student")[0].reset();
        $("#mod_edit_student_info").modal('hide');
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
        $("#btn_update_student").text('Update Student');
      }
    }
  });
});

//Main check box is checked
$(document).on('click', 'input[name=main_checkbox]', function () {
  if (this.checked) {
    $('input[name="student_checkbox"]').each(function () {
      this.checked = true;
    });
  } else {
    $('input[name="student_checkbox"]').each(function () {
      this.checked = false;
    });
  }
  btnDeleteToggle();
});

//all checkbox in a page is checked
$(document).on('change', 'input[name="student_checkbox"]', function () {
  if ($('input[name="student_checkbox"]').length == $('input[name="student_checkbox"]:checked').length) {
    $('input[name="main_checkbox"]').prop('checked', true);
  } else {
    $('input[name="main_checkbox"]').prop('checked', false);
  }
  btnDeleteToggle();
});

//Delete data
$(document).on('click', '#btn_delete_students', function () {
  var checkedStudents = [];
  $($('input[name="student_checkbox"]:checked')).each(function () {
    checkedStudents.push($(this).val());
  });
  let id = checkedStudents;

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
        url: '/delete-tempstudent',
        method: 'delete',
        data: {
          uid: id
        },
        success: function (response) {
          console.log(response);
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          $('#btn_delete_students').addClass('d-none');
          fetchTempStudent();
        }
      });
    }
  })
});


//Delete button hide and show
function btnDeleteToggle() {
  if ($('input[name="student_checkbox"]:checked').length > 0) {
    $('#btn_delete_students').html('');
    $('#btn_delete_students').append('<i class="fas fa-user-minus"></i>&nbsp;Remove (' + $('input[name="student_checkbox"]:checked').length + ')').removeClass('d-none');
  } else {
    $('#btn_delete_students').addClass('d-none');
  }
}


//nilabas ko para ma call ko sa iba
function fetchTempStudent() {
  $.ajax({
    url: "/get-tempstudents",
    method: 'get',
    success: function (response) {
      $("#show_all_students").html(response);
      $("#tbl_students").DataTable({
        "order": [[3, "asc"]],
        orderCellsTop: true,
        fixedHeader: true,
        columnDefs: [
          { orderable: false, targets: [0, -1] }
        ]
      });
    }
  });
}

function selectDegreePrograms() {
  $.ajax({
    url: '/get-degreeprograms',
    method: 'get',
    data: {
      _token: '{{ csrf_token() }}'
    },
    success: function (response) {
      for (let index = 0; index < response.length; ++index) {
        let degree_program = response[index].course_enrolled;
        $('#course_enrolled').append('<option value=' + degree_program + '>' + degree_program + '</option>');
      }
    }
  });
}