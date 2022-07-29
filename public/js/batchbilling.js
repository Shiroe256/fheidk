document.getElementById("btn_upload_template").onclick = function () {
    uploadBatch();
}

// function validateFields(data) {
//     data.forEach(stud => {
//         var numpattern = /[0-9]/;
//         var sexpattern = /MALE|FEMALE/;
//         if(!(typeof stud['seq_no'] === 'number' && isFinite(stud['seq_no']))) return 0;
//         stud['fhe_aw_no']
//         stud['stud_no']
//         stud['lrnum']
//         if(numpattern.test(stud['given_name'])) return 0;
//         if(numpattern.test(stud['mid_name'])) return 0;
//         if(numpattern.test(stud['ext_name'])) return 0;
//         if(numpattern.test(stud['last_name'])) return 0;
//         if(sexpattern.test(stud['sex_at_birth'])) return 0;
//         stud['birthdate']
//         stud['birthplace']
//         stud['fathers_lname']
//         stud['fathers_gname']
//         stud['fathers_mname']
//         stud['mothers_lname']
//         stud['mothers_gname']
//         stud['mothers_mname']
//         stud['perm_prov']
//         stud['perm_city']
//         stud['perm_brgy']
//         stud['perm_street']
//         stud['perm_zip']
//         stud['pres_prov']
//         stud['pres_city']
//         stud['pres_brgy']
//         stud['pres_street']
//         stud['pres_zip']
//         stud['email']
//         stud['a_email']
//         stud['contact_number']
//         stud['contact_number_2']
//         stud['is_transferee']
//         stud['degree_course_id']
//         stud['year_level']
//         stud['lab_u']
//         stud['com_lab_u']
//         stud['acad_u']
//         stud['nstp_u']
//         stud['exams']
//         stud['exam_result']
//         stud['remarks']
//     });
// }

function uploadBatch() {
    var file = document.getElementById("upload_template").files;
    if (file.length < 1) {
        alert("Please select a XLSX file");
    } else {
        var reader = new FileReader();
        reader.onload = function (e) {
            var data = e.target.result;
            var workbook = XLSX.readFile(data);
            var sheet = workbook.Sheets.Billing_Form;

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
            $.ajax({
                url: window.location.origin + "/add-tempstudents",
                type: "POST",
                contentType: "json",
                processData: false,
                data: JSON.stringify(output),
                dataType: 'JSON',
                complete: function () {
                    fetchTempStudent();
                },
                beforeSend: function () {

                },
                success: function () {

                },
                error: function () {

                }
            });
        };
        reader.readAsArrayBuffer(document.getElementById("upload_template").files[0]);
    }
}