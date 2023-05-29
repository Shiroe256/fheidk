fetchform2list();

// Fetch records from the database
function fetchform2list() {
    var reference_no = $("#reference_no").val(); // Get the value of reference_no from the input field
  
    $("#tbl_form2").DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "/admin/fetchform2list",
        "method": "GET",
        "data": {
          "reference_no": reference_no,
          "_token": '{{ csrf_token() }}'
        }
      },
      "columns": [
        { "data": "app_id" }, // Column for app_id
        { "data": "fhe_award_no" }, // Column for fhe_award_no
        { 
          "data": function (row) {
            // Column for concatenation of stud_lname, stud_fname, and stud_mname
            return row.stud_lname + ', ' + row.stud_fname + ' ' + row.stud_mname;
          }
        },
        { "data": "degree_program" }, // Column for degree_program
        { "data": "year_level" }, // Column for year_level
        { "data": "remarks" }, // Column for remarks
        { "data": "total_fees" }, // Column for total_fees
        { "data": "stud_status" }, // Column for stud_status
      ],
      "order": [2, "asc"],
      "orderCellsTop": true,
      "fixedHeader": true,
      "columnDefs": [{
        "targets": [8], /* column index */
        "orderable": false /* true or false */
      }]
    });
  }
  