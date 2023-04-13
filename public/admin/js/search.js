function searchBilling() {
    var acYear = document.getElementById("select_ac_year").value;
    var semester = document.getElementById("select_semester").value;
    var billingStatus = document.getElementById("select_billing_status").value;
    
    alert(1);
    // Send AJAX request to the server
    $.ajax({
      url: "admin/search",
      type: "POST",
      data: {
        ac_year: acYear,
        semester: semester,
        billing_status: billingStatus,
        _token: "{{ csrf_token() }}"
      },
      success: function(response) {
        alert(3);
        // Update the table with the retrieved data
        $('#tbl_manage_billing_list').html(response);
      }
    });
  }