@include('layouts.header')

<body
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        @include('layouts.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                @include('layouts.navbar')
                <!-- end Topbar -->
                <!-- Start Content-->
                <div class="container-fluid">
                    <!-- start page title -->
                    @include('layouts.breadcrumb')
                    <div class="row">
                        @yield('content')
                    </div>
                    <!-- end page title -->

                </div>
                <!-- container -->
            </div>
            <!-- content -->
            @include('layouts.footer')
