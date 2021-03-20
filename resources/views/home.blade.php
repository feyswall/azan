@auth
<!DOCTYPE html>
<html lang="en">
<head>
<x-head></x-head>
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
            <x-header>

            </x-header>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h3><b>Dashboard</b></h3>

                    <!-- cards of dashboard -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="mb-4 col-xl-3 col-md-6">
                            <div class="py-2 shadow card border-left-primary h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="mr-2 col">
                                            <div class="mb-1 text-xs font-weight-bold text-primary text-uppercase">
                                                Earnings (Monthly)</div>
                                            <div class="mb-0 text-gray-800 h5 font-weight-bold">$40,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="text-gray-300 fas fa-calendar fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Annual) Card Example -->
                        <div class="mb-4 col-xl-3 col-md-6">
                            <div class="py-2 shadow card border-left-success h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="mr-2 col">
                                            <div class="mb-1 text-xs font-weight-bold text-success text-uppercase">
                                                Earnings (Annual)</div>
                                            <div class="mb-0 text-gray-800 h5 font-weight-bold">$215,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="text-gray-300 fas fa-dollar-sign fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tasks Card Example -->
                        <div class="mb-4 col-xl-3 col-md-6">
                            <div class="py-2 shadow card border-left-info h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="mr-2 col">
                                            <div class="mb-1 text-xs font-weight-bold text-info text-uppercase">Tasks
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="mb-0 mr-3 text-gray-800 h5 font-weight-bold">50%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="mr-2 progress progress-sm">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="text-gray-300 fas fa-clipboard-list fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="mb-4 col-xl-3 col-md-6">
                            <div class="py-2 shadow card border-left-warning h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="mr-2 col">
                                            <div class="mb-1 text-xs font-weight-bold text-warning text-uppercase">
                                                Pending Requests</div>
                                            <div class="mb-0 text-gray-800 h5 font-weight-bold">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="text-gray-300 fas fa-comments fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- /.container-fluid -->

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


    <!-- Bootstrap core JavaScript-->
<x-down-script></x-down-script>

</body>

</html>

@endauth
