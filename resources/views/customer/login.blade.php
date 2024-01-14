@extends('customer.layouts.master')
@push('css')
    <link href="{{ asset('css/customer/signup.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('carousel')
    <div class="text-center text-white d-flex align-items-center position-relative page-header"
         style="background-image: url(https://laspas.vn/ma-may/wp-content/uploads/sites/5/2018/09/banner_demo.jpg);">
        <div class="m-auto">
            <h1 class="font-family-secondary h2 text-uppercase text-center mt-2 mb-3 page-title">
                Đăng nhập
            </h1>
        </div>
    </div>
@endsection
@section('content')
    <div class="col-lg-5 mt-4">
        <div class="card">

            <div class="card-body p-4">

                <div class="text-center w-75 m-auto">
                    <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Đăng nhập</h4>
                    <p class="text-muted mb-4">Nhập địa chỉ email và mật khẩu của bạn để truy cập.</p>
                </div>

                <form action="{{ route('processLogin') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="emailaddress">Email</label>
                        <input class="form-control" type="email" id="emailaddress" required name="email"
                               placeholder="Nhập email">
                    </div>

                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password"
                                   placeholder="Nhập mật khẩu">
                            <div class="input-group-append" data-password="false">
                                <div class="input-group-text">
                                    <span class="password-eye"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary" type="submit">Đăng nhập</button>
                    </div>

                </form>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 text-center">
                <p class="text-muted">Bạn chưa có tài khoản? <a href="{{ route('register') }}" class="text-muted ml-1">
                        <b>Đăng ký</b>
                    </a>
                </p>
            </div>
        </div>

    </div>
@endsection
