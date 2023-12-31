@php use App\Enums\AdminType; @endphp
<div class="left-side-menu">

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="assets/images/logo.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="assets/images/logo_sm.png" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="left-side-menu-container" data-simplebar>

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<div class="left-side-menu">

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="assets/images/logo.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="assets/images/logo_sm.png" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="left-side-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="metismenu side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboards</span>
                </a>
            </li>
            @if (Auth::guard('admin')->user()->role === AdminType::QUAN_LY)
                <li class="side-nav-item">
                    <a href="{{ route('admin.employees.index') }}" class="side-nav-link">
                        <span> Quản lý nhân viên</span>
                    </a>
                    <ul class="side-nav-second-level mm-collapse mm-show" aria-expanded="false" style="">
                        <li>
                            <a href="{{ route('admin.employees.resign') }}">Nhân viên nghỉ việc</a>
                        </li>
                    </ul>
                </li>
            @endif
            <li class="side-nav-item">
                <a href="{{ route('admin.categories.index') }}" class="side-nav-link">
                    <span>Danh mục</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.services.index') }}" class="side-nav-link">
                    <span>Dịch vụ</span>
                </a>
            </li>
        </ul>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
