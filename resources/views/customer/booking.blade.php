@extends('customer.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('flatpicker/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/customer/booking.css') }}">
@endpush
@section('carousel')
    <div class="text-center text-white d-flex align-items-center position-relative page-header"
         style="background-image: url(https://laspas.vn/ma-may/wp-content/uploads/sites/5/2018/08/slide-1.jpg);">
        <div class="m-auto">
            <h1 class="font-family-secondary h2 text-uppercase text-center mt-2 mb-3 page-title">
                Đặt lịch
            </h1>
        </div>
    </div>
@endsection
@section('content')
    <div class="col-12 mt-4">
        <h4 class="text-uppercase">Điền Thông tin</h4>
        <div class="mt-4">
            <form id="booking-form" method="post" action="{{ route('reservations.store') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-4">
                        <label for="name">Họ tên</label>
                        <input type="text" name="name_booker" class="form-control" placeholder="Họ tên*">
                    </div>
                    <div class="form-group col-4">
                        <label>Số người</label>
                        <select class="custom-select mb-3" name="number_people">
                            <option value="-1" selected>Số lượng*</option>
                            @for($i=1; $i<=2; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <label>Số điện thoại</label>
                        <input class="form-control validate-control" id="bookingPhone" name="phone_booker"
                               required placeholder="Số điện thoại*">
                    </div>
                    <div class="form-group col-4">
                        <label>Email</label>
                        <input type="email" id="bookingEmail" name="email_booker"
                               class="form-control validate-control" placeholder="Email*"
                               required>
                    </div>
                </div>
                <div class="row">
                    <label>Chọn thời gian</label>
                    <div class="form-group col-4">
                        <input class="form-control" id="date" name="date" placeholder="Chọn ngày">
                    </div>
                    <div class="form-group col-4">
                        <select class="form-control" name="time_id">
                            <option value="-1">- Chọn giờ check-in -</option>
                            @foreach($times as $time)
                                <option value="{{ $time->id }}">{{ $time->time_display }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-4">
                        <label>Loại dịch vụ</label>
                        <select class="form-control validate-control" id="bookingServiceType" required>
                            <option value="-1">- Chọn loại dịch vụ -</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        @if($service)
                                            @if($category->id === $service->category->id)
                                                selected
                                    @endif
                                    @endif

                                >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <label>Dịch vụ</label>
                        <select class="form-control validate-control" id="bookingService"
                                name="service_id" required>
                            <option value="-1">- Chọn dịch vụ -</option>
                            @if($services)
                                @foreach($services as $item)
                                    <option value="{{ $item->id }}"
                                            @if($service)
                                                @if($item->id === $service->id)
                                                    selected
                                        @endif
                                        @endif
                                    >{{ $item->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <label>Chi tiết</label>
                        <select class="form-control validate-control" id="bookingPrice" name="price_id"
                                required>
                            <option value="-1">- Chọn -</option>
                            @if($services)
                                @foreach($service->priceServices as $price)
                                    <option value="{{ $price->id }}">{{ $price->duration }}'
                                        - {{ $price->price_display }} VND
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Ghi chú</label>
                    <textarea id="message" name="note" class="form-control" rows="3"
                              spellcheck="false"></textarea>
                </div>
                <div class="form-group col-4">
                    <label>Voucher</label>
                    <select class="form-control validate-control" id="Voucher"
                            name="voucher_id" required>
                        <option value="-1">- Chọn voucher -</option>
                        @if($vouchers)
                            @foreach($vouchers as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <hr>
                <div class="total_price">
                    <span>Total</span>
                    <span id="total_price"></span>
                </div>
                <button class="btn submit mb-3" type="submit">Đặt lịch</button>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('flatpicker/flatpickr.js') }}"></script>

    <script>
        $("#date").flatpickr({
            dateFormat: "d-m-Y",
            minDate: "today",
            maxDate: new Date().fp_incr(15),
        });

        $('document').ready(function () {
            let category_element = $('#bookingServiceType');
            let service_element = $('#bookingService');
            let price_element = $('#bookingPrice');
            let date_element = $('#date');
            let times = $('select[name="time_id"] option');
            let total_price_element = $('#total_price');

            date_element.on('change', function () {
                let date_value = $(this).val();
                let now = new Date();

                let dateParts = date_value.split("-");
                let day = parseInt(dateParts[0], 10);
                let month = parseInt(dateParts[1], 10) - 1;
                let year = parseInt(dateParts[2], 10);

                let dateObject = new Date(year, month, day);

                if (
                    dateObject.getDate() === now.getDate() &&
                    dateObject.getMonth() === now.getMonth() &&
                    dateObject.getFullYear() === now.getFullYear()
                ) {
                    times.each(function (index, element) {
                        if (index === 0) {
                            return;
                        }
                        let time = $(element).text();
                        let time_parts = time.split(":");
                        let hour = parseInt(time_parts[0], 10);
                        let minute = parseInt(time_parts[1], 10);

                        let timeObject = new Date(year, month, day, hour, minute);
                        let timestamp = timeObject.getTime();

                        if (timestamp < now.getTime()) {
                            $(element).attr('disabled', 'disabled');
                            $(element).removeAttr('selected');
                            $(element).text(time + ' - Hết chỗ');
                        } else {
                            $(element).removeAttr('disabled');
                        }
                    });
                } else {
                    times.each(function (index, element) {
                        if (index === 0) {
                            return;
                        }
                        $(element).removeAttr('disabled');
                        $(element).text($(element).text().replace(' - Hết chỗ', ''));
                    });
                }
            });

            category_element.on('change', function () {
                let category_id = $(this).val();

                if (category_id !== '-1') {
                    let url = '{{ route('reservations.getServices', ['category' => '__id']) }}';
                    url = url.replace('__id', category_id);
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            service_element.empty();
                            service_element.append('<option value="-1">- Chọn dịch vụ -</option>');
                            $.each(data.services, function (key, value) {
                                service_element.append(`<option value="${value.id}">${value.name}</option>`);
                            });
                        }
                    });
                } else {
                    service_element.empty();
                    service_element.append('<option value="-1">- Chọn dịch vụ -</option>');
                }
            });

            service_element.on('change', function () {
                let service_id = $(this).val();

                if (service_id !== '-1') {
                    let url = '{{ route('reservations.getPrices', ['service' => '__id']) }}';
                    url = url.replace('__id', service_id);
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            price_element.empty();
                            price_element.append('<option value="-1">- Chọn -</option>');
                            $.each(data.prices, function (key, value) {
                                let price = parseFloat(value.price.replace(/[^\d.-]/g, ''))
                                let price_format = price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + ' VND'
                                price_element.append(`<option value="${value.id}">${value.duration}' - ${price_format}</option>`);
                            });
                        }
                    });
                } else {
                    price_element.empty();
                    price_element.append('<option value="-1">- Chọn -</option>');
                }
            });

            price_element.on('change', function () {
                let duration_price = $(this).children("option:selected").text();
                let dataArray = duration_price.split('-');
                let price = dataArray[1].trim();
                let price_value = parseFloat(price.replace(/[^\d.-]/g, ''));
                isNaN(price_value) ? price_value = 0 : price_value;
                let price_format = price_value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + ' VND';
                total_price_element.text(price_format);
            });

            {{--let url = '{{ route('customers.getTimes', ['date' => '__date']) }}';--}}
            {{--url = url.replace('__date', date_value);--}}
            {{--$.ajax({--}}
            {{--    url: url,--}}
            {{--    type: 'GET',--}}
            {{--    dataType: 'json',--}}
            {{--    success: function (data) {--}}
            {{--        console.log(data);--}}
            {{--        // price_element.empty();--}}
            {{--        // price_element.append('<option value="-1">- Chọn -</option>');--}}
            {{--        // $.each(data.prices, function (key, value) {--}}
            {{--        //     let price = parseFloat(value.price.replace(/[^\d.-]/g, ''))--}}
            {{--        //     let price_format = price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + ' VND'--}}
            {{--        //     price_element.append(`<option value="${value.id}">${value.duration}' - ${price_format}</option>`);--}}
            {{--        // });--}}
            {{--    }--}}
            {{--});--}}
        })
    </script>
@endpush
