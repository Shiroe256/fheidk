fetchBillingListAdmin();

//fetch records from the database
function fetchBillingListAdmin() {
  $.ajax({
    url: "/admin/fetchbillinglist",
    method: 'get',
    data: {
      _token: '{{ csrf_token() }}'
    },
    success: function (response) {
      $("#tbl_billing_list_admin").html(response);

      $('#search_billing_list_academic_year').html('<input class="form-control form-control-sm" type="text" style="font-size: 10px;" placeholder="SEARCH"/>');

      $('#search_billing_list_academic_year input').on( 'keyup change', function () {
        table
          .column(0)
          .search(this.value)
          .draw();
      });

      $('#search_billing_list_semester').html('<input class="form-control form-control-sm" type="text" style="font-size: 10px;" placeholder="SEARCH"/>');

      $('#search_billing_list_semester input').on( 'keyup change', function () {
        table
          .column(1)
          .search(this.value)
          .draw();
      });

      $('#search_billing_list_region').html('<input class="form-control form-control-sm" type="text" style="font-size: 10px;" placeholder="SEARCH"/>');

      $('#search_billing_list_region input').on( 'keyup change', function () {
        table
          .column(2)
          .search(this.value)
          .draw();
      });

      $('#search_billing_list_hei_name').html('<input class="form-control form-control-sm" type="text" style="font-size: 10px;" placeholder="SEARCH"/>');

      $('#search_billing_list_hei_name input').on( 'keyup change', function () {
        table
          .column(3)
          .search(this.value)
          .draw();
      });

      $('#search_billing_list_reference_no').html('<input class="form-control form-control-sm" type="text" style="font-size: 10px;" placeholder="SEARCH"/>');

      $('#search_billing_list_reference_no input').on( 'keyup change', function () {
        table
          .column(4)
          .search(this.value)
          .draw();
      });

      var table = $("#tbl_manage_billing_list").DataTable({
        "order": [[0, "des"], [1, "des"], [2, "asc"], [3, "asc"]],
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

//open billing
// open billing ajax request
$("#frm_open_billing").submit(function (e) {
  e.preventDefault();
  const fd = new FormData(this);
  $("#btn_open_billing").text('Opening...');

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: '/admin/openbilling',
    method: 'post',
    data: fd,
    cache: false,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (response) {
      // console.log(response.data);
      if (response.status == 200) {
        if (response.message) {
          Swal.fire(
            'Opened Billing!',
            'Opened Billing Successfully!<br />'+ response.message,
            'success'
          );
        } else {
          Swal.fire(
            'Opened Billing!',
            'Opened Billing Successfully!',
            'success'
          );
        }

        fetchBillingListAdmin();

        $("#btn_open_billing").text('Open');
        $("#frm_open_billing")[0].reset();
        $("#mod_open_billing").modal('hide');
      } else if (response.status == 400) {
        let i = 1;
        let errorMessage = '';
        $.each(response.errors, function (key, err_values) {
          console.log(err_values);
          errorMessage = errorMessage + '<br />' + i++ + '. ' + err_values;
        });
        Swal.fire({
          // position: 'top',
          title: 'Oops... you missed something',
          html: errorMessage,
          icon: 'warning',
        });
        $("#btn_open_billing").text('Save');
      }
    }
  });
});
//end of open billing


