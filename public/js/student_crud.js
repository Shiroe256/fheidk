//Student Settings
// const toggle = document.getElementById('switch');
const stud_uid = document.getElementById('stud_uid');
const csrf = document.head.querySelector('meta[name="csrf-token"][content]').content;
const mod_stud_settings = new bootstrap.Modal(document.getElementById('mod_stud_settings'), { keyboard: false, backdrop: 'static' });
const loader = document.getElementById('loader');
const mod_stud_settings_placeholder = document.getElementById('settings-placeholder');
const summary_placeholder = document.getElementById('summary_placeholder');
const btn_edit_students = document.getElementById('btn_edit_students');
const btn_close_stud_settings = document.querySelectorAll('#mod_stud_settings div.modal-header button');
const reference_no = document.getElementById('reference_no').value;
const frm_stud_settings_footer = document.getElementById("mod_stud_settings").getElementsByClassName("modal-footer");
const btn_save_student_settings = document.getElementById('btn_save_student_settings');
let updatedata = {};
var students = [];
//from batchbilling js
const fileInput = document.getElementById('upload_template');
const uploadButton = document.getElementById('btn_upload_template');
const btnUploadCloseButton = document.getElementById("btn_closeupload");
const queueButton = document.getElementById("btn_queue");
const templateButton = document.getElementById("btn_download_template");
const mod_upload_batch = new bootstrap.Modal(document.getElementById('mod_upload'), { keyboard: false, backdrop: 'static' });
const btn_upload = document.getElementById("btn_upload");
// const reference_no = $('#reference_no').val();
const ac_year = $('#ac_year').val();
const semester = $('#semester').val();
const tranche = $('#tranche').val();
var templateReq = new XMLHttpRequest();
var templateData = new XMLHttpRequest();
var heiinfo;

btn_upload.onclick = function (e) {
  mod_upload_batch.show();
}
btnUploadCloseButton.onclick = function (e) {
  mod_upload_batch.hide();
}

templateReq.onload = function (e) {
  const workbook = new ExcelJS.Workbook();

  workbook.xlsx.load(templateReq.response)
    .then(function () {
      var ws = workbook.getWorksheet('Billing_Form');
      ws.getCell('B1').value = heiinfo.hei_psg_region;
      ws.getCell('B2').value = heiinfo.hei_uii;
      ws.getCell('B3').value = heiinfo.hei_name;
      ws.getCell('B4').value = reference_no.value;
      var crs = workbook.addWorksheet('courses');
      heiinfo.courses.forEach(course => {
        crs.addRow([course.course_enrolled]);
      });
      crs.state = 'hidden';
      ws.dataValidations.add('AG8:AG20000', {
        type: 'list',
        allowBlank: true,
        formulae: ['courses!$A:$A']
      });
      workbook.xlsx.writeBuffer({
        base64: true
      })
        .then(function (xls64) {
          var a = document.createElement("a");
          var data = new Blob([xls64], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });

          var url = URL.createObjectURL(data);
          a.href = url;
          a.download = "template_" + reference_no.value + ".xlsx";
          document.body.appendChild(a);
          a.click();
          setTimeout(function () {
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
          },
            0);
        })
        .catch(function (error) {
          console.log(error.message);
        });
    });


};
templateData.onload = function (e) {
  heiinfo = JSON.parse(this.responseText);
  templateReq.open("GET", window.location.origin + "/files/templateblank.xlsx", true);
  templateReq.responseType = "arraybuffer";
  templateReq.send();
};

templateButton.onclick = function () {

  templateData.open("POST", window.location.origin + "/fetchTemplateData", true);
  templateData.setRequestHeader("X-Requested-With", 'XMLHttpRequest');
  templateData.setRequestHeader("X-CSRF-Token", $('meta[name="csrf-token"]').attr('content'));
  templateData.send();
}

uploadButton.onclick = function () {

  uploadBatch();
}


fileInput.onchange = () => {

  const selectedFile = fileInput.files[0];


  var reader = new FileReader();
  reader.onload = function (e) {
    var data = e.target.result;
    var workbook = XLSX.readFile(data);
    var sheet = workbook.Sheets.Billing_Form;
    //use this headers instead of the ones on the sheet
    var output = XLSX.utils.sheet_to_json(sheet, {
      range: 7,
      raw: false,
      header: [
        "seq_no",
        "fhe_aw_no",
        "stud_no",
        "lrnum",
        "last_name",
        "given_name",
        "mid_name",
        "ext_name",
        "sex_at_birth",
        "birthdate",
        "birthplace",
        "fathers_lname",
        "fathers_gname",
        "fathers_mname",
        "mothers_lname",
        "mothers_gname",
        "mothers_mname",
        "perm_prov",
        "perm_city",
        "perm_brgy",
        "perm_street",
        "perm_zip",
        "pres_prov",
        "pres_city",
        "pres_brgy",
        "pres_street",
        "pres_zip",
        "email",
        "a_email",
        "contact_number",
        "contact_number_2",
        "is_transferee",
        "degree_course_id",
        "year_level",
        "lab_u",
        "com_lab_u",
        "acad_u",
        "nstp_u",
        "exams",
        "exam_result",
        "remarks"
      ]
    });

    let errorctr = 0; //counts error
    var errors = validateFields(output); //storefields to validate
    let errorhtml = "<table style='text-align: left; vertical-align:top'><thead><tr><th>Row Number--</th><th>Error Description</th></tr></thead><tbody>";
    let ctr = 1;
    errors.forEach(item => {
      if (item.length > 0) ++errorctr;
      errorhtml += '<tr><td>' + ctr++ + '</td><td><ul>';
      item.forEach(column => {
        errorhtml += '<li>' + column + '</li>';
      });
      errorhtml += '</ul></td></tr>';
    });
    errorhtml += '</tbody></table>';
    if (errorctr > 0) {
      $('#mod_upload').modal('hide');
      fileInput.value = '';

      deactivateUploadButton();
      $('#error_count').html(errorctr);
      $('#error_summary').html(errorhtml);
      $('#mod_errors').modal('show');
    } else if (output.length < 1) {
      deactivateUploadButton();
      fileInput.value = '';
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        html: 'Please check the Sheet'
      });
    } else {
      document.getElementById("upload_status").innerHTML = "<strong>" + output.length + " Students detected. Click on Upload." + "</strong>";
      resetUploadButton();
      document.getElementById('upload_template_text').innerHTML = selectedFile.name;
    }
  };
  reader.readAsArrayBuffer(fileInput.files[0]);
}
queueButton.onclick = function () {
  queueBilling();
}
function deactivateUploadButton() {
  uploadButton.disabled = true;
}
function queueBilling() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url: window.location.origin + "/queueBilling",
    type: "POST",
    data: {
      reference_no: reference_no.value
    },
    success: function (data) {
      window.location.href = "/billings?queued=" + reference_no.value;
    },
  });
}
function resetUploadButton() {
  uploadButton.innerHTML = 'Upload';
  uploadButton.disabled = false;
  btnUploadCloseButton.disabled = false;
  fileInput.disabled = false;
}

