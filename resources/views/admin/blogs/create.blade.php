@extends('admin.layouts.master')
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('admin.blogs.store') }}" class="needs-validation" novalidate
              enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" class="form-control" name="title" placeholder="Tiêu đề"
                       value="{{ old('title') }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Nội dung</label>
                <textarea class="form-control" name="content" rows="5">{{ old('content') }}</textarea>
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
