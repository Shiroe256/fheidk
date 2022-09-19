fetchTempExceptions();

//fetch records from the database
function fetchTempExceptions() {
  let reference_no = $("#reference_no").val();
  $.ajax({
    url: "/get-tempexceptions",
    method: 'get',
    data: {
      reference_no: reference_no,
      _token: '{{ csrf_token() }}'
    },
    success: function (response) {
      $("#show_all_exceptions").html(response);
      $("#tbl_exception_report").DataTable({
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