//generates a 2d array of all the errors per line
function validateFields(data) {

  var errors = [];
  var numpattern = /\d/;
  var sexpattern = /MALE|FEMALE/;
  var datepattern = /^\d{1,2}\/\d{1,2}\/\d{1,4}$/;
  var contactnumpattern = /^(9)\d{9}$/;
  var emailpattern = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
  for (const stud of data) {
    var error = [];
    // errors[ctr] = [];
    // stud['fhe_aw_no']
    // stud['stud_no']
    // stud['lrnum']
    // if(!numpattern.test(stud['seq_no'])) error.push('');
    if (numpattern.test(stud['given_name']) || stud['given_name'] === undefined) error.push('There are invalid characters in the First Name Field');
    if (numpattern.test(stud['mid_name'])) error.push('There are invalid characters in the Middle Name Field');
    // if(numpattern.test(stud['ext_name'])) error.push('There are invalid characters in the First Name Field');
    if (numpattern.test(stud['last_name']) || stud['last_name'] === undefined) error.push('There are invalid characters in the Last Name Field');
    if (sexpattern.test(stud['sex_at_birth']) || stud['sex_at_birth'] === undefined) error.push('There are invalid characters in the Sex Field');
    // console.log(stud['birthdate']);
    if (!datepattern.test(stud['birthdate'])) error.push('The birthdate is using an invalid format');
    if (stud['birthplace'] === undefined) error.push('The birthplace is missing');
    // if (numpattern.test(stud['fathers_lname'])) error.push('There are invalid characters in the Father\'s Last Name Field');
    // if (numpattern.test(stud['fathers_gname'])) error.push('There are invalid characters in the Father\'s First Name Field');
    // if (numpattern.test(stud['fathers_mname'])) error.push('There are invalid characters in the Father\'s Middle Name Field');
    // if (numpattern.test(stud['mothers_lname']) || stud['mothers_lname'] == '') error.push('There are invalid characters in the Mother\'s Last Name Field');
    // if (numpattern.test(stud['mothers_gname']) || stud['mothers_gname'] == '') error.push('There are invalid characters in the Mother\'s First Name Field');
    // if (numpattern.test(stud['mothers_mname'])) error.push('There are invalid characters in the Mother\'s Middle Name Field');
    if (!emailpattern.test(stud['email']) || stud['email'] === undefined) error.push('The email field isn\'t using a valid format');
    // if (!emailpattern.test(stud['a_email']) && stud['a_email'] != '') error.push('The alternate email field isn\'t using a valid format');
    // if (!contactnumpattern.test(stud['contact_number'])) error.push('The contact number is invalid');

    if (stud['perm_prov'] === undefined) error.push('There is an address field missing');
    if (stud['perm_city'] === undefined) error.push('There is an address field missing');
    if (stud['perm_brgy'] === undefined) error.push('There is an address field missing');
    // if (stud['perm_street'] === undefined) error.push('There is an address field missing');
    if (stud['perm_zip'] === undefined) error.push('There is an address field missing');
    if (stud['pres_prov'] === undefined) error.push('There is an address field missing');
    if (stud['pres_city'] === undefined) error.push('There is an address field missing');
    if (stud['pres_brgy'] === undefined) error.push('There is an address field missing');
    // if (stud['pres_street'] === undefined) error.push('There is an address field missing');
    if (stud['pres_zip'] === undefined) error.push('There is an address field missing');

    if (stud['contact_number'] === undefined) error.push('Contact number is missing');
    // if (stud['contact_number_2'] === undefined) error.push('Contact number is missing');
    // if (stud['is_transferee'] === undefined) error.push('Contact number is missing');
    if (stud['degree_course_id'] === undefined) error.push('Course is missing');
    if (!numpattern.test(stud['year_level']) || stud['year_level'] === undefined) error.push('The year level must only be a number or is missing');
    // stud['lab_u']
    // stud['com_lab_u']
    if (stud['acad_u'] === undefined) error.push('Academic units are missing');
    // stud['nstp_u']
    // stud['exams']
    // stud['exam_result']
    // stud['remarks']

    if (error.length > 0) errors.push(error);
  }
  return errors;
}

