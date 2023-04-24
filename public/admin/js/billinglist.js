fetchBillingListAdmin()

//fetch records from the database
function fetchBillingListAdmin() {
    $.ajax({
      url: "/admin/fetchbillinglist",
      method: 'get',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
        // const tbl_billing_list_admin = document.getElementById('tbl_billing_list_admin');
        // tbl_billing_list_admin.innerHTML(response);
        $("#tbl_billing_list_admin").html(response);
        $("#tbl_manage_billing_list").DataTable({
          "order": [[0, "asc"]],
          orderCellsTop: true,
          fixedHeader: true
        });
      }
    });
  }

  function managebillinglistsearch() {
    var acYear = document.getElementById("select_ac_year").value;
    var semester = document.getElementById("select_semester").value;
    var billingStatus = document.getElementById("select_billing_status").value;
  
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    
    // Send AJAX request to the server
    $.ajax({
      url: "/admin/managebillinglistsearch",
      type: "POST",
      data: {
        ac_year: acYear,
        semester: semester,
        billing_status: billingStatus
      },
      success: function (response) {
        // Update the table with the retrieved data
        $("#tbl_billing_list_admin").html(response);
        $("#tbl_manage_billing_list").DataTable({
          "order": [[0, "asc"]],
          orderCellsTop: true,
          fixedHeader: true
        });
      }
    });
  }

  function fetchBillingPageAdmin() {
    let id = $("#btn_view_billing_test").attr("id");
    console.log(id);
    // $.ajaxSetup({
    //   headers: {
    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //   }
    // });
    
    // Send AJAX request to the server
    // $.ajax({
    //   url: "/admin/fetchbillingpage",
    //   type: "POST",
    //   data: {
    //     id: id,
    //   },
    //   success: function (response) {
    //     // // Update the table with the retrieved data
    //     // $("#tbl_billing_list_admin").html(response);
    //     // $("#tbl_manage_billing_list").DataTable({
    //     //   "order": [[0, "asc"]],
    //     //   orderCellsTop: true,
    //     //   fixedHeader: true
    //     // });

    //   }
    // });
  }

  $(document).on('click', '#btn_view_billing_test', function (e) {
    e.preventDefault();
    let id = $(this).attr("id");
    console.log(id);
  });