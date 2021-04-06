function deleteSell( idVal ){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    $.ajax({
        method: 'POST',
        beforeSend: function(){
           $("#defaultModelButton").click();
        },
        url: '/sales/custome/del/'+ idVal,
        data: {
            id: idVal,
         },
        dataType: 'json',
        // statusCode: {
        //     403: function() {
        //       alert( "sorry You Dont have Access to this Page" );
        //       setTimeout(function(){ location.reload(); }, 1000);
        //     }
        //   },
        success: function ( data ){
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
            if( data.success ){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'sell has been deleted',
                    showConfirmButton: false,
                    timer: 1500
                })
                setTimeout(function(){ location.reload(); }, 1000);
            }else if(data.fail){
                toastr.error( data.fail );
            }
        },
    });

}

var allDataCountDelete = $('#allData').val();
$( document ).ready( function (){
for ( var m=0; m < allDataCountDelete; m++ ){
    $('#delSale-'+m ).on( 'click', function ( event ){
        event.preventDefault();
          const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
          })

          swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "This will un-sell the product!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                var sale_id = $(this).find( "input[name*='sale']" ).val();
                deleteSell( sale_id );
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {

            }
          })

    });
}
});
