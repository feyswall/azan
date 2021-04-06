$(document).ready(function() {
    var allDataCount = $('#allData').val();
    for ( var g=0; g < allDataCount; g++ ){
        currentForm = g;
        console.log('man thats right')
        $( "#editSellForm-"+g ).validate({
            rules: {
                product : {
                    required: true,
                },
                                received_amount : {
                    required: true,
                },
                                who_buys : {
                    required: true,
                },
            },
            messages : {
                total_amount: {

                },
            },

            submitHandler: function(g) {
                var product = $(g).find( "select[name*='product']" ).val();
                var total_amount = $(g).find( "input[name*='total_amount']" ).val();
                var received_amount = $(g).find( "input[name*='received_amount']" ).val();
                var who_buys = $(g).find( "input[name*='who_buys']" ).val();
                var sellId = $(g).find( "input[name*='sellId']" ).val();
                var formId = $(g).find( "input[name*='formId']" ).val();
    console.log( who_buys+' '+received_amount+' '+who_buys+' '+product+' '+total_amount+' '+sellId+' '+formId  )
                tableReload(  received_amount, who_buys, product,total_amount, sellId, formId );
                function  tableReload(  received_amount, who_buys, product,total_amount, sellId, formId  ){
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
                        confirmButtonText: 'Yes, update it!!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajaxSetup({
                                headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                                }
                            });
                            $.ajax({
                                type:'post',
                                beforeSend: function(){
                                    $('#edit-sell-loader-'+formId).css('display', 'block');
                                    $('#edit-sell-model-'+formId).css('display', 'none');
                                },
                                dataType : 'json',
                                url:"/sales/custome/"+sellId,

                                data:{
                                    formId:formId,
                                    who_buys : who_buys,
                                    received_amount: received_amount,
                                    product: product,
                                    total_amount: total_amount,
                                    sellId: sellId,
                                    formId: formId
                                },
                                error: function( jqXHR, textStatus, errorThrown ){
                                    alert( jqXHR.responseJSON.message )
                                    setTimeout(function(){ location.reload(); }, 500);
                                },
                                success:function(data){
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
                                    if( data.error ){
                                        $('#edit-sell-model-'+formId).css('display', 'block');
                                        $('#edit-sell-loader-'+formId).css('display', 'none');
                                        // $('#model-btn-'+inId).click();
                                        toastr.error( data.error );

                                    }else if ( data.success ) {
                                        $('#edit-sell-loader-'+formId).css('display', 'none');
                                        $("#model-btn-"+formId).click();
                                      $("#defaultModelButton").click();
                                        Swal.fire({
                                            position: 'top-end',
                                            icon: 'success',
                                            title: 'Your data has saved',
                                            showConfirmButton: false,
                                            timer: 1500
                                        })

                                        setTimeout(function(){ location.reload(); }, 1000);
                                    } else {
                                        toastr.warning('Something just went wrong please Try again');
                                    }
                                }
                            });

                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {

                        }
                    })
                }
            }

        });
    }
});






































// $.ajax({
//     type:'post',
//     beforeSend: function(){
//         var htmlText = "<div class='row justify-content-center'><div class=\"col-sm-12 text-center\"><p>Loading ...</p><div class=\"loader1\">\n" +
//             "    <span></span>\n" +
//             "    <span></span>\n" +
//             "    <span></span>\n" +
//             "    <span></span>\n" +
//             "    <span></span>\n" +
//             "</div></div></div>";
//         $('#edit-ing-model-'+inId).html(htmlText);
//     },
//     dataType : 'json',
//     url:"/ingridient/"+inId,
//     data:{
//         inId:inId,
//         ingridient_name: ingridient_name
//     },
//     success:function(data){
//         toastr.options = {
//             'closeButton': true,
//             'debug': false,
//             'newestOnTop': false,
//             'progressBar': false,
//             'positionClass': 'toast-top-right',
//             'preventDuplicates': false,
//             'showDuration': '1000',
//             'hideDuration': '1000',
//             'timeOut': '5000',
//             'extendedTimeOut': '1000',
//             'showEasing': 'swing',
//             'hideEasing': 'linear',
//             'showMethod': 'fadeIn',
//             'hideMethod': 'fadeOut',
//         }
//         if( data.error ){
//             $('#model-btn').click()
//             var pageForm = "<div class=\"p-3\">\n" +
//                 "            <form method=\"POST\" id='editIngridientForm-"+inId+"'>"+
//                 "                <div class=\"form-group\">\n" +
//                 "                    <label for=\"ingridient_name\">Name <span></span></label>\n" +
//                 "                  <input value="+ingridient_name+" name=\"ingridient_name\" id='ingridient_name-"+inId+"' class=\"form-control\" placeholder=\"Enter Ingridient\">\n" +
//                 "               <input type='hidden' value='"+inId+"' name=\"ingrId\">\n" +
//                 "                </input>\n" +
//                 "                <button type=\"submit\" class=\"btn btn-primary\">Submit</button>\n" +
//                 "              </form>\n" +
//                 "         </div> ";
//             $('#edit-ing-model-'+inId).html(pageForm);
//             // $('#model-btn-'+inId).click();
//             toastr.error( data.error );
//             $('#editIngridientForm-'+inId ).submit( function ( event ){
//                 event.preventDefault();
//                 formInputs = $('#editIngridientForm-'+inId).serializeArray();
//                 ingr = formInputs[0].value
//                 inId =  formInputs[1].value
//                 tableReload(ingr, inId);
//             });
//         }else if ( data.success ) {
//             Swal.fire({
//                 position: 'top-end',
//                 icon: 'success',
//                 title: 'Your data has saved',
//                 showConfirmButton: false,
//                 timer: 1500
//             })
//             setTimeout(function(){ location.reload(); }, 1000);
//         } else {
//             toastr.warning('Something just went wrong please Try again');
//         }
//     }
// });




