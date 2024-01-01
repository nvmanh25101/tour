@php use App\Enums\AdminType; @endphp
<div class="navbar-custom">
    <ul class="list-unstyled topbar-right-menu float-right mb-0">
        <li class="dropdown notification-list d-lg-none">
            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-search noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                <form class="p-3">
                    <input type="text" class="form-control" placeholder="Search ..."
                           aria-label="Recipient's username">
                </form>
            </div>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-bell noti-icon"></i>
                <span class="noti-icon-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg">

                <!-- item-->
                <div class="dropdown-item noti-title">
                    <h5 class="m-0">
                        <span class="float-right">
                             <a href="javascript: void(0);" class="text-dark">
                                <small>Clear All</small>
                             </a>
                        </span>Notification
                    </h5>
                </div>

                <div style="max-height: 230px;" data-simplebar>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-primary">
                            <i class="mdi mdi-comment-account-outline"></i>
                        </div>
                        <p class="notify-details">Caleb Flakelar commented on Admin
                            <small class="text-muted">1 min ago</small>
                        </p>
                    </a>
                </div>

                <!-- All-->
                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                    View All
                </a>
            </div>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" href="#"
               role="button" aria-haspopup="false" aria-expanded="false">
                <span>
                    <span class="account-user-name">{{ Auth::guard('admin')->user()->name }}</span>
                    <span
                        class="account-position">{{ AdminType::getKeyByValue(Auth::guard('admin')->user()->role) }}</span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Xin chào !</h6>
                </div>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle mr-1"></i>
                    <span>Tài khoản</span>
                </a>

                <!-- item-->
                <a href="{{ route("admin.logout") }}" class="dropdown-item notify-item">
                    <i class="mdi mdi-logout mr-1"></i>
                    <span>Đăng xuất</span>
                </a>

            </div>
        </li>
    </ul>
    <button class="button-menu-mobile open-left disable-btn">
        <i class="mdi mdi-menu"></i>
    </button>
    
</div>
