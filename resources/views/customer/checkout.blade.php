@php use App\Enums\OrderPaymentEnum;use App\Enums\VoucherTypeEnum; @endphp
@extends('customer.layouts.master')
@push('css')
    {{--    <link rel="stylesheet" href="{{ asset('css/customer/cart.css') }}">--}}
@endpush
@section('carousel')
    <div class="text-center text-white d-flex align-items-center position-relative page-header"
         style="background-image: url(https://laspas.vn/ma-may/wp-content/uploads/sites/5/2018/08/slide-1.jpg);">
        <div class="m-auto">
            <h1 class="font-family-secondary h2 text-uppercase text-center mt-2 mb-3 page-title">
                Thanh toán đơn hàng
            </h1>
        </div>
    </div>
@endsection
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Checkout Steps -->
                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                    <li class="nav-item">
                        <a href="#payment-information" data-toggle="tab" aria-expanded="false"
                           class="nav-link rounded-0 active">
                            <i class="mdi mdi-cash-multiple font-18"></i>
                            <span class="d-none d-lg-block">Thông tin thanh toán</span>
                        </a>
                    </li>
                </ul>

                <!-- Steps Information -->
                <div class="tab-content">

                    <!-- Payment Content-->
                    <div class="tab-pane active" id="payment-information">
                        <div class="row">
                            <form action="{{ route('orders.update', $order) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="col-lg-8">
                                    <h4 class="mt-2">Thanh toán</h4>

                                    <p class="text-muted mb-4">Chọn phương thức thanh toán.</p>

                                    <!-- Pay with Paypal box-->
                                    <div class="border p-3 mb-3 rounded">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="BillingOptRadio2" name="payment_method"
                                                           value="{{ OrderPaymentEnum::CHUYEN_KHOAN }}"
                                                           class="custom-control-input">
                                                    <label class="custom-control-label font-16 font-weight-bold"
                                                           for="BillingOptRadio2">Vnpay</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                                                <img src="https://vnpay.vn/assets/images/logo-icon/logo-primary.svg"
                                                     height="25"
                                                     alt="paypal-img">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end Pay with Paypal box-->

                                    <!-- Cash on Delivery box-->
                                    <div class="border p-3 mb-3 rounded">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="BillingOptRadio4" name="payment_method"
                                                           value="{{ OrderPaymentEnum::TIEN_MAT }}"
                                                           class="custom-control-input">
                                                    <label class="custom-control-label font-16 font-weight-bold"
                                                           for="BillingOptRadio4">Thanh toán khi giao hàng</label>
                                                </div>
                                                <p class="mb-0 pl-3 pt-1">Thanh toán bằng tiền mặt khi đơn hàng của bạn
                                                    được giao.</p>
                                            </div>
                                            <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                                                <img src="{{ asset('storage/cod.png') }}" height="22" alt="paypal-img">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end Cash on Delivery box-->

                                    <div class="row mt-4">
                                        <div class="col-sm-6">
                                            <a href="{{ route('cart.index') }}"
                                               class="btn text-muted d-none d-sm-inline-block btn-link font-weight-semibold">
                                                <i class="mdi mdi-arrow-left"></i> Quay trở lại giỏ hàng </a>
                                        </div> <!-- end col -->
                                        <div class="col-sm-6">
                                            <div class="text-sm-right">
                                                <button class="btn btn-danger" type="submit">
                                                    <i class="mdi mdi-cash-multiple mr-1"></i> Hoàn thành
                                                </button>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->

                                </div>
                            </form>
                            <!-- end col -->

                            <div class="col-lg-4">
                                <div class="border p-3 mt-4 mt-lg-0 rounded">
                                    <h4 class="header-title mb-3">Order Summary</h4>

                                    <div class="table-responsive">
                                        <table class="table table-centered mb-0">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <img src="assets/images/products/product-1.jpg"
                                                         alt="contact-img"
                                                         title="contact-img" class="rounded mr-2" height="48">
                                                    <p class="m-0 d-inline-block align-middle">
                                                        <a href="apps-ecommerce-products-details.html"
                                                           class="text-body font-weight-semibold">Amazing Modern
                                                            Chair</a>
                                                        <br>
                                                        <small>5 x $148.66</small>
                                                    </p>
                                                </td>
                                                <td class="text-right">
                                                    $743.30
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="assets/images/products/product-2.jpg"
                                                         alt="contact-img"
                                                         title="contact-img" class="rounded mr-2" height="48">
                                                    <p class="m-0 d-inline-block align-middle">
                                                        <a href="apps-ecommerce-products-details.html"
                                                           class="text-body font-weight-semibold">Designer Awesome
                                                            Chair</a>
                                                        <br>
                                                        <small>2 x $99.00</small>
                                                    </p>
                                                </td>
                                                <td class="text-right">
                                                    $198.00
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="assets/images/products/product-3.jpg"
                                                         alt="contact-img"
                                                         title="contact-img" class="rounded mr-2" height="48">
                                                    <p class="m-0 d-inline-block align-middle">
                                                        <a href="apps-ecommerce-products-details.html"
                                                           class="text-body font-weight-semibold">Biblio Plastic
                                                            Armchair</a>
                                                        <br>
                                                        <small>1 x $129.99</small>
                                                    </p>
                                                </td>
                                                <td class="text-right">
                                                    $129.99
                                                </td>
                                            </tr>
                                            <tr class="text-right">
                                                <td>
                                                    <h6 class="m-0">Sub Total:</h6>
                                                </td>
                                                <td class="text-right">
                                                    $1071.29
                                                </td>
                                            </tr>
                                            <tr class="text-right">
                                                <td>
                                                    <h6 class="m-0">Shipping:</h6>
                                                </td>
                                                <td class="text-right">
                                                    FREE
                                                </td>
                                            </tr>
                                            <tr class="text-right">
                                                <td>
                                                    <h5 class="m-0">Total:</h5>
                                                </td>
                                                <td class="text-right font-weight-semibold">
                                                    $1071.29
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end table-responsive -->
                                </div> <!-- end .border-->

                            </div> <!-- end col -->
                        </div> <!-- end row-->
                    </div>
                    <!-- End Payment Information Content-->

                </div> <!-- end tab content-->

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>\
    <script>
        $(document).ready(function () {
            let voucher_element = $('#voucher');
            let discount_price_element = $('#discount_price');
            let alert_element = $('.alert-warning');
            let sub_price_element = $('#subPrice');
            let total_price_element = $('#totalPrice');

            updateTotalPrice();

            function updateTotalPrice() {
                let total = 0;

                $(".product").each(function () {
                    let price = parseFloat($(this).find(".price").text().replace(/[^\d]/g, ''));
                    total += price;
                });
                let formattedPrice = total.toLocaleString('vi-VN', {style: 'currency', currency: 'VND'});
                sub_price_element.text(formattedPrice);
                total_price_element.text(formattedPrice);
            }

            voucher_element.on('change', function () {
                let price = sub_price_element.text();
                let price_value = parseFloat(price.replace(/[^\d]/g, ''));
                let price_format = price_value.toLocaleString('vi-VN', {style: 'currency', currency: 'VND'});

                if ($(this).val() === '-1') {
                    total_price_element.text(price_format);
                    discount_price_element.text('');
                    return;
                }
                let voucher_type = $(this).children("option:selected").data('type');
                let voucher_value = $(this).children("option:selected").data('value');
                let min_spend = $(this).children("option:selected").data('min-spend');
                let max_spend = $(this).children("option:selected").data('max-spend');
                let min_spend_value = parseFloat(min_spend.replace(/[^\d.-]/g, ''));
                let min_spend_format = min_spend_value.toLocaleString('vi-VN', {style: 'currency', currency: 'VND'})

                if (min_spend > price_value) {
                    total_price_element.text(price_format);
                    alert_element.text('Voucher này chỉ áp dụng cho đơn hàng từ ' + min_spend_format + ' trở lên');
                    return;
                } else {
                    alert_element.text('Sử dụng voucher để giảm giá !');
                }

                let total_price = total_price_element.text();
                let total_price_value = parseFloat(total_price.replace(/[^\d]/g, ''));
                isNaN(total_price_value) ? total_price_value = 0 : total_price_value;
                let total_price_after_discount = 0;
                let discount = 0;
                if (voucher_type === {{ VoucherTypeEnum::PHAN_TRAM }}) {
                    discount = total_price_value * voucher_value / 100;
                    if (discount > max_spend) {
                        discount = max_spend;
                        $('#max_discount').text('Tối đa: ' + max_spend + ' đ');

                    }
                    total_price_after_discount = total_price_value - discount;
                    discount_price_element.text(discount + ' đ');
                } else {
                    total_price_after_discount = total_price_value - voucher_value;
                    discount_price_element.text(voucher_value + ' đ');
                }
                let total_price_after_discount_format = total_price_after_discount.toLocaleString('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                })
                total_price_element.text(total_price_after_discount_format);
            });
        });
    </script>
@endpush