//upload batch function used in the ajax request
function uploadBatch() {
  var file = document.getElementById("upload_template").files;
  if (file.length < 1) {
    //if there is no file selected
    alert("Please select an XLSX file");
  } else {
    var reader = new FileReader();
    reader.onload = function (e) {
      var data = e.target.result;
      var workbook = XLSX.readFile(data);
      var sheet = workbook.Sheets.Billing_Form;
      //use this headers instead of the ones on the sheet
      var output = XLSX.utils.sheet_to_json(sheet, {
        range: 7,
        raw: false,
        header: [
          "seq_no",
          "fhe_aw_no",
          "stud_no",
          "lrnum",
          "last_name",
          "given_name",
          "mid_name",
          "ext_name",
          "sex_at_birth",
          "birthdate",
          "birthplace",
          "fathers_lname",
          "fathers_gname",
          "fathers_mname",
          "mothers_lname",
          "mothers_gname",
          "mothers_mname",
          "perm_prov",
          "perm_city",
          "perm_brgy",
          "perm_street",
          "perm_zip",
          "pres_prov",
          "pres_city",
          "pres_brgy",
          "pres_street",
          "pres_zip",
          "email",
          "a_email",
          "contact_number",
          "contact_number_2",
          "is_transferee",
          "degree_course_id",
          "year_level",
          "lab_u",
          "com_lab_u",
          "acad_u",
          "nstp_u",
          "exams",
          "exam_result",
          "remarks"
        ]
      });
      $.ajaxSetup({
        headers: {
          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
      });

      let errorctr = 0; //counts error
      var errors = validateFields(output); //storefields to validate
      let errorhtml = "<table style='text-align: left; vertical-align:top'><tbody>";
      let ctr = 1;
      errors.forEach(item => {
        if (item.length > 0) ++errorctr;
        errorhtml += '<tr><td>' + ctr++ + '</td><td><ul>';
        item.forEach(column => {
          errorhtml += '<li>' + column + '</li>';
        });
        errorhtml += '</ul></td></tr>';
      });
      errorhtml += '</tbody></table>';
      if (errorctr > 0) {
        fileInput.value = '';
        $('#mod_upload').modal('hide');
        deactivateUploadButton();
        $('#error_count').html(errorctr);
        $('#error_summary').html(errorhtml);
        $('#mod_errors').modal('show');
      } else if (output.length < 1) {
        deactivateUploadButton();
        fileInput.value = '';
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          html: 'Please check the name of your Sheet'
        });
      } else {
        //if there are no items with errors then the ajax request pushes through
        $.ajax({
          url: window.location.origin + "/add-batchtempstudents",
          type: "POST",
          data: {
            payload: JSON.stringify(output),
            reference_no: reference_no.value,
            ac_year: ac_year,
            semester: semester,
            tranche: tranche
          },
          complete: function () {
            fileInput.value = '';
            resetUploadButton();
            btnUploadCloseButton.click();
            fetchTempStudent();
            fetchTempSummary();
            fetchTempApplicants();
            document.getElementById('upload_template_text').innerHTML = selectedFile.name;
          },
          beforeSend: function () {
            uploadButton.disabled = true;
            btnUploadCloseButton.disabled = true;
            fileInput.disabled = true;
            uploadButton.innerHTML = 'Uploading...';
          },
          success: function (result) {
            console.log(result);
            Swal.fire('Uploading Success',
              'The students in the spreadsheet have been uploaded',
              'success');
          },
          error: function () {
            deactivateUploadButton();
            Swal.fire('An Error has been encountered',
              'The students in the spreadsheet have NOT been uploaded. Please check your XLSX file or contact the administrator',
              'error');
          }
        });
      }
    };
    reader.readAsArrayBuffer(fileInput.files[0]);
  }
}

//end of from batch billing

btn_close_stud_settings.forEach(element => {
  element.onclick = function () {
    mod_stud_settings.hide();
  };
});

let req_update_stud_settings = new XMLHttpRequest();
let req_get_stud_settings = new XMLHttpRequest();
let req_get_stud_fees = new XMLHttpRequest();

function updateStudentFee(bs_student, toggle, reference_no) {

  req_update_stud_settings.open("POST", "/save-studentfee");
  req_update_stud_settings.setRequestHeader("X-Requested-With", 'XMLHttpRequest');
  req_update_stud_settings.setRequestHeader("X-CSRF-TOKEN", csrf);
  req_update_stud_settings.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

  updatedata = {
    bs_osf_uid: toggle,
    bs_student: bs_student,
    reference_no: reference_no
  };

  req_update_stud_settings.send(JSON.stringify(updatedata));
  btn_save_student_settings.disabled = true;
  loader.classList.add('spinner');
};
//gets the modal form
function getStudentSettings(student_uid) {
  req_get_stud_settings.open("POST", "/get-studentsettings");
  req_get_stud_settings.setRequestHeader("X-Requested-With", 'XMLHttpRequest');
  req_get_stud_settings.setRequestHeader("X-CSRF-TOKEN", csrf);
  req_get_stud_settings.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  let json = JSON.stringify({
    bs_student: student_uid,
    reference_no: reference_no.value
  });
  req_get_stud_settings.send(json);
}

function getStudentFees(bs_student) {
  req_get_stud_fees.open("POST", "/get-studentfees");
  req_get_stud_fees.setRequestHeader("X-Requested-With", 'XMLHttpRequest');
  req_get_stud_fees.setRequestHeader("X-CSRF-TOKEN", csrf);
  req_get_stud_fees.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  let json = JSON.stringify({
    bs_student: bs_student
  });
  req_get_stud_fees.send(json);
}

