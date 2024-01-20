@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('flatpicker/flatpickr.min.css') }}">
@endpush
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('admin.appointments.update', $appointment) }}" class="needs-validation"
              id="form-edit"
              novalidate>
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Khách hàng</label>
                        <input type="text" class="form-control" name="name_booker" readonly
                               value="{{ $appointment->name_booker }}">
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" class="form-control" name="phone_booker" readonly
                               value="{{ $appointment->phone_booker }}">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" readonly
                               value="{{ $appointment->email_booker }}">
                    </div>
                    <div class="form-group">
                        <label>Số người</label>
                        <input type="text" class="form-control" name="number_people" readonly
                               value="{{ $appointment->number_people }}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Ngày đặt</label>
                        <input class="form-control" name="date" required id="date">
                    </div>
                    <div class="form-group">
                        <label>Khung giờ</label>
                        <select class="form-control" name="time_id">
                            @foreach($times as $time)
                                <option value="{{ $time->id }}"
                                        @if($appointment->time_id === $time->id)
                                            selected
                                    @endif
                                >
                                    {{ $time->time_display }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select class="form-control" name="status">
                            @foreach($arrAppointmentStatus as $option => $value)
                                <option value="{{ $value }}"
                                        @if($appointment->status === $value)
                                            selected
                                    @endif
                                >
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nhân viên phục vụ</label>
                        <select class="form-control" name="admin_id">
                            <option value="{{ null }}">-- Chọn nhân viên --</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}"
                                        @if($appointment->admin_id === $employee->id)
                                            selected
                                    @endif
                                >
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
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
                    <select class="col-9 form-control" name="voucher_id" id="voucher" disabled>
                        @if($appointment->customer)
                            <option value="-1">-- Chọn voucher --</option>
                            @foreach($vouchers as $voucher)
                                <option value="{{ $voucher->id }}"
                                        @if($appointment->voucher_id === $voucher->id)
                                            selected
                                    @endif
                                >
                                    {{ $voucher->name }}
                                </option>
                            @endforeach
                        @else
                            <option value="-1">-- Khách hàng chưa đăng ký tài khoản --</option>
                        @endif
                    </select>
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
                <button class="btn btn-primary mb-3" id="btn-submit" type="submit">Cập nhật</button>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('flatpicker/flatpickr.js') }}"></script>
    <script src="{{ asset('js/notify.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $("#date").flatpickr({
                dateFormat: "d-m-Y",
                defaultDate: "{{ $appointment->date_display }}"
            });

            {{--let price_element = $('#bookingPrice');--}}
            {{--let total_price_element = $('#total_price');--}}
            {{--let voucher_element = $('#voucher');--}}
            {{--let voucher_error = $('.voucher-error');--}}
            {{--let discount_price_element = $('#discount_price');--}}

            {{--price_element.on('change', function () {--}}
            {{--    voucher_element.show();--}}

            {{--    let duration_price = $(this).children("option:selected").text();--}}
            {{--    let dataArray = duration_price.split('-');--}}
            {{--    let price = dataArray[1].trim();--}}
            {{--    let price_value = parseFloat(price.replace(/[^\d.-]/g, ''));--}}
            {{--    isNaN(price_value) ? price_value = 0 : price_value;--}}
            {{--    let price_format = price_value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + ' VND';--}}
            {{--    total_price_element.text(price_format);--}}

            {{--    voucher_element.on('change', function () {--}}
            {{--        if ($(this).val() === '-1') {--}}
            {{--            total_price_element.text(price_format);--}}
            {{--            return;--}}
            {{--        }--}}
            {{--        let voucher_type = $(this).children("option:selected").data('type');--}}
            {{--        let voucher_value = $(this).children("option:selected").data('value');--}}
            {{--        let min_spend = $(this).children("option:selected").data('min-spend');--}}
            {{--        let max_spend = $(this).children("option:selected").data('max-spend');--}}
            {{--        let min_spend_value = parseFloat(min_spend.replace(/[^\d.-]/g, ''));--}}
            {{--        let min_spend_format = min_spend_value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + ' VND';--}}

            {{--        if (min_spend > price_value) {--}}
            {{--            total_price_element.text(price_format);--}}
            {{--            voucher_error.text('Voucher này chỉ áp dụng cho đơn hàng từ ' + min_spend_format + ' trở lên');--}}
            {{--            return;--}}
            {{--        } else {--}}
            {{--            voucher_error.text('');--}}
            {{--        }--}}

            {{--        let total_price = total_price_element.text();--}}
            {{--        let total_price_value = parseFloat(total_price.replace(/[^\d.-]/g, ''));--}}
            {{--        isNaN(total_price_value) ? total_price_value = 0 : total_price_value;--}}
            {{--        let total_price_after_discount = 0;--}}
            {{--        let discount = 0;--}}
            {{--        if (voucher_type === {{ VoucherTypeEnum::PHAN_TRAM }}) {--}}
            {{--            discount = total_price_value * voucher_value / 100;--}}
            {{--            if (discount > max_spend) {--}}
            {{--                discount = max_spend;--}}
            {{--                $('#max_discount').text('Tối đa' + max_spend + ' VND');--}}

            {{--            }--}}
            {{--            total_price_after_discount = total_price_value - discount;--}}
            {{--            discount_price_element.text(discount + ' VND');--}}
            {{--        } else {--}}
            {{--            total_price_after_discount = total_price_value - voucher_value;--}}
            {{--            discount_price_element.text(voucher_value + ' VND');--}}
            {{--        }--}}
            {{--        let total_price_after_discount_format = total_price_after_discount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + ' VND';--}}
            {{--        total_price_element.text(total_price_after_discount_format);--}}
            {{--    });--}}
            {{--});--}}
            {{--@if(session('success'))--}}
            {{--$.notify('{{ session('success') }}', "success");--}}
            {{--@endif--}}
            {{--@if(session('error'))--}}
            {{--$.notify('{{ session('error') }}', "error");--}}
            {{--@endif--}}
        });
    </script>
@endpush


