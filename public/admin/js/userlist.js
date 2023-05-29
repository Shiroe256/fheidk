fetchuserlist();

function fetchuserlist() {
    $.ajax({
      url: "/admin/fetchuserlist",
      method: 'get',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
        $("#tbl_user_list_div").html(response);
  
        $('#search_user_region').html('<input class="form-control form-control-sm" type="text" style="font-size: 10px;" placeholder="SEARCH"/>');
  
        $('#search_user_region input').on( 'keyup change', function () {
          table
            .column(0)
            .search(this.value)
            .draw();
        });
  
        $('#search_user_hei_name').html('<input class="form-control form-control-sm" type="text" style="font-size: 10px;" placeholder="SEARCH"/>');
  
        $('#search_user_hei_name input').on( 'keyup change', function () {
          table
            .column(1)
            .search(this.value)
            .draw();
        });
  
        $('#search_user_focal_person').html('<input class="form-control form-control-sm" type="text" style="font-size: 10px;" placeholder="SEARCH"/>');
  
        $('#search_user_focal_person input').on( 'keyup change', function () {
          table
            .column(2)
            .search(this.value)
            .draw();
        });
  
        $('#search_user_contact').html('<input class="form-control form-control-sm" type="text" style="font-size: 10px;" placeholder="SEARCH"/>');
  
        $('#search_user_contact input').on( 'keyup change', function () {
          table
            .column(3)
            .search(this.value)
            .draw();
        });
  
        $('#search_user_email').html('<input class="form-control form-control-sm" type="text" style="font-size: 10px;" placeholder="SEARCH"/>');
  
        $('#search_user_email input').on( 'keyup change', function () {
          table
            .column(4)
            .search(this.value)
            .draw();
        });
  
        var table = $("#tbl_user_list").DataTable({
          "order": [[0, "asc"], [1, "asc"]],
          orderCellsTop: true,
          fixedHeader: true,
          'columnDefs': [ {
            'targets': [6], /* column index */
            'orderable': false, /* true or false */
         }]
        });
      }
    });
  }