function editStudentsSettings() {
  const chk_students = document.querySelectorAll(".chk_student:checked");
  const btn_stud_settings = document.querySelectorAll('.btn_stud_settings');
  const courses_year = [];
  const modal_title = document.getElementById('lbl_name');
  const frm_stud_settings = document.getElementById('frm_stud_settings');

  loader.className = '';
  frm_stud_settings.innerHTML = '';
  mod_stud_settings_placeholder.style.display = 'block';
  students = [];
  chk_students.forEach(element => {
    var std_course = document.getElementById("std_course_" + element.value).innerHTML;
    var std_year = document.getElementById("std_year_" + element.value).innerHTML;
    students.push(element.value);
    courses_year.push({ course: std_course.toUpperCase(), year: std_year });
  });
  //if only one student is selcted in the checkbox
  if (students.length == 1) {
    btn_stud_settings.forEach(btn => {
      if (btn.value == students[0]) {
        btn.click();
      }
    });
    return 0;
  }
  if (checkSimilarCoursesYear(courses_year) == false) {
    window.alert("Select students with similar courses and year levels only");
    return 0;
  }

  modal_title.innerHTML = "(" + chk_students.length + ") Selected Students with course of " + courses_year[0]['course'] + ".";
  getStudentSettings(chk_students[0].value);
  frm_stud_settings_footer[0].classList.add('d-none');

  mod_stud_settings.show();
}

function checkSimilarCoursesYear(courses = []) {
  const firstCourse = courses[0]['course'];
  const firstYear = courses[0]['year'];
  for (let i = 1; i < courses.length; i++) {
    if (courses[i]['course'] !== firstCourse) {
      return false;
    }
    if (courses[i]['year'] !== firstYear) {
      return false;
    }
  }
  return true;
}

btn_edit_students.onclick = function () {
  editStudentsSettings();
};

function setup_Events() {
  const btn_stud_settings = document.querySelectorAll('.btn_stud_settings');
  const student_fees = document.querySelectorAll('.student_fees');
  student_fees.forEach(element => {
    element.onclick = function () {
      element.classList.add("skeleton");
      element.classList.add("skeleton-text");
      element.innerHTML = "";
      getStudentFees([element.id.substring(10)]);
    };
  });
  btn_stud_settings.forEach(element => {
    element.onclick = function () {
      students = [];
      mod_stud_settings.show();
      loader.className = '';
      frm_stud_settings.innerHTML = '';
      mod_stud_settings_placeholder.style.display = 'block';

      students.push(element.value);
      getStudentSettings(students[0]);

      var fname = document.getElementById('std_fname_' + element.value).innerHTML;
      var lname = document.getElementById('std_lname_' + element.value).innerHTML;
      var mname = document.getElementById('std_mname_' + element.value).innerHTML;

      const modal_title = document.getElementById('lbl_name');

      modal_title.innerHTML = lname + ', ' + fname + ' ' + mname;

      frm_stud_settings_footer[0].classList.add('d-none');
    };
  });
}
btn_save_student_settings.onclick = function () {
  const toggles = document.querySelectorAll('.toggle');
  if (toggles.length < 1) {
    window.alert("There is nothing to save ._.");
    return 0;
  }
  var osf = [];
  toggles.forEach(toggle => {
    toggle.disabled = true;
    osf.push({ "osf": toggle.value, "status": toggle.checked });
  });
  updateStudentFee(students, osf, reference_no.value);
};

req_get_stud_fees.onload = function () {
  var fees = JSON.parse(this.response);
  fees.forEach(fee => {
    const fee_placeholder = document.getElementById('totalfees_' + fee.bs_student);
    fee_placeholder.classList.remove("skeleton");
    fee_placeholder.classList.remove("skeleton-text");
    fee_placeholder.innerHTML = fee.sum;
  });
}

req_get_stud_settings.onload = function () {
  const frm_stud_settings = document.getElementById('frm_stud_settings');
  frm_stud_settings.innerHTML = req_get_stud_settings.response;
  mod_stud_settings_placeholder.style.display = 'none';

  frm_stud_settings_footer[0].classList.remove('d-none');
  document.querySelectorAll('.toggleall').forEach(function (el) {
    el.addEventListener('change', function () {
      var toggle = this.checked;
      var id = this.id.substring(10);
      var checkboxes = document.querySelectorAll('#settings_' + id + ' input[type=checkbox]');
      checkboxes.forEach(function (checkbox) {
        checkbox.checked = toggle;
        checkbox.dispatchEvent(new Event('change'));
      });
    });
  });
}

req_update_stud_settings.onload = function () {
  const toggles = document.querySelectorAll('.toggle');
  toggles.forEach(toggle => {
    toggle.disabled = false;
  });
  btn_save_student_settings.disabled = false;
  loader.classList.remove('spinner');
  if (req_update_stud_settings.response == 1) {
    loader.classList.add('check');
    // $.snack('success','Settings updated succesfully', 5000);
    mod_stud_settings.hide();
    const student_fees = document.querySelectorAll('.student_fees');
    student_fees.forEach(element => {
      updatedata.bs_student.forEach(student => {
        if (element.id.substring(10) == student) {
          element.classList.add("skeleton");
          element.classList.add("skeleton-text");
          element.innerHTML = "";
        }
      });
    });
    getStudentFees(updatedata.bs_student);
  }
  else
    loader.classList.add('cross');
}
//student settings end

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

