@extends('customer.layouts.master')
@push('css')
    <link href="{{ asset('css/customer/signup.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('carousel')
    <div class="text-center text-white d-flex align-items-center position-relative page-header"
         style="background-image: url(https://laspas.vn/ma-may/wp-content/uploads/sites/5/2018/09/banner_demo.jpg);">
        <div class="m-auto">
            <h1 class="font-family-secondary h2 text-uppercase text-center mt-2 mb-3 page-title">
                Đăng ký
            </h1>
        </div>
    </div>
@endsection
@section('content')
    <div class="col-lg-5 mt-4">
        <div class="card">
            <div class="card-body p-4">
                <div class="text-center w-75 m-auto">
                    <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Đăng ký</h4>
                    <p class="text-muted mb-4">Bạn chưa có tài khoản? Tạo tài khoản của bạn, chỉ mất ít hơn một phút</p>
                </div>
                <form action="{{ route('register') }}" class="needs-validation" novalidate method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="fullname">Họ và tên</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Nhập họ và tên"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="emailaddress">Email</label>
                        <input class="form-control" type="email" id="emailaddress" name="email"
                               placeholder="Nhập email">
                    </div>

                    <div class="form-group">
                        <label for="emailaddress">Số điện thoại</label>
                        <input class="form-control" type="text" id="phone" name="phone" required
                               placeholder="Nhập số điện thoại">
                    </div>

                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" name="password" class="form-control"
                                   placeholder="Nhập mật khẩu" required>
                            <div class="input-group-append" data-password="false">
                                <div class="input-group-text">
                                    <span class="password-eye"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary" type="submit">Đăng ký</button>
                    </div>

                </form>
            </div>

            <div class="row mt-3">
                <div class="col-12 text-center">
                    <p class="text-muted">Bạn đã có tài khoản?<a href="" class="text-muted ml-1"><b>Đăng nhập</b></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
