@extends('admin.layouts.master')
@push('css')
    <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-12 mt-4">

        <form method="post" action="{{ route('admin.tours.store') }}" class="needs-validation" novalidate
              enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Code</label>
                <input type="text" class="form-control" name="code" placeholder="Code"
                       value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label>Tên</label>
                <input type="text" class="form-control" name="name" placeholder="Tên"
                       value="{{ old('name') }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Mô tả</label>
                <textarea class="form-control" name="description" placeholder="Mô tả"
                          required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label>Ảnh</label>
                <input type="file" class="form-control-file" name="image" value="{{ old('image') }}" required id="image"
                       accept="image/*">
                <div class="holder">
                    <img
                        id="imgPreview"
                        src="#" alt="pic"/>
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Giá bao gồm</label>
                <textarea class="form-control" name="price_include" placeholder="Giá bao gồm"
                          required>{{ old('price_include') }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label>Giá không bao gồm</label>
                <textarea class="form-control" name="price_exclude" placeholder="Giá không bao gồm"
                          required>{{ old('price_exclude') }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label>Giá khi có trẻ em</label>
                <textarea class="form-control" name="price_children" placeholder="Giá khi có trẻ em">{{ old('price_children') }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label>Lưu ý</label>
                <textarea class="form-control" name="note" placeholder="Lưu ý"
                          required>{{ old('note') }}</textarea>
            </div>

            <div class="form-group">
                <label>Thời gian khởi hành</label>
                <input type="text" class="form-control" name="departure_time" placeholder="Thời gian khởi hành"
                       value="{{ old('departure_time') }}" required>
            </div>

            <div class="form-group">
                <label>Thời lượng</label>
                <input type="text" class="form-control" name="duration" placeholder="Thời lượng"
                       value="{{ old('duration') }}" required>
            </div>

            <div class="form-group">
                <label>Phương tiện</label>
                <select class="form-control" name="vehicle">
                    @foreach(\App\Enums\TourVehicleEnum::asArray() as $key => $value)
                        <option value="{{ $value }}">
                            {{ \App\Enums\TourVehicleEnum::getKeyByValue($value) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Điểm đến</label>
                <select class="form-control" name="destinations[]" multiple>
                    @foreach($destinations as $destination)
                        <option value="{{ $destination->id }}">
                            {{ $destination->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Dịch vụ</label>
                <select class="form-control" name="services[]" multiple>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">
                            {{ $service->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="form-group mb-3 col-8">
                    <label>Danh mục</label>
                    <select class="form-control" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button class="btn btn-primary mb-3" type="submit">Thêm</button>
        </form>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            let image = $("#image");
            let imgURL;
            image.change(function (e) {
                $(".holder").show();
                imgURL = URL.createObjectURL(e.target.files[0]);
                $("#imgPreview").attr("src", imgURL);
            });
        })
    </script>
@endpush