function getOSF() {
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
      var res = new Array();
      if (response == 0 || response.length == 0) {
        console.log('No selected year or course.');
      } else {
        // console.log(response);
        $("#degree_program").val($("#course_enrolled option:selected").text());

        var res = response.osf.reduce((acc, obj) => {
          var existItem = acc.find(item => item.type_of_fee === obj.type_of_fee && item.coverage === obj.coverage && item.bs_status === obj.bs_status);
          if (existItem) {
            existItem.amount += obj.amount;
            return acc;
          }
          acc.push(obj);
          return acc;
        }, []);

        var other_school_fee = new Array();
        other_school_fee = { res }
        console.log(other_school_fee);

        var admission_fee = other_school_fee.res.filter(function (el) {
          return el.type_of_fee == "Admission" && el.coverage == "per new student" && el.bs_status == 1
        }
        );
        var athletic_fee = other_school_fee.res.filter(function (el) {
          return el.type_of_fee == "Athletic" && el.coverage == "per student" && el.bs_status == 1
        }
        );
        var computer_fee = other_school_fee.res.filter(function (el) {
          return el.type_of_fee == "Computer" && el.coverage == "per student" && el.bs_status == 1
        }
        );
        var computer_fee_per_unit = other_school_fee.res.filter(function (el) {
          return el.type_of_fee == "Computer" && el.coverage == "per unit" && el.bs_status == 1
        }
        );
        var cultural_fee = other_school_fee.res.filter(function (el) {
          return el.type_of_fee == "Cultural" && el.coverage == "per student" && el.bs_status == 1
        }
        );
        var development_fee = other_school_fee.res.filter(function (el) {
          return el.type_of_fee == "Development" && el.coverage == "per student" && el.bs_status == 1
        }
        );
        var entrance_fee = other_school_fee.res.filter(function (el) {
          return el.type_of_fee == "Entrance" && el.coverage == "per student" && el.bs_status == 1
        }
        );
        var guidance_fee = other_school_fee.res.filter(function (el) {
          return el.type_of_fee == "Guidance" && el.coverage == "per student" && el.bs_status == 1
        }
        );
        var handbook_fee = other_school_fee.res.filter(function (el) {
          return el.type_of_fee == "Handbook" && el.coverage == "per student" && el.bs_status == 1
        }
        );
        var laboratory_fee = other_school_fee.res.filter(function (el) {
          return el.type_of_fee == "Laboratory" && el.coverage == "per student" && el.bs_status == 1
        }
        );
        var library_fee = other_school_fee.res.filter(function (el) {
          return el.type_of_fee == "Library" && el.coverage == "per student" && el.bs_status == 1
        }
        );
        var medical_dental_fee = other_school_fee.res.filter(function (el) {
          return el.type_of_fee == "Medical and Dental" && el.coverage == "per student" && el.bs_status == 1
        }
        );
        var registration_fee = other_school_fee.res.filter(function (el) {
          return el.type_of_fee == "Registration" && el.coverage == "per student" && el.bs_status == 1
        }
        );
        var school_id_fee = other_school_fee.res.filter(function (el) {
          return el.type_of_fee == "School ID" && el.coverage == "per student" && el.bs_status == 1
        }
        );

        if (admission_fee.length == 0) {
          //display amount
          $("#admission_fee").val(0);
          //set max amount
          $("#admission_fee").attr("max", 0);
          //disable keys if maximum amount is reached
          $('#admission_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > 0
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(0);
            }
          });
        } else {
          //display amount
          $("#admission_fee").val(admission_fee[0].amount);
          //set max amount
          $("#admission_fee").attr("max", admission_fee[0].amount);
          //disable keys if maximum amount is reached
          $('#admission_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > admission_fee[0].amount
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(admission_fee[0].amount);
            }
          });
        }

        if (athletic_fee.length == 0) {
          $("#athletic_fee").val(0);
          $("#athletic_fee").attr("max", 0);
          $('#athletic_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > 0
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(0);
            }
          });
        } else {
          $("#athletic_fee").val(athletic_fee[0].amount);
          $("#athletic_fee").attr("max", athletic_fee[0].amount);
          $('#athletic_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > athletic_fee[0].amount
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(athletic_fee[0].amount);
            }
          });
        }

        if (computer_fee.length == 0) {
          $("#computer_fee").val(0);
          $("#computer_fee").attr("max", 0);
          $('#computer_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > 0
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(0);
            }
          });
        } else {
          $("#computer_fee").val(computer_fee[0].amount);
          $("#computer_fee").attr("max", computer_fee[0].amount);
          $('#computer_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > computer_fee[0].amount
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(computer_fee[0].amount);
            }
          });
        }

        if (computer_fee_per_unit.length == 0) {
          $("#computer_fee_per_unit_div").hide(300);
        } else {
          $("#computer_fee_per_unit_div").show(300);
          $(document).on('change', '#computer_fee_per_unit', function (e) {
            var total_comp_fee = $("#computer_fee_per_unit").val() * computer_fee_per_unit[0].amount
            $("#computer_fee_per_unit_amount").val(total_comp_fee);
          });
        }

        if (cultural_fee.length == 0) {
          $("#cultural_fee").val(0);
          $("#cultural_fee").attr("max", 0);
          $('#cultural_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > 0
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(0);
            }
          });
        } else {
          $("#cultural_fee").val(cultural_fee[0].amount);
          $("#cultural_fee").attr("max", cultural_fee[0].amount);
          $('#cultural_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > cultural_fee[0].amount
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(cultural_fee[0].amount);
            }
          });
        }

        if (development_fee.length == 0) {
          $("#development_fee").val(0);
          $("#development_fee").attr("max", 0);
          $('#development_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > 0
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(0);
            }
          });
        } else {
          $("#development_fee").val(development_fee[0].amount);
          $("#development_fee").attr("max", development_fee[0].amount);
          $('#development_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > development_fee[0].amount
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(development_fee[0].amount);
            }
          });
        }

        if (entrance_fee.length == 0) {
          $("#entrance_fee").val(0);
          $("#entrance_fee").attr("max", 0);
          $('#entrance_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > 0
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(0);
            }
          });
        } else {
          $("#entrance_fee").val(entrance_fee[0].amount);
          $("#entrance_fee").attr("max", entrance_fee[0].amount);
          $('#entrance_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > entrance_fee[0].amount
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(entrance_fee[0].amount);
            }
          });
        }

        if (guidance_fee.length == 0) {
          $("#guidance_fee").val(0);
          $("#guidance_fee").attr("max", 0);
          $('#guidance_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > 0
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(0);
            }
          });
        } else {
          $("#guidance_fee").val(guidance_fee[0].amount);
          $("#guidance_fee").attr("max", guidance_fee[0].amount);
          $('#guidance_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > guidance_fee[0].amount
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(guidance_fee[0].amount);
            }
          });
        }

        if (handbook_fee.length == 0) {
          $("#handbook_fee").val(0);
          $("#handbook_fee").attr("max", 0);
          $('#handbook_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > 0
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(0);
            }
          });
        } else {
          $("#handbook_fee").val(handbook_fee[0].amount);
          $("#handbook_fee").attr("max", handbook_fee[0].amount);
          $('#handbook_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > handbook_fee[0].amount
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(handbook_fee[0].amount);
            }
          });
        }

        if (laboratory_fee.length == 0) {
          $("#laboratory_fee").val(0);
          $("#laboratory_fee").attr("max", 0);
          $('#laboratory_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > 0
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(0);
            }
          });
        } else {
          $("#laboratory_fee").val(laboratory_fee[0].amount);
          $("#laboratory_fee").attr("max", laboratory_fee[0].amount);
          $('#laboratory_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > laboratory_fee[0].amount
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(laboratory_fee[0].amount);
            }
          });
        }

        if (library_fee.length == 0) {
          $("#library_fee").val(0);
          $("#library_fee").attr("max", 0);
          $('#library_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > 0
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(0);
            }
          });
        } else {
          $("#library_fee").val(library_fee[0].amount);
          $("#library_fee").attr("max", library_fee[0].amount);
          $('#library_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > library_fee[0].amount
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(library_fee[0].amount);
            }
          });
        }

        if (medical_dental_fee.length == 0) {
          $("#medical_dental_fee").val(0);
          $("#medical_dental_fee").attr("max", 0);
          $('#medical_dental_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > 0
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(0);
            }
          });
        } else {
          $("#medical_dental_fee").val(medical_dental_fee[0].amount);
          $("#medical_dental_fee").attr("max", medical_dental_fee[0].amount);
          $('#medical_dental_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > medical_dental_fee[0].amount
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(medical_dental_fee[0].amount);
            }
          });
        }

        if (registration_fee.length == 0) {
          $("#registration_fee").val(0);
          $("#registration_fee").attr("max", 0);
          $('#registration_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > 0
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(0);
            }
          });
        } else {
          $("#registration_fee").val(registration_fee[0].amount);
          $("#registration_fee").attr("max", registration_fee[0].amount);
          $('#registration_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > registration_fee[0].amount
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(registration_fee[0].amount);
            }
          });
        }

        if (school_id_fee.length == 0) {
          $("#school_id_fee").val(0);
          $("#school_id_fee").attr("max", 0);
          $('#school_id_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > 0
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(0);
            }
          });
        } else {
          $("#school_id_fee").val(school_id_fee[0].amount);
          $("#school_id_fee").attr("max", school_id_fee[0].amount);
          $('#school_id_fee').on('keyup keydown change', function (e) {
            if ($(this).val() > school_id_fee[0].amount
              && e.keyCode !== 46
              && e.keyCode !== 8
            ) {
              e.preventDefault();
              $(this).val(school_id_fee[0].amount);
            }
          });
        }
      }
    }
  });
}

