//Process Order
$(document).on('click', '#btn_forward_to_afms', function () {
    let id = $("#reference_no").val();
  alert(id);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to access this while being reviewed by the CHED-AFMS.",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, forward to CHED-AFMS'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '/admin/forwardtoafms',
          method: 'post',
          data: {
            reference_no : id
          },
          success: function (response) {
            Swal.fire(
              'Forwarded!',
              'This billing is now being reviewed by the CHED-AFMS, please wait for the update.',
              'success'
            ).then(() => {
                window.location.href = '/admin/managebillinglist'; // Redirect to the order page
            });
          }
        });
      }
    })
  });