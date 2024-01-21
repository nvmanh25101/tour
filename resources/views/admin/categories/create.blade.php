@extends('admin.layouts.master')
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('admin.categories.store') }}" class="needs-validation" novalidate enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Tên</label>
                <input type="text" class="form-control" name="name" placeholder="Tên"
                       value="{{ old('name') }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Mô tả</label>
                <textarea class="form-control" name="description" rows="5">{{ old('description') }}</textarea>
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
