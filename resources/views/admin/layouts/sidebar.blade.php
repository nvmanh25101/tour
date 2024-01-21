@php use App\Enums\AdminType; @endphp
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion left-side-menu" id="accordionSidebar">

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
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
        <li class="side-nav-item">
            <a href="{{ route('admin.vouchers.index') }}" class="side-nav-link">
                <span>Voucher</span>
            </a>
        </li>
    @endif
    <li class="side-nav-item">
        <a href="{{ route('admin.orders.index') }}" class="side-nav-link">
            <span>Đơn hàng</span>
        </a>
    </li>
    <li class="side-nav-item">
        <a href="{{ route('admin.appointments.index') }}" class="side-nav-link">
            <span>Lịch đặt</span>
        </a>
    </li>
    <li class="side-nav-item">
        <a href="{{ route('admin.blogs.index') }}" class="side-nav-link">
            <span>Blog</span>
        </a>
    </li>
    <li class="side-nav-item">
        <a href="{{ route('admin.products.index') }}" class="side-nav-link">
            <span>Sản phẩm</span>
        </a>
    </li>
    <li class="side-nav-item">
        <a href="{{ route('admin.services.index') }}" class="side-nav-link">
            <span>Dịch vụ</span>
        </a>
    </li>
    <li class="side-nav-item">
        <a href="{{ route('admin.categories.index') }}" class="side-nav-link">
            <span>Danh mục</span>
        </a>
    </li>
</ul>
