@php use App\Enums\ServiceStatusEnum; @endphp
@extends('admin.layouts.master')
@push('css')
    <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/services.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('admin.services.update', $service) }}" class="needs-validation"
              id="form-edit"
              novalidate>
            @csrf
            @method('PUT')
            @include('admin.layouts.errors')
            <div class="form-group">
                <label>Họ tên</label>
                <input type="text" class="form-control" name="name" value="{{ $service->name }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Mô tả</label>
                <textarea class="form-control" name="description" placeholder="Mô tả"
                          required>{{ $service->description }}</textarea>
            </div>
            <div class="row mb-1" id="duration_price">
                @foreach ($service->priceServices as $price)
                    <div class="col-6 d-flex flex-row mt-2 align-content-center">
                        <input type="hidden" name="price_id[]" value="{{ $price->id }}">
                        <div class="form-group">
                            <label for="duration">Thời lượng(phút)</label>
                            <input type="number" name="duration[]" id="duration" value="{{ $price->duration }}" min="1"
                                   required
                                   class="form-control"/>
                        </div>

                        <div class="ms-1 form-group">
                            <label for="price">Giá tiền</label>
                            <div class="input-group">
                                <span class="input-group-text">VNĐ</span>
                                <input type="number" name="price[]" id="price" value="{{ $price->price }}" min="1"
                                       required
                                       class="form__input form-control"/>
                            </div>
                        </div>
                        <button type="button" class="delete-price" data-price='{{ $price->id }}'
                                data-service='{{ $service->id }}'>
                            <i class="mdi mdi-delete-outline"></i>
                        </button>
                    </div>
                @endforeach
            </div>

            <div class="mb-5 fs-4" id="add_price">
                <i class="mdi mdi-plus-circle-outline"></i>
            </div>
            <div class="row">
                <div class="form-group mb-3 col-8">
                    <label>Danh mục</label>
                    <select class="form-control" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    @if($service->category_id === $category->id)
                                        selected
                                @endif
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group mb-3
                @if($service->status === ServiceStatusEnum::HOAT_DONG)
                        d-none
                @endif
            ">
                <label>Trạng thái</label>
                @foreach($arrServiceStatus as $option => $value)
                    <br>
                    <div class="d-flex align-content-center font-16">
                        <label for="status{{ $value }}">
                            <input id="status{{ $value }}" type="radio" name="status" value="{{ $value }}" class="mr-1"
                                   @if ($service->status === $value)
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
        @method('DELETE')
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/notify.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    {{--    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/r-2.5.0/rg-1.4.1/sc-2.3.0/sb-1.6.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>--}}
    <script>
        $(document).ready(function () {
            CSRF_TOKEN = document.querySelector('[name="_token"]').getAttribute("value");
            const DELETE_METHOD_ELE = $('input[name="_method"]')[1];
            const DELETE_METHOD = $(DELETE_METHOD_ELE).val();

            $('#add_price').click(function () {
                $('#duration_price').append(`
                <div class="col-6 d-flex flex-row  mt-2 align-content-center">
                    <div class="form-group">
                        <input type="hidden" name="price_id[]" value="-1">
                        <label for="duration">Thời lượng(phút)</label>
                        <input type="number" name="duration[]" id="duration" class=" form-control"/>
                    </div>

                    <div class="ms-1 form-group">
                        <label for="quantity">Giá tiền</label>
                        <div class="input-group">
                            <span class="input-group-text">VNĐ</span>
                            <input type="number" name="price[]" id="quantity" min="1"
                                   class="form__input form-control"/>
                        </div>
                    </div>
                    <button type="button" class="delete-price"  data-price='-1' data-service='-1'>
                        <i class="mdi mdi-delete-outline"></i>
                    </button>
                </div>
                `);
                $('.delete-price').click(function () {
                    let btn = $(this);
                    let price = $(this).data('price');
                    let service = $(this).data('service');

                    if (price === -1 && service === -1) {
                        btn.parent().remove();
                    }
                });
            })
            $('.delete-price').on('click', function () {
                let btn = $(this);
                let price = $(this).data('price');
                let service = $(this).data('service');

                if (price === -1 && service === -1) {
                    btn.parent().remove();
                    return;
                }

                let url = '{{ route('admin.services.destroyPrice', ['id' => '__service', 'price_id' => '__price']) }}';
                url = url.replace('__service', service);
                url = url.replace('__price', price);
                let formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('_method', DELETE_METHOD);

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    contentType: false,
                    processData: false,
                })
                    .done(function (res) {
                        if (res['success']) {
                            btn.parent().remove();
                        } else {
                            console.log(res);
                        }
                    })
            });
        })
    </script>
@endpush
