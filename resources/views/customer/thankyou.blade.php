@extends('customer.layouts.master')
@section('content')
    <!-- customer login start -->
    <div class="thankyou">
        <div class="container">
            <div style="text-align: center;">
                <h2>Cảm ơn bạn đã đặt tour! </h2>
                <a href="{{ route('customers.home') }}" class="btn btn-success">Tiếp tục xem tour!!</a>
            </div>
        </div>
    </div>
    <!-- customer login end -->
@endsection
