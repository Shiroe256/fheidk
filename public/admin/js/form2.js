fetchform2list();

//fetch records from the database
function fetchform2list() {
  $.ajax({
    url: "/admin/fetchform2list",
    method: 'get',
    data: {
      _token: '{{ csrf_token() }}'
    },
    success: function (response) {
      $("#tbl_form2_div").html(response);

   $("#tbl_form2").DataTable({
        "order": [2, "asc"],
        orderCellsTop: true,
        fixedHeader: true,
        'columnDefs': [ {
          'targets': [8], /* column index */
          'orderable': false, /* true or false */
       }]
      });
    }
  });
}