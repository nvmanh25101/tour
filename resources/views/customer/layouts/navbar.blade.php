<header class="header navbar-custom topnav-navbar">
    <div class="d-flex align-items-center justify-content-between">
        <div class="ms-4 me-4">
            <a class="d-block" href="{{ route('customers.home') }}">
                <img class="nav-logo" src="https://dulichviet.com.vn/images/logo.png">
            </a>
        </div>
        <nav class="d-block col-5">
            <ul class="list-unstyled mb-0 d-flex align-items-center justify-content-end nav-list">
                <li>
                    <a class="nav-link" href="{{ route('customers.blogs') }}" role="button">
                        <span>Blog</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('customers.tours') }}" role="button">
                        <span>Tour</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('cart.index') }}" role="button">
                        <span><i class="mdi mdi-heart"></i></span>
                    </a>
                </li>
                @guest('customer')
                    <li>
                        <a class="nav-link" href="{{ route('login') }}" role="button">
                            <span><i class="mdi mdi-account"></i></span>
                        </a>
                    </li>
                @else
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown"
                           id="topbar-userdrop" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="account-user-name">{{Auth::guard('customer')->user()->name  }}</span>
                        </a>
                        <div
                            class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown"
                            aria-labelledby="topbar-userdrop">
                            <!-- item-->
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>
                            <a href="{{ route('account.edit', auth()->user()) }}" class="dropdown-item notify-item">
                                <i class="mdi mdi-account-circle mr-1"></i>
                                <span>Tài khoản cá nhân</span>
                            </a>
                            <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                                <i class="mdi mdi-logout mr-1"></i>
                                <span>Đăng xuất</span>
                            </a>

                        </div>
                    </li>
                @endguest
            </ul>
        </nav>
    </div>
</header>

