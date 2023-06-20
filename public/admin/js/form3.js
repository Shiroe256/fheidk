fetchform3list();

//fetch records from the database
function fetchform3list() {
    var reference_no = $("#reference_no").val();
    var loadingIndicator = $("#loading_indicator"); // Element for displaying the loading indicator

  // Display the loading indicator
  loadingIndicator.show();
    $.ajax({
        url: "/admin/fetchform3list",
        method: 'get',
        data: {
            reference_no: reference_no,
            _token: '{{ csrf_token() }}'
        },
        success: function (response) {
            $("#tbl_form3_div").html(response);

            $("#tbl_form3").DataTable({
                "order": [1, "asc"],
                orderCellsTop: true,
                fixedHeader: true,
                'columnDefs': [{
                    'targets': [8], /* column index */
                    'orderable': false, /* true or false */
                }]
            });
        }
    });
}