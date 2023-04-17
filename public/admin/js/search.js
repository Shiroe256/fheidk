function searchBilling() {
  var acYear = document.getElementById("select_ac_year").value;
  var semester = document.getElementById("select_semester").value;
  var billingStatus = document.getElementById("select_billing_status").value;

  // Send AJAX request to the server
  $.ajax({
    url: "/admin/search",
    type: "POST",
    data: {
      ac_year: acYear,
      semester: semester,
      billing_status: billingStatus,
      _token: '{{ csrf_token() }}'
    },
    success: function (response) {
      alert(3);
      // Update the table with the retrieved data
      $('#tbl_manage_billing_list').html(response);
    }
  });
}

// function fetchTempStudent() {
//   let reference_no = $("#reference_no").val();
//   $.ajax({
//     url: "/get-tempstudents",
//     method: 'get',
//     data: {
//       reference_no: reference_no,
//       _token: '{{ csrf_token() }}'
//     },
//     success: function (response) {
//       $("#show_all_students").html(response);
//       $("#tbl_students").DataTable({
//         "order": [[3, "asc"]],
//         orderCellsTop: true,
//         fixedHeader: true,
//         columnDefs: [
//           { orderable: false, targets: [0, -1] }
//         ]
//       });
//     }
//   });
// }