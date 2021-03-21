@auth
<!DOCTYPE html>
<html lang="en">
<head>
<x-head></x-head>
<!-- dataTable cdn -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<!-- toast cdn -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<!-- vue cdn -->
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<style>
    /* validator css */
    label.error {
    color: red;
    font-size: 1rem;
    display: block;
    margin-top: 5px;
}
input.error {
    border: 1px dashed red;
    font-size: 1em;
    color: red;
    width: 100%;
}

/* loader css */

.loader {
   width:50px;
   height:50px;
   display:inline-block;
   padding:0px;
   opacity:0.5;
   border:3px solid #09acfd;
   -webkit-animation: loader 1s ease-in-out infinite alternate;
   animation: loader 1s ease-in-out infinite alternate;
}

.loader:before {
  content: " ";
  position: absolute;
  z-index: -1;
  top: 5px;
  left: 5px;
  right: 5px;
  bottom: 5px;
  border: 3px solid #09acfd;
}

.loader:after {
  content: " ";
  position: absolute;
  z-index: -1;
  top: 15px;
  left: 15px;
  right: 15px;
  bottom: 15px;
  border: 3px solid #09acfd;
}

@keyframes loader {
   from {transform: rotate(0deg) scale(1,1);border-radius:0px;}
   to {transform: rotate(360deg) scale(0, 0);border-radius:50px;}
}
@-webkit-keyframes loader {
   from {-webkit-transform: rotate(0deg) scale(1, 1);border-radius:0px;}
   to {-webkit-transform: rotate(360deg) scale(0,0 );border-radius:50px;}
}

.loader1 {
   display:inline-block;
   font-size:0px;
   padding:0px;
}
.loader1 span {
   vertical-align:middle;
   border-radius:100%;

   display:inline-block;
   width:10px;
   height:10px;
   margin:3px 2px;
   -webkit-animation:loader1 0.8s linear infinite alternate;
   animation:loader1 0.8s linear infinite alternate;
}
.loader1 span:nth-child(1) {
   -webkit-animation-delay:-1s;
   animation-delay:-1s;
  background:rgba(245, 103, 115,0.6);
}
.loader1 span:nth-child(2) {
   -webkit-animation-delay:-0.8s;
   animation-delay:-0.8s;
  background:rgba(245, 103, 115,0.8);
}
.loader1 span:nth-child(3) {
   -webkit-animation-delay:-0.26666s;
   animation-delay:-0.26666s;
  background:rgba(245, 103, 115,1);
}
.loader1 span:nth-child(4) {
   -webkit-animation-delay:-0.8s;
   animation-delay:-0.8s;
  background:rgba(245, 103, 115,0.8);

}
.loader1 span:nth-child(5) {
   -webkit-animation-delay:-1s;
   animation-delay:-1s;
  background:rgba(245, 103, 115,0.4);
}

@keyframes loader1 {
   from {transform: scale(0, 0);}
   to {transform: scale(1, 1);}
}
@-webkit-keyframes loader1 {
   from {-webkit-transform: scale(0, 0);}
   to {-webkit-transform: scale(1, 1);}
}

.loader2 {
   width:25px;
   height:25px;
   display:inline-block;
   padding:0px;
   border-radius:100%;
   border:5px solid;
   border-top-color:rgba(254, 168, 23, 0.65);
   border-bottom-color:rgba(57, 154, 219, 0.65);
   border-left-color:rgba(188, 84, 93, 0.95);
   border-right-color:rgba(137, 188, 79, 0.95);
   -webkit-animation: loader2 2s ease-in-out infinite alternate;
   animation: loader2 2s ease-in-out infinite alternate;
}
@keyframes loader2 {
   from {transform: rotate(0deg);}
   to {transform: rotate(720deg);}
}
@-webkit-keyframes loader2 {
   from {-webkit-transform: rotate(0deg);}
   to {-webkit-transform: rotate(720deg);}
}

.loader3 {
   width:50px;
   height:50px;
   display:inline-block;
   padding:0px;
   text-align:left;
}
.loader3 span {
   position:absolute;
   display:inline-block;
   width:50px;
   height:50px;
   border-radius:100%;
   background:rgba(135, 211, 124,1);
   -webkit-animation:loader3 1.5s linear infinite;
   animation:loader3 1.5s linear infinite;
}
.loader3 span:last-child {
   animation-delay:-0.9s;
   -webkit-animation-delay:-0.9s;
}
@keyframes loader3 {
   0% {transform: scale(0, 0);opacity:0.8;}
   100% {transform: scale(1, 1);opacity:0;}
}
@-webkit-keyframes loader3 {
   0% {-webkit-transform: scale(0, 0);opacity:0.8;}
   100% {-webkit-transform: scale(1, 1);opacity:0;}
}

