<div class="navbar-custom topnav-navbar d-flex align-items-center justify-content-center">
    <ul class="list-unstyled mb-0 d-flex">
        <li class="">
            <a class="nav-link mr-0" href="{{ route('customers.services') }}" role="button">
                <span>Dịch vụ</span>
            </a>
        </li>
        <li class="">
            <a class="nav-link mr-0" href="#" role="button">
                <span>
{{--                    {{ Auth::guard('admin')->user()->name }}--}}
                    <span class="account-user-name"></span>
                    <span
                        class="account-position">Khách hàng</span>
                </span>
            </a>
        </li>
    </ul>
    <div class="">
        <a class="d-block">
            <img class="nav-logo" src="{{ asset('storage/logo.png') }}">
        </a>
    </div>
    <ul class="list-unstyled mb-0 d-flex align-items-center justify-content-center">
        <li class="">
            <a class="nav-link mr-0" href="#" role="button">
                <span>AC</span>
            </a>

        </li>
        <li class="">
            <a class="nav-link mr-0" href="#" role="button">
                <span>
{{--                    {{ Auth::guard('admin')->user()->name }}--}}
                    <span class="account-user-name"></span>
                    <span
                        class="account-position">Khách hàng</span>
                </span>
            </a>
        </li>
    </ul>
</div>
