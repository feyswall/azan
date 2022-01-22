@auth
<!DOCTYPE html>
<html lang="en">
<head>
<x-head></x-head>
<!-- dataTable cdn -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<!-- toast cdn -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

@yield('links')

<!-- vue cdn -->
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <!-- sweet alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('customecss/all-time.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset("customecss/loaders.css") }}">
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
                <div id="app" class="container-fluid">
                        @yield('page-content')
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
<!-- add user model -->
<x-models.add-user></x-models.add-user>
<!-- default mode -->
<x-models.loader-model></x-models.loader-model>
<!-- selling model -->
<x-models.sell></x-models.sell>

@yield('models')


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

@yield('customejs')
 <script src="{{ asset('customejs/user/add-user.js') }}"></script>
 <script src="{{ asset('customejs/product/sell.js') }}"></script>
</body>

</html>

@endauth
