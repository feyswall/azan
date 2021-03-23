$(document).ready(function() {
    var allDataCount = $('#allData').val();
    for ( var g=0; g < allDataCount; g++ ){
        $( "#editIngridientForm-"+g ).validate({
            rules: {
                ingridient_name : {
                    required: true,
                    minlength: 3
                },
            },
            messages : {
                ingridient_name: {
                    minlength: "please make sure your name contain more than 2 characters on form-"+ g
                },
            },

            submitHandler: function(g) {
                var formInputs = $(g).serializeArray();
                var ingr = formInputs[0].value
               var inId =  formInputs[1].value
                tableReload(ingr, inId);
                function  tableReload( ingr_name, ingr_id ){
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
                            var ingridient_name = ingr_name;
                            $.ajaxSetup({
                                headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                                }
                            });
                            $.ajax({
                                type:'post',
                                beforeSend: function(){
                                    var htmlText = "<div class='row justify-content-center'><div class=\"col-sm-12 text-center\"><p>Loading ...</p><div class=\"loader1\">\n" +
                                        "    <span></span>\n" +
                                        "    <span></span>\n" +
                                        "    <span></span>\n" +
                                        "    <span></span>\n" +
                                        "    <span></span>\n" +
                                        "</div></div></div>";
                                    $('#edit-ing-model-'+inId).html(htmlText);
                                },
                                dataType : 'json',
                                url:"/ingridient/"+inId,
                                data:{
                                    inId:inId,
                                    ingridient_name: ingridient_name
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
                                        $('#model-btn').click()
                                        var pageForm = "<div class=\"p-3\">\n" +
                                            "            <form method=\"POST\" id='editIngridientForm-"+inId+"'>"+
                                            "                <div class=\"form-group\">\n" +
                                            "                    <label for=\"ingridient_name\">Name <span></span></label>\n" +
                                            "                  <input value="+ingridient_name+" name=\"ingridient_name\" id='ingridient_name-"+inId+"' class=\"form-control\" placeholder=\"Enter Ingridient\">\n" +
                                            "               <input type='hidden' value='"+inId+"' name=\"ingrId\">\n" +
                                            "                </input>\n" +
                                            "                <button type=\"submit\" class=\"btn btn-primary\">Submit</button>\n" +
                                            "              </form>\n" +
                                            "         </div> ";
                                        $('#edit-ing-model-'+inId).html(pageForm);
                                        // $('#model-btn-'+inId).click();
                                        toastr.error( data.error );
                                        $('#editIngridientForm-'+inId ).submit( function ( event ){
                                            event.preventDefault();
                                             formInputs = $('#editIngridientForm-'+inId).serializeArray();
                                             ingr = formInputs[0].value
                                             inId =  formInputs[1].value
                                            tableReload(ingr, inId);
                                        });
                                    }else if ( data.success ) {
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










































