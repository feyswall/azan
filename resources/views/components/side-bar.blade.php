<div>
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
            </div>
            <div class="mx-3 sidebar-brand-text">Azan Admin <sup>2</sup></div>
        </a>

        <!-- Divider -->
        <hr class="my-0 sidebar-divider">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-columns"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            App Center
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        @can('edit-ingr')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-align-left"></i>
                <span>Ingridients</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="py-2 bg-white rounded collapse-inner">
                    <h6 class="collapse-header">Customize your ingridents:</h6>
                    <a class="collapse-item" href="{{ route('ingridient.index') }}">Manage</a>
                </div>
            </div>
        </li>
        @endcan

        <!-- Nav Item - Utilities Collapse Menu -->
        @can('manage-product')
    @if( App\Ingridient::all()->count() > 0 )
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-clipboard-check"></i>
                <span>product</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="py-2 bg-white rounded collapse-inner">
                    {{-- <h6 class="collapse-header">Custom Utilities:</h6> --}}
                    <a class="collapse-item" href="{{ route('product.index') }}">Backery</a>
                </div>
            </div>
        </li>        
    @endif

        @endcan



         <!-- Nav Item - Utilities Collapse Menu -->
@if( App\Product::all()->count() > 0 && App\Stock::all()->count() > 0 )
         <li class="nav-item">
            <a id="sideSale" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSales"
                aria-expanded="true" aria-controls="collapseSales">
                <i class="fas fa-money-bill-wave"></i>
                <span>Sales</span>
               
            </a>
            <div id="collapseSales" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="py-2 bg-white rounded collapse-inner">
                    {{-- <h6 class="collapse-header">Custom Utilities:</h6> --}}
                    @can('product_exist')
                    <a class="collapse-item" id="selltModelButton" type="button" data-toggle="modal" data-target="#sellModel" >Sell Now</a>
                    @endcan
                    <a class="collapse-item" id="" href="{{ route('sales.index') }}" type="button" >All Sales</a>
                     @can('manage-sale')
                    <a class="collapse-item" id="" href="{{ route('sales.deleted') }}" type="button" >deleted sales</a>
                    @endcan
                </div>
            </div>
        </li>
@endif


    @if( App\Product::all()->count() > 0 )
        <li class="nav-item">
            <a id="sideStoke" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStoke"
                aria-expanded="true" aria-controls="collapseStoke">
                <i class="fas fa-toolbox"></i>
                <span>Stock</span>
            </a>
            <div id="collapseStoke" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="py-2 bg-white rounded collapse-inner">
 @can('manage-product')
                    <a class="collapse-item" id="" href="{{ route('stock.create') }}" type="button" >Add To Stock</a>
                    @endcan
                    <a class="collapse-item" id="" href="{{ route('stock.index') }}" type="button" >All in Stock</a>
                    <a class="collapse-item" id="" href="{{ route('damaged.create') }}" type="button" >Damaged Goods</a>
                </div>

            </div>
        </li>
@endif        

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            extra
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        {{-- <li class="nav-item active">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
                aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Pages</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
                data-parent="#accordionSidebar">
                <div class="py-2 bg-white rounded collapse-inner">
                    <h6 class="collapse-header">Login Screens:</h6>
                    <a class="collapse-item" href="login.html">Login</a>
                    <a class="collapse-item" href="register.html">Register</a>
                    <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Other Pages:</h6>
                    <a class="collapse-item" href="404.html">404 Page</a>
                    <a class="collapse-item" href="blank.html">Blank Page</a>
                </div>
            </div>
        </li> --}}

        <!-- Nav Item - Charts -->
        {{-- <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Charts</span></a>
        </li> --}}

        <!-- Nav Item - Tables -->
        @can('edit-user')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="fas fa-users"></i>
                <span>Manage Users</span></a>
        </li>
        @endcan

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="border-0 rounded-circle" id="sidebarToggle"></button>
        </div>

    </ul>
</div>