//Update student
$(document).on('change', '#edit_course_enrolled', function (e) {
  e.preventDefault();
  let course = $("#edit_course_enrolled option:selected").text();
  $("#edit_degree_program").val($("#edit_course_enrolled option:selected").text());
  // getEditOSF();
});

// function getEditOSF() {
//   let reference_no = $("#edit_reference_no").val();
//   let course_enrolled = $("#_edit_course_enrolled option:selected").text();
//   let year_level = $("#edit_year_level").val();
//   let semester = $("#edit_semester").val();

//   $.ajax({
//     url: '/get-otherschoolfee',
//     method: 'get',
//     data: {
//       reference_no: reference_no,
//       course_enrolled: course_enrolled,
//       year_level: year_level,
//       semester: semester,
//       _token: '{{ csrf_token() }}'
//     },
//     success: function (response) {
//       var res = new Array();
//       if (response == 0 || response.length == 0) {
//         console.log('No selected year or course.');
//       } else {
//         // console.log(response);
//         $("#degree_program").val($("#course_enrolled option:selected").text());

//         var res = response.osf.reduce((acc, obj) => {
//           var existItem = acc.find(item => item.type_of_fee === obj.type_of_fee && item.coverage === obj.coverage && item.bs_status === obj.bs_status);
//           if (existItem) {
//             existItem.amount += obj.amount;
//             return acc;
//           }
//           acc.push(obj);
//           return acc;
//         }, []);

//         var other_school_fee = new Array();
//         other_school_fee = { res }
//         console.log(other_school_fee);