.loader4 {
   width:45px;
   height:45px;
   display:inline-block;
   padding:0px;
   border-radius:100%;
   border:5px solid;
   border-top-color:rgba(246, 36, 89, 1);
   border-bottom-color:rgba(255,255,255, 0.3);
   border-left-color:rgba(246, 36, 89, 1);
   border-right-color:rgba(255,255,255, 0.3);
   -webkit-animation: loader4 1s ease-in-out infinite;
   animation: loader4 1s ease-in-out infinite;
}
@keyframes loader4 {
   from {transform: rotate(0deg);}
   to {transform: rotate(360deg);}
}
@-webkit-keyframes loader4 {
   from {-webkit-transform: rotate(0deg);}
   to {-webkit-transform: rotate(360deg);}
}

.loader5 {
  display:inline-block;
  width: 0;
  height:0;
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  border-bottom: 10px solid #4183D7;
  border-top: 10px solid #F5AB35;
   -webkit-animation: loader5 1.2s ease-in-out infinite alternate;
   animation: loader5 1.2s ease-in-out infinite alternate;
}

@keyframes loader5 {
   from {transform: rotate(0deg);}
   to {transform: rotate(720deg);}
}
@-webkit-keyframes loader5 {
   from {-webkit-transform: rotate(0deg);}
   to {-webkit-transform: rotate(720deg);}
}

.loader6 {
  display:inline-block;
  width: 20px;
  height:20px;
  border-left: 2px solid transparent;
  border-right: 2px solid transparent;
  border-bottom: 2px solid #D24D57;
  border-top: 2px solid #D24D57;
  -webkit-animation: loader6 1.8s ease-in-out infinite alternate;
  animation: loader6 1.8s ease-in-out infinite alternate;
}

.loader6:before {
  content: " ";
  position: absolute;
  z-index: -1;
  top: 5px;
  left: 0px;
  right: 0px;
  bottom: 5px;
  border-left: 2px solid #D24D57;
  border-right: 2px solid #D24D57;
}

@keyframes loader6 {
   from {transform: rotate(0deg);}
   to {transform: rotate(720deg);}
}
@-webkit-keyframes loader6 {
   from {-webkit-transform: rotate(0deg);}
   to {-webkit-transform: rotate(720deg);}
}


.loader7 {
  display:inline-block;
   width: 30px;
   height: 4px;
   background:#BE90D4;
    -webkit-animation: loader7 1.5s linear infinite;
  animation: loader7 1.5s linear infinite;
}


@keyframes loader7 {
   from {transform: rotate(0deg);}
  to {transform: rotate(720deg);}
}
@-webkit-keyframes loader7 {
   from {-webkit-transform: rotate(0deg);}
  to {-webkit-transform: rotate(720deg);}
}
.loader8 {
  display:inline-block;
    background: rgba(247, 202, 24,0.6);
    width: 30px;
    height: 30px;
    position: relative;
    text-align: center;

    -webkit-transform: rotate(20deg);
       -moz-transform: rotate(20deg);
        -ms-transform: rotate(20deg);
         -o-transform: rotate(20eg);
      -webkit-animation: loader7 3s linear infinite;
  animation: loader7 3s linear infinite;
}
.loader8:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    height: 30px;
    width: 30px;
    background: rgba(247, 202, 24,0.5);
    -webkit-transform: rotate(135deg);
       -moz-transform: rotate(135deg);
        -ms-transform: rotate(135deg);
         -o-transform: rotate(135deg);
}

.loader9 {
  display:inline-block;
    position: relative;
    width: 50px;
    height: 50px;
  -webkit-animation:loader9 1.5s linear infinite;
   animation:loader9 1.5s linear infinite;
}
.loader9:before,
.loader9:after {
    position: absolute;
    content: "";
    left: 30px;
    top: 0;
    width: 30px;
    height: 50px;
    background: red;
    -moz-border-radius: 30px 30px 0 0;
    border-radius: 30px 30px 0 0;
    -webkit-transform: rotate(-45deg);
       -moz-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
         -o-transform: rotate(-45deg);
            transform: rotate(-45deg);
    -webkit-transform-origin: 0 100%;
       -moz-transform-origin: 0 100%;
        -ms-transform-origin: 0 100%;
         -o-transform-origin: 0 100%;
            transform-origin: 0 100%;
}
.loader9:after {
    left: 0;
    -webkit-transform: rotate(45deg);
       -moz-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
         -o-transform: rotate(45deg);
            transform: rotate(45deg);
    -webkit-transform-origin: 100% 100%;
       -moz-transform-origin: 100% 100%;
        -ms-transform-origin: 100% 100%;
         -o-transform-origin: 100% 100%;
            transform-origin :100% 100%;
}

@keyframes loader9 {
   0% {transform: scale(0, 0);opacity:0;}
   100% {transform: scale(1, 1);opacity:1;}
}
@-webkit-keyframes loader9 {
   0% {-webkit-transform: scale(0, 0);opacity:0;}
   100% {-webkit-transform: scale(1, 1);opacity:1;}
}

