@extends('admin.layouts.master')
@push('css')
    <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('admin.products.store') }}" class="needs-validation" novalidate
              enctype="multipart/form-data">
            @csrf
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

            <div class="form-group">
                <label for="quantity">Số lượng</label>
                <input type="number" name="quantity" id="quantity" class=" form-control" min="1"
                       value="{{ old('quantity') }}"/>
            </div>

            <div class="form-group">
                <label for="price">Giá tiền</label>
                <div class="input-group">
                    <span class="input-group-text">VNĐ</span>
                    <input type="number" name="price" id="price" min="1"
                           class="form__input form-control"/>
                </div>
            </div>

            <div class="form-group">
                <label>Thương hiệu</label>
                <input type="text" class="form-control" name="brand" placeholder="Tên"
                       value="{{ old('brand') }}" required>
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