//         var admission_fee = other_school_fee.res.filter(function (el) {
//           return el.type_of_fee == "Admission" && el.coverage == "per new student" && el.bs_status == 1
//         }
//         );
//         var athletic_fee = other_school_fee.res.filter(function (el) {
//           return el.type_of_fee == "Athletic" && el.coverage == "per student" && el.bs_status == 1
//         }
//         );
//         var computer_fee = other_school_fee.res.filter(function (el) {
//           return el.type_of_fee == "Computer" && el.coverage == "per student" && el.bs_status == 1
//         }
//         );
//         var computer_fee_per_unit = other_school_fee.res.filter(function (el) {
//           return el.type_of_fee == "Computer" && el.coverage == "per unit" && el.bs_status == 1
//         }
//         );
//         var cultural_fee = other_school_fee.res.filter(function (el) {
//           return el.type_of_fee == "Cultural" && el.coverage == "per student" && el.bs_status == 1
//         }
//         );
//         var development_fee = other_school_fee.res.filter(function (el) {
//           return el.type_of_fee == "Development" && el.coverage == "per student" && el.bs_status == 1
//         }
//         );
//         var entrance_fee = other_school_fee.res.filter(function (el) {
//           return el.type_of_fee == "Entrance" && el.coverage == "per student" && el.bs_status == 1
//         }
//         );
//         var guidance_fee = other_school_fee.res.filter(function (el) {
//           return el.type_of_fee == "Guidance" && el.coverage == "per student" && el.bs_status == 1
//         }
//         );
//         var handbook_fee = other_school_fee.res.filter(function (el) {
//           return el.type_of_fee == "Handbook" && el.coverage == "per student" && el.bs_status == 1
//         }
//         );
//         var laboratory_fee = other_school_fee.res.filter(function (el) {
//           return el.type_of_fee == "Laboratory" && el.coverage == "per student" && el.bs_status == 1
//         }
//         );
//         var library_fee = other_school_fee.res.filter(function (el) {
//           return el.type_of_fee == "Library" && el.coverage == "per student" && el.bs_status == 1
//         }
//         );
//         var medical_dental_fee = other_school_fee.res.filter(function (el) {
//           return el.type_of_fee == "Medical and Dental" && el.coverage == "per student" && el.bs_status == 1
//         }
//         );
//         var registration_fee = other_school_fee.res.filter(function (el) {
//           return el.type_of_fee == "Registration" && el.coverage == "per student" && el.bs_status == 1
//         }
//         );
//         var school_id_fee = other_school_fee.res.filter(function (el) {
//           return el.type_of_fee == "School ID" && el.coverage == "per student" && el.bs_status == 1
//         }
//         );

//         if (admission_fee.length == 0) {
//           //set max amount
//           $("#edit_admission_fee").attr("max", 0);
//           //disable keys if maximum amount is reached
//           $('#edit_admission_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > 0
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(0);
//             }
//           });
//         } else {
//           //set max amount
//           $("#edit_admission_fee").attr("max", admission_fee[0].amount);
//           //disable keys if maximum amount is reached
//           $('#edit_admission_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > admission_fee[0].amount
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(admission_fee[0].amount);
//             }
//           });
//         }

//         if (athletic_fee.length == 0) {
//           $("#edit_athletic_fee").attr("max", 0);
//           $('#edit_athletic_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > 0
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(0);
//             }
//           });
//         } else {
//           $("#edit_athletic_fee").attr("max", athletic_fee[0].amount);
//           $('#edit_athletic_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > athletic_fee[0].amount
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(athletic_fee[0].amount);
//             }
//           });
//         }

//         if (computer_fee.length == 0) {
//           $("#edit_computer_fee").attr("max", 0);
//           $('#edit_computer_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > 0
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(0);
//             }
//           });
//         } else {
//           $("#edit_computer_fee").attr("max", computer_fee[0].amount);
//           $('#edit_computer_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > computer_fee[0].amount
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(computer_fee[0].amount);
//             }
//           });
//         }

//         if (computer_fee_per_unit.length == 0) {
//           $("#computer_fee_per_unit_div").hide(300);
//         }else{
//           $("#computer_fee_per_unit_div").show(300);
//           $(document).on('change', '#computer_fee_per_unit', function (e) {
//             var total_comp_fee = $("#computer_fee_per_unit").val() * computer_fee_per_unit[0].amount
//             $("#computer_fee_per_unit_amount").val(total_comp_fee); 
//           });
//         }

//         if (cultural_fee.length == 0) {
//           $("#edit_cultural_fee").attr("max", 0);
//           $('#edit_cultural_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > 0
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(0);
//             }
//           });
//         } else {
//           $("#edit_cultural_fee").attr("max", cultural_fee[0].amount);
//           $('#edit_cultural_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > cultural_fee[0].amount
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(cultural_fee[0].amount);
//             }
//           });
//         }

//         if (development_fee.length == 0) {
//           $("#edit_development_fee").attr("max", 0);
//           $('#edit_development_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > 0
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(0);
//             }
//           });
//         } else {
//           $("#edit_development_fee").attr("max", development_fee[0].amount);
//           $('#edit_development_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > development_fee[0].amount
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(development_fee[0].amount);
//             }
//           });
//         }

//         if (entrance_fee.length == 0) {
//           $("#edit_entrance_fee").attr("max", 0);
//           $('#edit_entrance_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > 0
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(0);
//             }
//           });
//         } else {
//           $("#edit_entrance_fee").attr("max", entrance_fee[0].amount);
//           $('#edit_entrance_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > entrance_fee[0].amount
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(entrance_fee[0].amount);
//             }
//           });
//         }

//         if (guidance_fee.length == 0) {
//           $("#edit_guidance_fee").attr("max", 0);
//           $('#edit_guidance_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > 0
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(0);
//             }
//           });
//         } else {
//           $("#edit_guidance_fee").attr("max", guidance_fee[0].amount);
//           $('#edit_guidance_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > guidance_fee[0].amount
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(guidance_fee[0].amount);
//             }
//           });
//         }

//         if (handbook_fee.length == 0) {
//           $("#edit_handbook_fee").attr("max", 0);
//           $('#edit_handbook_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > 0
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(0);
//             }
//           });
//         } else {
//           $("#edit_handbook_fee").attr("max", handbook_fee[0].amount);
//           $('#edit_handbook_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > handbook_fee[0].amount
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(handbook_fee[0].amount);
//             }
//           });
//         }

//         if (laboratory_fee.length == 0) {
//           $("#edit_laboratory_fee").attr("max", 0);
//           $('#edit_laboratory_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > 0
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(0);
//             }
//           });
//         } else {
//           $("#edit_laboratory_fee").attr("max", laboratory_fee[0].amount);
//           $('#edit_laboratory_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > laboratory_fee[0].amount
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(laboratory_fee[0].amount);
//             }
//           });
//         }