</style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
<x-side-bar></x-side-bar>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id=" content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
            <x-header> </x-header>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div id="app" class="container-fluid">
                     <!-- DataTales Example -->
                    <div class="mb-4 shadow card">
                        <div class="row justify-content-start">
                            <div class="col-md-6 col-sm-12">
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Ing: Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                @foreach( $datas as $data  )
                                                    <tr>
                                                        <td>{{ $data->ingridient_name }}</td>
                                                        <td>
                                                            <a id="{{ $data->id }}" href="#" class="btn btn-primary">edit</a>
                                                            <a href="#" class="btn btn-danger">delete</a>
                                                    </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addIngridientModel">
                                                                <i class="fa fa-plus"> Add New Ingridient</i>
                                                            </a>
                                                        </td>

                                                    </tr>

                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="sider" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Office</th>
                                                        <th>Age</th>
                                                        <th>Start date</th>
                                                        <th>Salary</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Tiger Nixon</td>
                                                        <td>System Architect</td>
                                                        <td>Edinburgh</td>
                                                        <td>61</td>
                                                        <td>2011/04/25</td>
                                                        <td>$320,800</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Garrett Winters</td>
                                                        <td>Accountant</td>
                                                        <td>Tokyo</td>
                                                        <td>63</td>
                                                        <td>2011/07/25</td>
                                                        <td>$170,750</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ashton Cox</td>
                                                        <td>Junior Technical Author</td>
                                                        <td>San Francisco</td>
                                                        <td>66</td>
                                                        <td>2009/01/12</td>
                                                        <td>$86,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Cedric Kelly</td>
                                                        <td>Senior Javascript Developer</td>
                                                        <td>Edinburgh</td>
                                                        <td>22</td>
                                                        <td>2012/03/29</td>
                                                        <td>$433,060</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Airi Satou</td>
                                                        <td>Accountant</td>
                                                        <td>Tokyo</td>
                                                        <td>33</td>
                                                        <td>2008/11/28</td>
                                                        <td>$162,700</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Donna Snider</td>
                                                        <td>Customer Support</td>
                                                        <td>New York</td>
                                                        <td>27</td>
                                                        <td>2011/01/25</td>
                                                        <td>$112,000</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Office</th>
                                                        <th>Age</th>
                                                        <th>Start date</th>
                                                        <th>Salary</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                 </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="rounded scroll-to-top" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
<x-models.log-out></x-models.log-out>
<!-- add ingrifient model -->
<x-models.add-ingridient></x-models.add-ingridient>


    <!-- Bootstrap core JavaScript-->
<x-down-script>
    <x-slot name="downard">
    <!-- Page level plugins -->

    </x-slot>
</x-down-script>
          <!-- table data javascript -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script  src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<!-- form validator start -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<!-- toaster cdn -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
         <script>
    $(document).ready(function() {
    $('#example').DataTable({
        responsive: true,
            autoWidth: true
    });
    $('#sider').DataTable({
        responsive: true,
            autoWidth: false
    });
});
         </script>

<script type="text/javascript">

</script>

<script>
    new Vue({
  el: '#app',
  data: {
    message: 'Hello Vue.js!'
  },
  created() {
	$(document).ready(function() {
        $("#addIngridientForm").validate({
rules: {
ingridient_name : {
required: true,
minlength: 3
},
},
messages : {
name: {
minlength: "kwani hujui namba zinabidi ziwe ngapi wewe"
},
email: {
email: "The email should be in the format: abc@domain.tld"
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
                            $.ajaxSetup({
                                headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                                }
                            });
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
                            var pageForm = "<div class=\"p-3\">\n" +
                                "            <form method=\"POST\" action=\"\" id=\"formThree\">\n" +
                                "                <div class=\"form-group\">\n" +
                                "                    <label for=\"ingridient_name\">Name <span></span></label>\n" +
                                "                  <input name=\"ingridient_name\" id=\"ingridient_name\" class=\"form-control\" placeholder=\"Enter email\">\n" +
                                "                </div>\n" +
                                "                <button type=\"submit\" class=\"btn btn-primary\">Submit</button>\n" +
                                "              </form>\n" +
                                "         </div> ";
                            $('#add-ing-model').html(pageForm);
                            $('#model-btn').click()
                            console.log( data.success )
                            toastr.success( data.success );
                            $('#formThree').submit( function ( event ){
                                event.preventDefault();
                                tableReload();
                            });
                        } else {
                            toastr.warning('You clicked Success toast');
                        }
                    }
                });
            }
     }

});
});
  },




  methods: {
    allJavaFunctions: function () {
            console.log('right here')
    }
  }
})
          </script>
        <script>

        </script>
    </body>
</body>

</html>

@endauth

