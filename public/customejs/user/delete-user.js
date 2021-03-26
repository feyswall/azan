function deleteUser(m){
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
        url: '/Admin/user/delete/'+ m,
        data: { id:m },
        dataType: 'json',
        // statusCode: {
        //     403: function() {
        //       alert( "sorry You Dont have Access to this Page" );
        //       setTimeout(function(){ location.reload(); }, 1000);
        //     }
        //   },
        success: function ( data ){
           
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'user has been deleted',
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

var allDataCountDelete = $('#allUsers').val();
for ( var m=0; m < allDataCountDelete; m++ ){

    $('#deleteUserButton-'+m ).on( 'click', function ( event ){
          var idVal =  $( event.target ).attr('num');

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
              deleteUser( idVal )
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {

            }
          })

    });
}


