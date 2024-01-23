@php use App\Enums\OrderPaymentStatusEnum;use App\Enums\OrderStatusEnum;use App\Enums\PaymentEnum; @endphp
@extends('customer.layouts.master')
@push('css')
@endpush
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Khách hàng</label>
                    <input type="text" class="form-control" name="name_contact" readonly
                           value="{{ $reservation->name_contact }}">
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control" name="phone_contact" readonly
                           value="{{ $reservation->phone_contact }}">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="phone_contact" readonly
                           value="{{ $reservation->email_contact }}">
                </div>
                <div class="form-group">
                    <label>Hình thức thanh toán</label>
                    <input type="text" class="form-control" name="payment_method" readonly
                           value="{{ PaymentEnum::getKeyByValue($reservation->payment_method)  }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Trạng thái đơn hàng</label>
                    <input type="text" class="form-control" name="payment_method" readonly
                           value="{{ OrderStatusEnum::getKeyByValue($reservation->status)  }}">
                </div>
                <div class="form-group">
                    <label>Trạng thái thanh toán</label>
                    <input type="text" class="form-control" name="payment_method" readonly
                           value="{{ OrderPaymentStatusEnum::getKeyByValue($reservation->payment_status)  }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group mb-3 col-12">
                <table class="table table-borderless table-centered mb-0">
                    <caption style="caption-side:top" class="fs-4">Tour</caption>
                    <thead class="thead-light">
                    <tr>
                        <th>Tour</th>
                        <th>Giá</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="product">
                        <td>
                            <img src="{{ asset('storage/' . $reservation->tour->image) }}" alt="contact-img"
                                 title="contact-img" class="rounded mr-3" height="64">
                            <p class="m-0 d-inline-block align-middle product-name">
                                <a href="{{ route('customers.tour', $reservation->tour) }}"
                                   class="text-body">{{ $reservation->tour->name }}</a>
                            </p>
                        </td>
                        <td>
                                            <span class="price_unit">
                                                @foreach($reservation->tour->prices as $price)
                                                    @php
                                                        $stringToCheck = $price->age_group;

                                                        $pattern = "NGƯỜI LỚN";

                                                        $startsWithPattern = str_starts_with($stringToCheck, $pattern);
                                                    @endphp
                                                    @if($startsWithPattern)
                                                        <span class="price-tour fs-5">{{ number_format($price->price) }} VND/người</span>
                                                    @endif
                                                @endforeach
                                            </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-4 form-horizontal float-end">
            <div class="form-group row">
                <label class="col-3 col-form-label">Voucher</label>
                <div class="col-9">
                    <input type="text" class="form-control" name="voucher" id="voucher" disabled
                           value="{{ $reservation->voucher->name }}">
                </div>
                <div class="voucher-error text-danger"></div>

                <div class="form-group row">
                    <span class="col-3 col-form-label">Tiền giảm voucher</span>
                    <span class="col-9 d-flex align-items-center fs-4">{{ $reservation->price - $reservation->total_price }}VND</span>
                </div>
                <div class="form-group row">
                    <span class="col-3 col-form-label">Tổng tiền</span>
                    <span class="col-9 d-flex align-items-center fs-4">{{ $reservation->total_price }}VND</span>
                </div>
            </div>
        </div>
    </div>
@endsection

