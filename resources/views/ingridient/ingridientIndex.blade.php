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
    <!-- sweet alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
</style>
/* loader link */
 <link rel="stylesheet" type="text/css" href="{{ asset("customecss/loaders.css") }}">

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
                                        <table id="example" class="display" style="width:100%">
                                            <thead>
                                            <tr>
                                                <td>#</td>
                                                <th>ingr: Name</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach( $datas as $data )
                                            <tr>
                                                <td>{{ $data->id }}</td>
                                                <td>{{ $data->ingridient_name }}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editIngridientModel-{{ $data->id }}">Edit</a>
                                                    <a class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                   <button class="btn btn-primary" data-toggle="modal" data-target="#addIngridientModel">
                                                       <i class="fa fa-plus">Add Ingridient</i>
                                                   </button>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
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
<!-- edit model -->
    @foreach( $datas as $data )
            <div class="modal fade" id="editIngridientModel-{{$data->id}}" tabindex="-1" role="dialog"
                 aria-labelledby="editIngridientModalLabel-{{$data->id}}"
                 aria-hidden="true">
                <div id="model-dialogue" class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addIngridientModalLabel">Ready to Leave?</h5>
                            <button id="model-btn-{{ $data->id }}" class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div id="edit-ing-model-{{ $data->id }}" class="modal-body">
                            <!-- component -->
                            <div class="p-3">
                                <form id="editIngridientForm-{{ $data->id }}">
                                    <div class="form-group">
                                        <label for="ingridient_name">ingridient name<span></span></label>
                                        <input value="{{ $data->ingridient_name }}" name="ingridient_name" id="ingridient_name-{{$data->id}}" class="form-control" placeholder="Enter email">
                                    <input type="hidden" value="{{ $data->id }}" name="ingrId">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endforeach
    <input value="{{ $datas->count() }}" id="allData">


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
        var startTable = function (){
            $('#example').DataTable({
                responsive: true,
                autoWidth: true
            });
            $('#sider').DataTable({
                responsive: true,
                autoWidth: false
            });
        }
        startTable();
});
         </script>


<script src="{{ asset("customejs/ingridient/add-ingridient.js") }}"></script>
<script src="{{ asset("customejs/ingridient/edit-ingridient.js") }}"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });
            // $.ajax({
            //     method: 'POST',
            //     url: '/ingridient/ajaxIndex',
            //     data: {},
            //     dataType: 'json',
            //     success: function ( data ){
            //         var table = "";
            //         $('#inTable').html( table );
            //         $('#example').DataTable({
            //             responsive: true,
            //             autoWidth: true
            //         });
            //
            //     }
            // });
        </script>
    </body>
</html>

@endauth

