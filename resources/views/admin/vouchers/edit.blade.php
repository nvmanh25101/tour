@php use App\Enums\VoucherStatusEnum;use App\Enums\VoucherTypeEnum; @endphp
@extends('admin.layouts.master')
@push('css')
    <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('admin.vouchers.update', $voucher) }}" class="needs-validation"
              id="form-edit"
              novalidate>
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Mã</label>
                        <input type="text" class="form-control" name="code" placeholder="Mã"
                               value="{{ $voucher->code }}" required>
                    </div>
                    <div class="form-group">
                        <label>Tên</label>
                        <input type="text" class="form-control" name="name" placeholder="Tên"
                               value="{{ $voucher->name }}" required>
                    </div>
                    <div class="form-group">
                        <label>Tổng số lượng</label>
                        <input type="number" class="form-control" name="uses_per_voucher" placeholder="Số lượng" min="1"
                               value="{{ $voucher->uses_per_voucher }}" required>
                    </div>
                    <div class="form-group">
                        <label>Số lượng cho mỗi khách hàng</label>
                        <input type="number" class="form-control" name="uses_per_customer" placeholder="Số lượng"
                               min="1"
                               value="{{ $voucher->uses_per_customer }}" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Loại áp dụng</label>
                        <select class="form-control" name="applicable_type">
                            <option value="-1">Chọn</option>
                            @foreach($arrVoucherApplyType as $option => $value)
                                <option value="{{ $value }}"
                                        @if($voucher->applicable_type === $value)
                                            selected
                                    @endif
                                >
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Loại giảm</label>
                        <select class="form-control" name="type">
                            <option value="-1">Chọn</option>
                            @foreach($arrVoucherType as $option => $value)
                                <option value="{{ $value }}"
                                        @if($voucher->type === $value)
                                            selected
                                    @endif
                                >
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mức giảm</label>
                        <input type="number" class="form-control" name="value" placeholder="Giá tiền" min="0" step="any"
                               value="{{ $voucher->value }}" required>
                    </div>
                    <div class="form-group">
                        <label>Giá trị đơn tối thiểu</label>
                        <input type="number" class="form-control" name="min_spend" placeholder="Giá tiền" min="0"
                               step="any"
                               value="{{ $voucher->min_spend }}" required>
                    </div>
                    <div class="form-group max_spend">
                        <label>Giá trị giảm tối đa</label>
                        <input type="number" class="form-control" name="max_spend" placeholder="Giá tiền" min="0"
                               step="any"
                               value="{{ $voucher->max_spend }}">
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="form-group col-6 row mb-3">
                    <label class="col-3 col-form-label">Ngày bắt đầu</label>
                    <input type="date" class="form-control col-5" name="start_date" placeholder="Ngày bắt đầu"
                           value="{{ $voucher->start_date }}" required>
                </div>
                <div class="form-group col-6 row mb-3">
                    <label class="col-3 col-form-label">Ngày kết thúc</label>
                    <input type="date" class="form-control col-5" name="end_date" placeholder="Ngày kết thúc"
                           value="{{ $voucher->end_date }}" required>
                </div>
            </div>

            <div class="form-group mb-3
                @if($voucher->status === VoucherStatusEnum::HOAT_DONG)
                    d-none
                @endif
                ">
                <label>Trạng thái</label>
                @foreach($arrVoucherStatus as $option => $value)
                    <br>
                    <div class="d-flex align-content-center font-16">
                        <label for="status{{ $value }}">
                            <input id="status{{ $value }}" type="radio" name="status" value="{{ $value }}"
                                   class="mr-1"
                                   @if ($voucher->status === $value)
                                       checked
                                @endif
                            >
                            {{ $option }}
                        </label>
                    </div>
                @endforeach
            </div>
            <button class="btn btn-primary mb-3" type="submit">Cập nhật</button>
        </form>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            let select_type = $('select[name="type"]');
            if (select_type.val() === '{{ VoucherTypeEnum::PHAN_TRAM }}') {
                $('.max_spend').show();
            } else {
                $('.max_spend').hide();
            }

            select_type.change(function () {
                console.log($(this).val() === '{{ VoucherTypeEnum::PHAN_TRAM }}');
                if ($(this).val() === '{{ VoucherTypeEnum::PHAN_TRAM }}') {
                    $('.max_spend').show();
                } else {
                    $('.max_spend').hide();
                    $('input[name="max_spend"]').val('');
                }
            });
        });
    </script>
@endpush
