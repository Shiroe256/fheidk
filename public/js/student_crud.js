fetchTempStudent();
selectDegreePrograms();
selectCampus();

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
        fetchTempSummary();
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

// get tuition fee based on student's degree_program for adding student in form 1
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

// get nstp fee based on student's degree_program
$(document).on('change', '#nstp_unit', function (e) {
  e.preventDefault();
  let course = $("#course_enrolled option:selected").text();
  let nstp_unit = $("#nstp_unit").val();
  let year_level = $("#year_level").val();
  $.ajax({
    url: '/get-nstpfee',
    method: 'get',
    data: {
      course_enrolled: course,
      nstp_unit: nstp_unit,
      year_level: year_level,
      _token: '{{ csrf_token() }}'
    },
    success: function (response) {
      $("#total_nstp").val(response);
    }
  });
});

if (($('#total_nstp').val() !== null || $('#total_nstp').val() !== '') && typeof str === 'string' && str.length === 0) {
  $(document).on('change', '#course_enrolled', function (e) {
    e.preventDefault();
  let course = $("#course_enrolled option:selected").text();
  let nstp_unit = $("#nstp_unit").val();
  let year_level = $("#year_level").val();
  $.ajax({
    url: '/get-nstpfee',
    method: 'get',
    data: {
      course_enrolled: course,
      nstp_unit: nstp_unit,
      year_level: year_level,
      _token: '{{ csrf_token() }}'
    },
    success: function (response) {
      console.log(response);
      $("#total_nstp").val(response);
    }
  });
});

  $(document).on('change', '#year_level', function (e) {
    e.preventDefault();
    let course = $("#course_enrolled option:selected").text();
    let nstp_unit = $("#nstp_unit").val();
    let year_level = $("#year_level").val();
    $.ajax({
      url: '/get-nstpfee',
      method: 'get',
      data: {
        course_enrolled: course,
        nstp_unit: nstp_unit,
        year_level: year_level,
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
        console.log(response);
        $("#total_nstp").val(response);
      }
    });
  });
}

//get other school fee based on student's degree_program
$(document).on('change', '#course_enrolled', function (e) {
  e.preventDefault();
  getOSF();
});

$(document).on('change', '#year_level', function (e) {
  e.preventDefault();
  getOSF();
});