//         if (library_fee.length == 0) {
//           $("#edit_library_fee").attr("max", 0);
//           $('#edit_library_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > 0
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(0);
//             }
//           });
//         } else {
//           $("#edit_library_fee").attr("max", library_fee[0].amount);
//           $('#edit_library_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > library_fee[0].amount
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(library_fee[0].amount);
//             }
//           });
//         }

//         if (medical_dental_fee.length == 0) {
//           $("#edit_medical_dental_fee").attr("max", 0);
//           $('#edit_medical_dental_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > 0
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(0);
//             }
//           });
//         } else {
//           $("#edit_medical_dental_fee").attr("max", medical_dental_fee[0].amount);
//           $('#edit_medical_dental_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > medical_dental_fee[0].amount
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(medical_dental_fee[0].amount);
//             }
//           });
//         }

//         if (registration_fee.length == 0) {
//           $("#edit_registration_fee").attr("max", 0);
//           $('#edit_registration_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > 0
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(0);
//             }
//           });
//         } else {
//           $("#edit_registration_fee").attr("max", registration_fee[0].amount);
//           $('#edit_registration_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > registration_fee[0].amount
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(registration_fee[0].amount);
//             }
//           });
//         }

//         if (school_id_fee.length == 0) {
//           $("#edit_school_id_fee").attr("max", 0);
//           $('#edit_school_id_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > 0
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(0);
//             }
//           });
//         } else {
//           $("#edit_school_id_fee").attr("max", school_id_fee[0].amount);
//           $('#edit_school_id_fee').on('keyup keydown change', function (e) {
//             if ($(this).val() > school_id_fee[0].amount
//               && e.keyCode !== 46
//               && e.keyCode !== 8
//             ) {
//               e.preventDefault();
//               $(this).val(school_id_fee[0].amount);
//             }
//           });
//         }
//       }
//     }
//   });
// }

//If checkbox_address is checked
$(document).on('click', 'input[name=checkbox_address]', function () {
  if (this.checked) {
    $("input[name=permanent_province]").val($("input[name=present_province]").val());
    $("input[name=permanent_city]").val($("input[name=present_city]").val());
    $("input[name=permanent_barangay]").val($("input[name=present_barangay]").val());
    $("input[name=permanent_street]").val($("input[name=present_street]").val());
    $("input[name=permanent_zipcode]").val($("input[name=present_zipcode]").val());
  } else {
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
  } else {
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
  } else {
    $('.input_nstp').addClass('d-none')
  }
});

//if students is a freshmen
$(document).on('change', '#year_level', function () {
  if ($(this).val() == 1 || ($('input[name=checkbox_transferee]').checked && $(this).val() > 1)) {
    $('.input_transferee').removeClass('d-none')
  } else {
    $('.input_transferee').addClass('d-none')
  }
});

//if students is a transferee
$(document).on('click', 'input[name=checkbox_transferee]', function () {
  if ((this.checked && $('#year_level').val() == 1) || $('#year_level').val() == 1) {
    $('.input_transferee').removeClass('d-none')
  } else if ((this.checked && $('#year_level').val() > 1)) {
    $('.input_transferee').removeClass('d-none')
  } else {
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

      if (($("#edit_present_province").val() == $("#edit_permanent_province").val()) && ($("#edit_present_city").val() == $("#edit_permanent_city").val()) && ($("#edit_present_barangay").val() == $("#edit_permanent_barangay").val()) && ($("#edit_present_street").val() == $("#edit_permanent_street").val()) && ($("#edit_present_zipcode").val() == $("#edit_permanent_zipcode").val())) {
        $("#edit_checkbox_address").prop('checked', true);
      }

      if (response.transferee == "Yes") {
        $("#edit_checkbox_transferee").prop('checked', true);
      } else {
        ("#edit_checkbox_transferee").p
        rop('checked', false);
      }

      if ($("#edit_nstp_unit").val() !== "") {
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
  } else {
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
          reference_no: reference_no.value,
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
  var checkboxes = document.querySelectorAll('input[name="student_checkbox"]:checked');
  var btn = document.querySelector('#btn_edit_students');
  if (checkboxes.length > 0) {
    btn.innerHTML = '<i class="fas fa-wrench"></i>&nbsp;Edit (' + checkboxes.length + ')';
    btn.classList.remove('d-none');
  } else {
    btn.classList.add('d-none');
  }
}

//fetch records from the database
function fetchTempStudent() {
  document.getElementById("students-placeholder").classList.remove('d-none');
  document.getElementById("show_all_students").classList.add('d-none');
  let reference_no = $("#reference_no").val();
  $.ajax({
    url: "/get-tempstudents",
    method: 'get',
    data: {
      reference_no: reference_no,
      _token: '{{ csrf_token() }}'
    },
    success: function (response) {
      document.getElementById("students-placeholder").classList.add('d-none');
      document.getElementById("show_all_students").classList.remove('d-none');
      $("#show_all_students").html(response);
      //events for settings are set everytime the datatables are redrawn
      $("#tbl_students").on('order.dt', function () {
        setup_Events();
      })
        .on('search.dt', function () {
          setup_Events();
        })
        .on('page.dt', function () {
          setup_Events();
        }).DataTable({
          orderCellsTop: true,
          columnDefs: [
            { orderable: false, targets: [0, -1] },
          ]
        });
      //load events when rendering table
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
      if (response.length == 1) {
        $('.campus_div').addClass('d-none');
        $('#selected_campus').val(response[0].hei_name);
      } else {
        $('.campus_div').removeClass('d-none');
        for (let index = 0; index < response.length; ++index) {
          let campus = response[index].hei_name;
          let hei_uii = response[index].hei_uii;
          $('#hei_campus').append('<option id=' + hei_uii + ' value=' + campus + '>' + campus + '</option>');
          $('#applied_hei_campus').append('<option id=' + hei_uii + ' value=' + campus + '>' + campus + '</option>');
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