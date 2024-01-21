@php use App\Enums\AppointmentStatusEnum; @endphp
@extends('customer.layouts.master')
@push('css')
@endpush
@section('carousel')
    <div class="text-center text-white d-flex align-items-center position-relative page-header"
         style="background-image: url(https://laspas.vn/ma-may/wp-content/uploads/sites/5/2018/08/slide-1.jpg);">
        <div class="m-auto">
            <h1 class="font-family-secondary h2 text-uppercase text-center mt-2 mb-3 page-title">
                Lich hẹn của bạn
            </h1>
        </div>
    </div>
@endsection
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Khách hàng</label>
                    <input type="text" class="form-control" name="name_booker" disabled
                           value="{{ $appointment->name_booker }}">
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control" name="phone_booker" disabled
                           value="{{ $appointment->phone_booker }}">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" disabled
                           value="{{ $appointment->email_booker }}">
                </div>
                <div class="form-group">
                    <label>Số người</label>
                    <input type="text" class="form-control" name="number_people" disabled
                           value="{{ $appointment->number_people }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Ngày đặt</label>
                    <input class="form-control" name="date" required id="date" value="{{ $appointment->date_display }}"
                           disabled>
                </div>
                <div class="form-group">
                    <label>Khung giờ</label>
                    <input class="form-control" value="{{ $appointment->time->time }}" disabled>
                </div>
                <div class="form-group">
                    <label>Trạng thái</label>
                    <input class="form-control" value="{{ AppointmentStatusEnum::getKeyByValue($appointment->status) }}"
                           disabled>
                </div>
                <div class="form-group">
                    <label>Nhân viên phục vụ</label>
                    <input class="form-control" value="{{ $appointment->admin->name ?? '' }}" disabled>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group mb-3 col-12">
                <table class="table table-hover table-centered mb-0">
                    <caption style="caption-side:top" class="fs-4">Dịch vụ</caption>
                    <thead>
                    <tr>
                        <th>Danh mục</th>
                        <th>Dịch vụ</th>
                        <th>Thời gian(phút)</th>
                        <th>Giá(VNĐ)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $appointment->service->category->name }}</td>
                        <td>{{ $appointment->service->name }}</td>
                        <td>{{ $appointment->duration }}</td>
                        <td>{{ $appointment->price_display }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group mb-3 col-12">
                <label>Ghi chú</label>
                <textarea class="form-control" name="note" rows="5" readonly>{{ $appointment->note }}</textarea>
            </div>
        </div>

        <div class="col-4 form-horizontal float-end">
            <div class="form-group row">
                <label class="col-3 col-form-label">Voucher</label>
                <input class="form-control" value="{{ $appointment->voucher->name }}" disabled>
            </div>
            <div class="voucher-error text-danger"></div>

            <div class="form-group row">
                <span class="col-3 col-form-label">Tiền giảm voucher</span>
                <span class="col-9 d-flex align-items-center fs-4">{{ $appointment->price - $appointment->total_price }}VND</span>
            </div>
            <div class="form-group row">
                <span class="col-3 col-form-label">Tổng tiền</span>
                <span class="col-9 d-flex align-items-center fs-4">{{ $appointment->total_price }}VND</span>
            </div>
        </div>
    </div>
@endsection

