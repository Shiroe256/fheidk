fetchBillingListAdmin()

//fetch records from the database
function fetchBillingListAdmin() {
    $.ajax({
      url: "/admin/managebillinglist",
      method: 'get',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
        $("#tbl_billing_list_admin").html(response);
        $("#tbl_manage_billing_list").DataTable({
          "order": [[0, "asc"]],
          orderCellsTop: true,
          fixedHeader: true,
          columnDefs: [
            { orderable: false, targets: [0, -1] }
          ]
        });
      }
    });
  }