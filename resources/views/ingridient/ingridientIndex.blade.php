@auth
<!DOCTYPE html>
<html lang="en">
<head>
<x-head></x-head>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<style>
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
</style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
<x-side-bar>

</x-side-bar>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
            <x-header> </x-header>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
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
                                                <tbody>
                                                    <tr>
                                                        <td>suger</td>
                                                        <td>
                                                            <a href="#" class="btn btn-primary">edit</a>
                                                            <a href="#" class="btn btn-danger">delete</a>
                                                    </td>
                                                    </tr>

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
console.log('something big is coming');
         </script>

         <script type="text/javascript">
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
            $('#addIngridientForm').ajaxForm();
     }
});
});
</script>

</body>

</html>

@endauth

