@php use App\Enums\ProductStatusEnum; @endphp
@extends('admin.layouts.master')
@push('css')
    <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('admin.products.update', $product) }}" class="needs-validation"
              id="form-edit"
              enctype="multipart/form-data"
              novalidate>
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Họ tên</label>
                <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Mô tả</label>
                <textarea class="form-control" name="description" placeholder="Mô tả"
                          required>{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Ảnh</label>
                <input type="file" class="form-control-file" name="image"
                       id="image"
                       accept="image/*">
                <div class="holder">
                    <img
                        id="imgPreview"
                        src="{{ asset('storage/' . $product->image) }}" alt="pic"/>
                </div>
            </div>

            <div class="form-group">
                <label for="quantity">Số lượng</label>
                <input type="number" name="quantity" id="quantity" class=" form-control" min="1"
                       value="{{ $product->quantity }}"/>
            </div>

            <div class="form-group">
                <label for="price">Giá tiền</label>
                <div class="input-group">
                    <span class="input-group-text">VNĐ</span>
                    <span class="input-group-text">0,00</span>
                    <input type="number" name="price" id="price" min="1" value="{{ $product->price }}"
                           class=" form__input form-control"/>
                </div>
            </div>

            <div class="form-group">
                <label>Thương hiệu</label>
                <input type="text" class="form-control" name="brand" placeholder="Tên"
                       value="{{ $product->brand }}" required>
            </div>

            <div class="row">
                <div class="form-group mb-3 col-8">
                    <label>Danh mục</label>
                    <select class="form-control" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    @if($product->category_id === $category->id)
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
                @if($product->status === ProductStatusEnum::HOAT_DONG)
                        d-none
                @endif
            ">
                <label>Trạng thái</label>
                @foreach($arrProductStatus as $option => $value)
                    <br>
                    <div class="d-flex align-content-center font-16">
                        <label for="status{{ $value }}">
                            <input id="status{{ $value }}" type="radio" name="status" value="{{ $value }}" class="mr-1"
                                   @if ($product->status === $value)
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
            let image = $("#image");
            let imgPreview = $("#imgPreview");

            if (imgPreview.attr("src") !== "") {
                $(".holder").show();
            }
            let imgURL;
            image.change(function (e) {
                $(".holder").show();
                imgURL = URL.createObjectURL(e.target.files[0]);
                imgPreview.attr("src", imgURL);
            });
        })
    </script>
@endpush
