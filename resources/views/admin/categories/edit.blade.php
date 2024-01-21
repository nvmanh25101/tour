@php use App\Enums\Category\StatusEnum; @endphp
@extends('admin.layouts.master')
@push('css')
@endpush
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('admin.categories.update', $category) }}" class="needs-validation"
              enctype="multipart/form-data"
              id="form-edit"
              novalidate>
            @csrf
            @method('PUT')
            @include('admin.layouts.errors')
            <div class="row">
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" class="form-control" name="name" value="{{ $category->name }}" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Mô tả</label>
                <textarea class="form-control" name="description" rows="5">{{ $category->description }}</textarea>
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
            <div class="form-group mb-3
                @if($category->status === StatusEnum::HOAT_DONG)
                    d-none
                @endif
            ">
                <label>Trạng thái</label>
                @foreach($arrCategoryStatus as $option => $value)
                    <br>
                    <div class="d-flex align-content-center font-16">
                        <label for="status{{ $value }}">
                            <input id="status{{ $value }}" type="radio" name="status" value="{{ $value }}" class="mr-1"
                                   @if ($category->status === $value)
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
