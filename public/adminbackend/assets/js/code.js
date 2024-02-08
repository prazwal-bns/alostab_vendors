$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");
                  Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                    }
                  }) 
    });

  });

  // Start Confirm Order
$(function () {
  $(document).on('click', '#confirm', function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
      title: 'Are you sure you want to Confirm this order?',
      text: "Once Confirmed, You will not be able to change this order?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Confirm this order !!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Order Confirmed !!',
          'Your order has been Confirmed.',
          'success'
        )
      }
    })
  });

});
// END COnfirm order


// Start Processing Order
$(function () {
  $(document).on('click', '#processing', function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
      title: 'Are you sure you want to Process this order?',
      text: "Once Processed, You will not be able to change this order?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Process this order !!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Order Processed !!',
          'Your order has been Processed.',
          'success'
        )
      }
    })
  });

});
// END Processing order


// Start Delivered Order
$(function () {
  $(document).on('click', '#delivered', function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
      title: 'Are you sure you want to Deliver this order?',
      text: "Once Processed, You will not be able to change this order?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Deliver this order !!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Order Delivered !!',
          'Your order has been Delivered.',
          'success'
        )
      }
    })
  });

});
// END Delivered order