const fileInput = document.getElementById('upload_template');
const uploadButton = document.getElementById('btn_upload_template');
const closeButton = document.getElementById("closebutton");
const queueButton = document.getElementById("btn_queue");
const templateButton = document.getElementById("btn_download_template");
const reference_no = $('#reference_no').val();
const ac_year = $('#ac_year').val();
const semester = $('#semester').val();
const tranche = $('#tranche').val();
var templateReq = new XMLHttpRequest();
var templateData = new XMLHttpRequest();
var heiinfo;


/* set up async GET request */

templateReq.onload = function (e) {
    var workbook = XLSX.read(templateReq.response);
    var worksheet = workbook.Sheets[workbook.SheetNames[0]];
    var worksheet_courses = workbook.Sheets[workbook.SheetNames[1]];
    var courses = [];
    heiinfo.courses.forEach(course => {
        courses.push([course]);
    });
    console.log(heiinfo.courses);
    console.log(courses);
    XLSX.utils.sheet_add_aoa(worksheet, [[heiinfo.hei_psg_region], [heiinfo.hei_uii], [heiinfo.hei_name], [reference_no]], { origin: "B1" });
    XLSX.utils.sheet_add_aoa(worksheet_courses, [["asdasd"],['asdasd']], { origin: "A1" });
    XLSX.writeFileXLSX(workbook, reference_no + ".xlsx");
};

templateData.onload = function (e) {
    heiinfo = JSON.parse(this.responseText);
    templateReq.open("GET", window.location.origin + "/files/template.xlsx", true);
    templateReq.responseType = "arraybuffer";
    templateReq.send();


};

templateButton.onclick = function () {
    templateData.open("POST", window.location.origin + "/fetchTemplateData", true);
    templateData.setRequestHeader("X-Requested-With", 'XMLHttpRequest');
    // templateData.setRequestHeader("Content-type", 'multipart/form-data'); // or application/json
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
                html: 'Please check the name of your Sheet'
            });
        } else {
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
            reference_no: reference_no
        },
        success: function (data) {
            window.location.href = "/billings?queued=" + reference_no;
        },
    });
}
function resetUploadButton() {
    uploadButton.innerHTML = 'Upload';
    uploadButton.disabled = false;
    closeButton.disabled = false;
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
                        reference_no: reference_no,
                        ac_year: ac_year,
                        semester: semester,
                        tranche: tranche
                    },
                    complete: function () {
                        fileInput.value = '';
                        resetUploadButton();
                        closeButton.click();
                        fetchTempStudent();
                        fetchTempSummary();
                        fetchTempApplicants();
                        document.getElementById('upload_template_text').innerHTML = selectedFile.name;
                    },
                    beforeSend: function () {
                        uploadButton.disabled = true;
                        closeButton.disabled = true;
                        fileInput.disabled = true;
                        uploadButton.innerHTML = 'Uploading...';
                    },
                    success: function () {
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