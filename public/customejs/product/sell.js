$(document).ready(function() {
    $("#sell-product-form").validate();

    });

   $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    }
                });


$("#sell-product-form").submit( function(e){
    e.preventDefault();
      let sell_form = $("#sell-product-form");
        let total_amount = $( sell_form ).find("input[name='total_amount']").val()
         let received_amount = $( sell_form ).find("input[name='received_amount']").val()
          let product = $( sell_form ).find("select[name='product']").val()
          let who_buys = $( sell_form ).find("input[name='who_buys']").val()

        $.ajax({
            url: '/sales',
            method: 'POST',
            beforeSend: function(){
                $("#sellModelClose").click();
                $("#defaultModelButton").click();
            },
            data:{
                total_amount: total_amount,
                received_amount: received_amount,
                product: product,
                who_buys: who_buys,
            },
            dataType: 'json',
            success: function( data ){
                    if( data.success ){
                        $("#defaultModelClose").click();
                        $('#sideSale').click();
                        toastr.options = {
                            'closeButton': true,
                            'debug': false,
                            'newestOnTop': false,
                            'progressBar': false,
                            'positionClass': 'toast-top-right',
                            'preventDuplicates': false,
                            'showDuration': '1000',
                            'hideDuration': '1000',
                            'timeOut': '5000',
                            'extendedTimeOut': '1000',
                            'showEasing': 'swing',
                            'hideEasing': 'linear',
                            'showMethod': 'fadeIn',
                            'hideMethod': 'fadeOut',
                        }











const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Sold',
  text: "do you want to see sales",
  icon: 'success',
  showCancelButton: true,
  confirmButtonText: 'view in table',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    location.href = '/sales';
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel

  ) {
    setTimeout(function(){ location.reload(); }, 500);
  }
})













                    }else if ( data.error ) {
                        $("#defaultModelClose").click();
                        toastr.error( data.error );
                    } else {
                        $("#defaultModelClose").click();
                        toastr.warning( 'undetected error' );
                    }
            },
        });
});
