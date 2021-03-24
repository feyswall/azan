function deleteIngridient(m){
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
        url: '/ingridient/delete/'+ m,
        data: { id:m },
        dataType: 'json',
        // statusCode: {
        //     403: function() {
        //       alert( "sorry You Dont have Access to this Page" );
        //       setTimeout(function(){ location.reload(); }, 1000);
        //     }
        //   },
        success: function ( data ){
            $('#defaultModelClose').click()
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Ingridient has been deleted',
                showConfirmButton: false,
                timer: 1500
            })
            setTimeout(function(){ location.reload(); }, 1000);
        },
        error: function( jqXHR, textStatus, errorThrown ){
            alert( jqXHR.responseJSON.message )
            setTimeout(function(){ location.reload(); }, 500);
        },
    });

}
console.log('start')
var allDataCountDelete = $('#allData').val();
for ( var m=0; m < allDataCountDelete; m++ ){
console.log('new-'+m)
    $('#deleteIngridientButton-'+m ).on( 'click', function ( event ){
          var idVal =  $( event.target ).attr('num');
          console.log( idVal )


          const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
          })

          swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              deleteIngridient( idVal )
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {

            }
          })

    });
}