function getOSF(){
  let reference_no = $("#add_reference_no").val();
  let course_enrolled = $("#course_enrolled option:selected").text();
  let year_level = $("#year_level").val();
  let semester = $("#add_semester").val();
  
  $.ajax({
    url: '/get-otherschoolfee',
    method: 'get',
    data: {
      reference_no: reference_no,
      course_enrolled: course_enrolled,
      year_level: year_level,
      semester: semester,
      _token: '{{ csrf_token() }}'
    },
    success: function (response) {
      if(response==0 || response.length==0){
        console.log(response);
      }else{
        console.log(response);

        let traveler = response;

        var res = traveler.reduce((acc, obj)=>{
          var existItem = acc.find(item => item.type_of_fee === obj.type_of_fee && item.coverage === obj.coverage && item.bs_status === obj.bs_status);
          if(existItem){
            existItem.amount += obj.amount;
            return acc;
          } 
          acc.push(obj);
          return acc;
        }, []);

        console.log(res);

    //   //display amount
    //   $("#admission_fee").val(response[0].result);
    //   $("#athletic_fee").val(response[1].result);
    //   $("#computer_fee").val(response[2].result);
    //   $("#cultural_fee").val(response[3].result);
    //   $("#development_fee").val(response[4].result);
    //   $("#entrance_fee").val(response[5].result);
    //   $("#guidance_fee").val(response[6].result);
    //   $("#handbook_fee").val(response[7].result);
    //   $("#laboratory_fee").val(response[8].result);
    //   $("#library_fee").val(response[9].result);
    //   $("#medical_dental_fee").val(response[10].result);
    //   $("#registration_fee").val(response[11].result);
    //   $("#school_id_fee").val(response[12].result);
    //   $("#degree_program").val($("#course_enrolled option:selected").text());
    //   //set max amount allowed
    //   $("#admission_fee").attr("max", response[0].result);
    //   $("#athletic_fee").attr("max", response[1].result);
    //   $("#computer_fee").attr("max", response[2].result);
    //   $("#cultural_fee").attr("max", response[3].result);
    //   $("#development_fee").attr("max", response[4].result);
    //   $("#entrance_fee").attr("max", response[5].result);
    //   $("#guidance_fee").attr("max", response[6].result);
    //   $("#handbook_fee").attr("max", response[7].result);
    //   $("#laboratory_fee").attr("max", response[8].result);
    //   $("#library_fee").attr("max", response[9].result);
    //   $("#medical_dental_fee").attr("max", response[10].result);
    //   $("#registration_fee").attr("max", response[11].result);
    //   $("#school_id_fee").attr("max", response[12].result);
    //   //disable keys if maximum amount is reached
    //   $('#admission_fee').on('keyup keydown change', function (e) {
    //     if ($(this).val() > response[0].result
    //       && e.keyCode !== 46
    //       && e.keyCode !== 8
    //     ) {
    //       e.preventDefault();
    //       $(this).val(response[0].result);
    //     }
    //   });
    //   $('#athletic_fee').on('keyup keydown change', function (e) {
    //     if ($(this).val() > response[1].result
    //       && e.keyCode !== 46
    //       && e.keyCode !== 8
    //     ) {
    //       e.preventDefault();
    //       $(this).val(response[1].result);
    //     }
    //   });
    //   $('#computer_fee').on('keyup keydown change', function (e) {
    //     if ($(this).val() > response[2].result
    //       && e.keyCode !== 46
    //       && e.keyCode !== 8
    //     ) {
    //       e.preventDefault();
    //       $(this).val(response[2].result);
    //     }
    //   });
    //   $('#cultural_fee').on('keyup keydown change', function (e) {
    //     if ($(this).val() > response[3].result
    //       && e.keyCode !== 46
    //       && e.keyCode !== 8
    //     ) {
    //       e.preventDefault();
    //       $(this).val(response[3].result);
    //     }
    //   });
    //   $('#development_fee').on('keyup keydown change', function (e) {
    //     if ($(this).val() > response[4].result
    //       && e.keyCode !== 46
    //       && e.keyCode !== 8
    //     ) {
    //       e.preventDefault();
    //       $(this).val(response[4].result);
    //     }
    //   });
    //   $('#entrance_fee').on('keyup keydown change', function (e) {
    //     if ($(this).val() > response[5].result
    //       && e.keyCode !== 46
    //       && e.keyCode !== 8
    //     ) {
    //       e.preventDefault();
    //       $(this).val(response[5].result);
    //     }
    //   });
    //   $('#guidance_fee').on('keyup keydown change', function (e) {
    //     if ($(this).val() > response[6].result
    //       && e.keyCode !== 46
    //       && e.keyCode !== 8
    //     ) {
    //       e.preventDefault();
    //       $(this).val(response[6].result);
    //     }
    //   });
    //   $('#handbook_fee').on('keyup keydown change', function (e) {
    //     if ($(this).val() > response[7].result
    //       && e.keyCode !== 46
    //       && e.keyCode !== 8
    //     ) {
    //       e.preventDefault();
    //       $(this).val(response[7].result);
    //     }
    //   });
    //   $('#laboratory_fee').on('keyup keydown change', function (e) {
    //     if ($(this).val() > response[8].result
    //       && e.keyCode !== 46
    //       && e.keyCode !== 8
    //     ) {
    //       e.preventDefault();
    //       $(this).val(response[8].result);
    //     }
    //   });
    //   $('#library_fee').on('keyup keydown change', function (e) {
    //     if ($(this).val() > response[9].result
    //       && e.keyCode !== 46
    //       && e.keyCode !== 8
    //     ) {
    //       e.preventDefault();
    //       $(this).val(response[9].result);
    //     }
    //   });
    //   $('#medical_dental_fee').on('keyup keydown change', function (e) {
    //     if ($(this).val() > response[10].result
    //       && e.keyCode !== 46
    //       && e.keyCode !== 8
    //     ) {
    //       e.preventDefault();
    //       $(this).val(response[10].result);
    //     }
    //   });
    //   $('#registration_fee').on('keyup keydown change', function (e) {
    //     if ($(this).val() > response[11].result
    //       && e.keyCode !== 46
    //       && e.keyCode !== 8
    //     ) {
    //       e.preventDefault();
    //       $(this).val(response[11].result);
    //     }
    //   });
    //   $('#school_id_fee').on('keyup keydown change', function (e) {
    //     if ($(this).val() > response[12].result
    //       && e.keyCode !== 46
    //       && e.keyCode !== 8
    //     ) {
    //       e.preventDefault();
    //       $(this).val(response[12].result);
    //     }
    //   });
    }
   }
  });
}

