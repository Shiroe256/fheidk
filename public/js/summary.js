fetchTempSummary();

//fetch records from the database summary of billings
function fetchTempSummary() {
    let reference_no = $("#reference_no").val();
    $.ajax({
      url: "/get-tempsummary",
      method: 'get',
      data: {
        reference_no: reference_no,
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
        $(".show_summary").html(response);
        //hide placeholder
        document.getElementById("summary_placeholder").classList.add("d-none");
        $(".tbl_summary").DataTable({
          "order": [[3, "des"]],
          orderCellsTop: true,
          fixedHeader: true,
        //   footerCallback: function (row, data, start, end, display) {
        //     var api = this.api();
  
        //     // Remove the formatting to get integer data for summation
        //     var intVal = function (i) {
        //         return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
        //     };
  
        //     // Total over all pages
        //     total = api
        //         .column(3)
        //         .data()
        //         .reduce(function (a, b) {
        //             return intVal(a) + intVal(b);
        //         }, 0);
  
        //     // Update footer
        //     $(api.column(3).footer()).html('₱' + total);
  
  
        //      // Total over all pages
        //      total2 = api
        //      .column(2)
        //      .data()
        //      .reduce(function (a, b) {
        //          return intVal(a) + intVal(b);
        //      }, 0);
  
        //  // Update footer
        //  $(api.column(2).footer()).html(total2);
        // }
        });
      }
    });
  }