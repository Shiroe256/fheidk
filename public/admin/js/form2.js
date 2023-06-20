fetchform2list();

//fetch records from the database
function fetchform2list() {
    var reference_no = $("#reference_no").val();
    var loadingIndicator = $("#loading_indicator"); // Element for displaying the loading indicator

  // Display the loading indicator
  loadingIndicator.show();
    $.ajax({
        url: "/admin/fetchform2list",
        method: 'get',
        data: {
            reference_no: reference_no,
            _token: '{{ csrf_token() }}'
        },
        success: function (response) {
            $("#tbl_form2_div").html(response);

            $("#tbl_form2").DataTable({
                "order": [1, "asc"],
                orderCellsTop: true,
                fixedHeader: true,
                'columnDefs': [{
                    'targets': [7], /* column index */
                    'orderable': false, /* true or false */
                }]
            });
        }
    });
}