//Update student
$(document).on('change', '#edit_course_enrolled', function (e) {
  e.preventDefault();
  let course = $("#edit_course_enrolled option:selected").text();
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
      $("#edit_admission_fee").val(response[0].total_amount);
      $("#edit_athletic_fee").val(response[1].total_amount);
      $("#edit_computer_fee").val(response[2].total_amount);
      $("#edit_cultural_fee").val(response[3].total_amount);
      $("#edit_development_fee").val(response[4].total_amount);
      $("#edit_entrance_fee").val(response[5].total_amount);
      $("#edit_guidance_fee").val(response[6].total_amount);
      $("#edit_handbook_fee").val(response[7].total_amount);
      $("#edit_laboratory_fee").val(response[8].total_amount);
      $("#edit_library_fee").val(response[9].total_amount);
      $("#edit_medical_dental_fee").val(response[10].total_amount);
      $("#edit_registration_fee").val(response[11].total_amount);
      $("#edit_school_id_fee").val(response[12].total_amount);
      $("#edit_degree_program").val($("#edit_course_enrolled option:selected").text());
      //set max amount allowed
      $("#edit_admission_fee").attr("max", response[0].total_amount);
      $("#edit_athletic_fee").attr("max", response[1].total_amount);
      $("#edit_computer_fee").attr("max", response[2].total_amount);
      $("#edit_cultural_fee").attr("max", response[3].total_amount);
      $("#edit_development_fee").attr("max", response[4].total_amount);
      $("#edit_entrance_fee").attr("max", response[5].total_amount);
      $("#edit_guidance_fee").attr("max", response[6].total_amount);
      $("#edit_handbook_fee").attr("max", response[7].total_amount);
      $("#edit_laboratory_fee").attr("max", response[8].total_amount);
      $("#edit_library_fee").attr("max", response[9].total_amount);
      $("#edit_medical_dental_fee").attr("max", response[10].total_amount);
      $("#edit_registration_fee").attr("max", response[11].total_amount);
      $("#edit_school_id_fee").attr("max", response[12].total_amount);
      //disable keys if maximum amount is reached
      $('#edit_admission_fee').on('keyup keydown change', function (e) {
        if ($(this).val() > response[0].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[0].total_amount);
        }
      });
      $('#edit_athletic_fee').on('keyup keydown change', function (e) {
        if ($(this).val() > response[1].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[1].total_amount);
        }
      });
      $('#edit_computer_fee').on('keyup keydown change', function (e) {
        if ($(this).val() > response[2].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[2].total_amount);
        }
      });
      $('#edit_cultural_fee').on('keyup keydown change', function (e) {
        if ($(this).val() > response[3].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[3].total_amount);
        }
      });
      $('#edit_development_fee').on('keyup keydown change', function (e) {
        if ($(this).val() > response[4].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[4].total_amount);
        }
      });
      $('#edit_entrance_fee').on('keyup keydown change', function (e) {
        if ($(this).val() > response[5].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[5].total_amount);
        }
      });
      $('#edit_guidance_fee').on('keyup keydown change', function (e) {
        if ($(this).val() > response[6].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[6].total_amount);
        }
      });
      $('#edit_handbook_fee').on('keyup keydown change', function (e) {
        if ($(this).val() > response[7].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[7].total_amount);
        }
      });
      $('#edit_laboratory_fee').on('keyup keydown change', function (e) {
        if ($(this).val() > response[8].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[8].total_amount);
        }
      });
      $('#edit_library_fee').on('keyup keydown change', function (e) {
        if ($(this).val() > response[9].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[9].total_amount);
        }
      });
      $('#edit_medical_dental_fee').on('keyup keydown change', function (e) {
        if ($(this).val() > response[10].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[10].total_amount);
        }
      });
      $('#edit_registration_fee').on('keyup keydown change', function (e) {
        if ($(this).val() > response[11].total_amount
          && e.keyCode !== 46
          && e.keyCode !== 8
        ) {
          e.preventDefault();
          $(this).val(response[11].total_amount);
        }
      });
      $('#edit_school_id_fee').on('keyup keydown change', function (e) {
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

//If checkbox_address is checked
$(document).on('click', 'input[name=checkbox_address]', function () {
  if (this.checked) {
   $("input[name=permanent_province]").val($("input[name=present_province]").val());
   $("input[name=permanent_city]").val($("input[name=present_city]").val());
   $("input[name=permanent_barangay]").val($("input[name=present_barangay]").val());
   $("input[name=permanent_street]").val($("input[name=present_street]").val());
   $("input[name=permanent_zipcode]").val($("input[name=present_zipcode]").val());
  }else{
    $("input[name=permanent_province]").val('');
    $("input[name=permanent_city]").val('');
    $("input[name=permanent_barangay]").val('');
    $("input[name=permanent_street]").val('');
    $("input[name=permanent_zipcode]").val('');
  }
});

//If edit_checkbox_address is checked
$(document).on('click', 'input[name=edit_checkbox_address]', function () {
  if (this.checked) {
   $("input[name=edit_permanent_province]").val($("input[name=edit_present_province]").val());
   $("input[name=edit_permanent_city]").val($("input[name=edit_present_city]").val());
   $("input[name=edit_permanent_barangay]").val($("input[name=edit_present_barangay]").val());
   $("input[name=edit_permanent_street]").val($("input[name=edit_present_street]").val());
   $("input[name=edit_permanent_zipcode]").val($("input[name=edit_present_zipcode]").val());
  }else{
    $("input[name=edit_permanent_province]").val('');
    $("input[name=edit_permanent_city]").val('');
    $("input[name=edit_permanent_barangay]").val('');
    $("input[name=edit_permanent_street]").val('');
    $("input[name=edit_permanent_zipcode]").val('');
  }
});

//if student has nstp
$(document).on('click', 'input[name=checkbox_nstp]', function () {
  if (this.checked) {
    $('.input_nstp').removeClass('d-none')
  }else{
    $('.input_nstp').addClass('d-none')
  }
});

//if students is a transferee
$(document).on('click', 'input[name=checkbox_transferee]', function () {
  if (this.checked) {
    $('.input_transferee').removeClass('d-none')
  }else{
    $('.input_transferee').addClass('d-none')
  }
});

//if students is a freshmen
$(document).on('change', '#year_level', function () {
  if ($(this).val() == 1) {
    $('.input_transferee').removeClass('d-none')
  }else{
    $('.input_transferee').addClass('d-none')
  }
});

// edit student ajax request
// aayusin pa yung sa max amount, naka onchange yung course
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
      $('#edit_selected_campus').val(response.hei_name);
      $('#edit_hei_campus').val(response.hei_name);
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
      $("#edit_degree_program").val(response.degree_program);
      $('#edit_course_enrolled').val(response.degree_program);
      $("#edit_year_level").val(response.year_level);
      $("#edit_total_unit").val(response.academic_unit);
      $("#edit_tuition_fee").val(response.tuition_fee);
      $("#edit_nstp_unit").val(response.nstp_unit);
      $("#edit_nstp_fee").val(response.nstp_fee);
      $("#edit_entrance_fee").val(response.entrance_fee);
      $("#edit_admission_fee").val(response.admission_fee);
      $("#edit_athletic_fee").val(response.athletic_fee);
      $("#edit_computer_fee").val(response.computer_fee);
      $("#edit_cultural_fee").val(response.cultural_fee);
      $("#edit_development_fee").val(response.development_fee);
      $("#edit_guidance_fee").val(response.guidance_fee);
      $("#edit_handbook_fee").val(response.handbook_fee);
      $("#edit_laboratory_fee").val(response.laboratory_fee);
      $("#edit_library_fee").val(response.library_fee);
      $("#edit_medical_dental_fee").val(response.medical_dental_fee);
      $("#edit_registration_fee").val(response.registration_fee);
      $("#edit_school_id_fee").val(response.school_id_fee);
      $("#edit_remarks").val(response.remarks);

      if(($("#edit_present_province").val() ==  $("#edit_permanent_province").val()) && ($("#edit_present_city").val() ==  $("#edit_permanent_city").val()) && ($("#edit_present_barangay").val() ==  $("#edit_permanent_barangay").val()) && ($("#edit_present_street").val() ==  $("#edit_permanent_street").val()) && ($("#edit_present_zipcode").val() ==  $("#edit_permanent_zipcode").val())){
        $("#edit_checkbox_address").prop('checked', true);
      }

      if(response.transferee == "Yes"){
        $("#edit_checkbox_transferee").prop('checked', true);
      }else{
        ("#edit_checkbox_transferee").p
        rop('checked', false);
      }

      if($("#edit_nstp_unit").val() !== ""){
        $("#nstp_div").removeClass("d-none");
        $("#edit_with_nstp").prop('checked', true);
      }
    }
  });
});

