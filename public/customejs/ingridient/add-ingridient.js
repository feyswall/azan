$(document).ready(function() {
    $("#addIngridientForm").validate({
        rules: {
            ingridient_name : {
                required: true,
                minlength: 2
            },
        },
        messages : {
            ingridient_name: {
                minlength: "please make sure your name contain more than 2 characters"
            },
        },

        submitHandler: function() {
            tableReload();
            function  tableReload(){
                var ingridient_name = $('#ingridient_name').val();
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    }
                });
                $.ajax({
                    type:'POST',
                    beforeSend: function(){
                        var htmlText = "<div class='row justify-content-center'><div class=\"col-sm-12 text-center\"><p>Loading ...</p><div class=\"loader1\">\n" +
                            "    <span></span>\n" +
                            "    <span></span>\n" +
                            "    <span></span>\n" +
                            "    <span></span>\n" +
                            "    <span></span>\n" +
                            "</div></div></div>";
                        $('#add-ing-model').html(htmlText);
                    },
                    dataType : 'json',
                    url:"/ingridient",
                    data:{ ingridient_name:ingridient_name },
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
                            $('#model-btn').click()
                            var pageForm = "<div class=\"p-3\">\n" +
                                "            <form method=\"POST\" id=\"formTwo\">\n" +
                                "                <div class=\"form-group\">\n" +
                                "                    <label for=\"ingridient_name\">Name <span></span></label>\n" +
                                "                  <input name=\"ingridient_name\" id=\"ingridient_name\" class=\"form-control\" placeholder=\"Enter email\">\n" +
                                "                </div>\n" +
                                "                <button type=\"submit\" class=\"btn btn-primary\">Submit</button>\n" +
                                "              </form>\n" +
                                "         </div> ";
                            $('#add-ing-model').html(pageForm);
                            $('#model-btn').click();
                            toastr.error( data.error[0] );
                            $('#formTwo').submit( function ( event ){
                                event.preventDefault();
                                tableReload();
                            });
                        }else if ( data.success ) {
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
                    }
                });
            }
        }

    });
});
