$(document).ready(function() {
    $("#add-user-form").validate({
        rules: {
            name : {
                required: true,
                minlength: 2
            },
            email : {
                required: true,
                email: true,
            },
            password : {
                required: true,
                minlength: 4,
            },
            role : {
                required: true,
            },

        },
        messages : {
            name: {
                minlength: "please make sure the name contain more than 2 characters"
            },
        },

        submitHandler: function() {
            hereForm();
            function  hereForm(){
                var tot = false;
                var formInputs = $("#add-user-form").serializeArray();
                  var _token = formInputs[0].value;
                  var name = formInputs[1].value;
                  var email = formInputs[2].value;
                  var role = formInputs[3].value;
                  var password = formInputs[4].value;
                  var password_confirmation = formInputs[5].value;

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    }
                });

                $.ajax({
                    type:'POST',
                    beforeSend: function(){
                        $('#add-user-loader').css('display', 'block');
                        $('#add-user-model').css('display', 'none');
                        $('#regBtn').attr('disabled', true );
                    },
                    dataType : 'json',
                    url:"/Admin/users",
                    data:{
                        name: name,
                        email: email,
                        role: role,
                        password: password,
                        password_confirmation: password_confirmation,
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
                            toastr.error( data.error[0] );
                            $('#add-user-loader').css('display', 'none');
                            $('#add-user-model').css('display', 'block');
                            $('#regBtn').attr('disabled', false );

                        }else if ( data.success ) {
                            $("#addUserModelClose").click();
                             $("#defaultModelButton").click();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Your data has added',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(function(){ location.reload(); }, 1000);
                        } else {
                            toastr.warning('Something just went wrong please Try again');
                        }




                    },
                });
            }
        }

    });
});
