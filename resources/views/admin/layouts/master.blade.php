@include('admin.layouts.header')

<body
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
<!-- Begin page -->
<div class="wrapper">
    @include('admin.layouts.sidebar')

    <div class="content-page">
        <div class="content">
            <!-- Topbar Start -->
            @include('admin.layouts.navbar')
            <!-- end Topbar -->
            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    @include('admin.layouts.errors')
                    @yield('content')
                </div>
                <!-- end page title -->

            </div>
            <!-- container -->
        </div>
        <!-- content -->
@include('admin.layouts.footer')
