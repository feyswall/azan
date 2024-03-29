$(document).ready(function() {
    var allUsersCount = $('#allUsers').val();
    for ( var g=0; g < allUsersCount; g++ ){
        currentForm = g;
        $( "#editUserForm-"+g ).validate({
            rules: {
                name : {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true,
                },
                role: {
                    required: true,
                },
            },
            messages : {
                name: {
                    minlength: "please make sure your name contain more than 2 characters on form-"+ g
                },
            },

            submitHandler: function(g) {
                var formInputs = $(g).serializeArray();
                var _token = formInputs[0].value;

                var email = $(g).find( "input[name*='email']" ).val();
                var name = $(g).find( "input[name*='name']" ).val();
                var password = $(g).find( "input[name*='password']" ).val();
                var password_confirmation = $(g).find( "input[name*='password_confirmation']" ).val();
                var userId = $(g).find( "input[name*='userId']" ).val();
                var userFormId = $(g).find( "input[name*='userFormId']" ).val();
                var role = $(g).find( "select[name*='role']" ).val();

                tableReload( name, email ,role, password, password_confirmation, userId, userFormId );
                function  tableReload( name, email, role, password, password_confirmation ){
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
                                    $('#edit-user-loader-'+userFormId).css('display', 'block');
                                    $('#edit-user-model-'+userFormId).css('display', 'none');
                                },
                                dataType : 'json',
                                url:"/admin/user/custome/"+userId,
                                data:{
                                    name:name,
                                    email: email,
                                    password: password,
                                    role: role,
                                    password_confirmation: password_confirmation
                                },
                                error: function( responce ){
                                    // converting js object to array
                                    var obj = JSON.parse( responce.responseText ).errors;
                                    Object.entries(obj).forEach(
                                        ([key, value]) => {
                                            $('#edit-user-loader-'+userFormId).css('display', 'none');
                                            $('#edit-user-model-'+userFormId).css('display', 'block');
                                            $('#edit-user-model-'+userFormId).prepend("<div class='form-group row mb-0 justify-content-center'><span class='alert alert-danger'>"+value[0]+"</span></div>");
                                        }
                                    );

                                 
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
                                            $('#edit-user-loader-'+userFormId).css('display', 'none');
                                        $('#edit-user-model-'+userFormId).css('display', 'block');
                                            // $('#model-btn-'+inId).click();
                                            toastr.error( data.error );

                                        }else if ( data.success ) {
                                            $('#edit-user-loader-'+userFormId).css('display', 'none');
                                            $("#model-user-btn-"+userFormId).click();
                                        $("#defaultModelButton").click();
                                            Swal.fire({
                                                position: 'top-end',
                                                icon: 'success',
                                                title: 'Your data has updated',
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




