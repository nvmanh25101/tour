@extends('customer.layouts.master')
@section('content')
    <!-- customer login start -->
    <div class="thankyou">
        <div class="container">
            <div style="text-align: center;">
                <h2>Cảm ơn bạn đã đặt đơn hàng! Đơn hàng sẽ sớm được giao tới cho bạn! </h2>
                <a href="{{ route('customers.home') }}" class="btn btn-success">Tiếp tục mua sắm!!!</a>
            </div>
        </div>
    </div>
    <!-- customer login end -->
@endsection