//No NSTP Value
$(document).on('click', '#edit_with_nstp', function () {
  if (this.checked) {
    $("#nstp_div").removeClass("d-none");
  }else{
    $("#edit_nstp_unit").val("");
    $("#edit_nstp_fee").val("");

    $("#nstp_div").addClass("d-none");
  }
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

//Delete function
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
            'Student record has been deleted.',
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

//fetch records from the database
function fetchTempStudent() {
  let reference_no = $("#reference_no").val();
  $.ajax({
    url: "/get-tempstudents",
    method: 'get',
    data: {
      reference_no: reference_no,
      _token: '{{ csrf_token() }}'
    },
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

//fetch all degree programs from the database to select input
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
        $('#course_applied').append('<option value=' + degree_program + '>' + degree_program + '</option>');
      }
    }
  });
}

//fetch all degree programs from the database to select input
function selectCampus() {
  $.ajax({
    url: '/get-campus',
    method: 'get',
    data: {
      _token: '{{ csrf_token() }}'
    },
    success: function (response) {
      if(response.length == 1){
        $('.campus_div').addClass('d-none');
        $('#selected_campus').val(response[0].hei_name);
      }else{
      $('.campus_div').removeClass('d-none');
      for (let index = 0; index < response.length; ++index) {
        let campus = response[index].hei_name;
        let hei_uii = response[index].hei_uii;
        $('#hei_campus').append('<option id='+ hei_uii +' value=' + campus + '>' + campus + '</option>');
        $('#applied_hei_campus').append('<option id='+ hei_uii +' value=' + campus + '>' + campus + '</option>');
      }
    }
    }
  });
}

//set inputs value
$(document).on('change', '#hei_campus', function (e) {
  e.preventDefault();
  let campus = $("#hei_campus option:selected").text();
  let hei_uii = $("#hei_campus option:selected").attr('id');
  $("#add_selected_campus").val(campus);
  $("#add_hei_uii").val(hei_uii);
});

//set inputs value for edit
$(document).on('change', '#edit_hei_campus', function (e) {
  e.preventDefault();
  let campus = $("#edit_hei_campus option:selected").text();
  let hei_uii = $("#edit_hei_campus option:selected").attr('id');
  $("#edit_selected_campus").val(campus);
  $("#edit_hei_uii").val(hei_uii);
});