@extends('admin.layouts.master')
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('admin.blogs.update', $blog) }}" class="needs-validation"
              id="form-edit"
              enctype="multipart/form-data"
              novalidate>
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group">
                    <label>Tiêu đề</label>
                    <input type="text" class="form-control" name="title" value="{{ $blog->title }}" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Nội dung</label>
                <textarea class="form-control" name="content" rows="5">{{ $blog->content }}</textarea>
            </div>

            <div class="form-group">
                <label>Ảnh</label>
                <input type="file" class="form-control-file" name="image"
                       id="image"
                       accept="image/*">
                <div class="holder">
                    <img
                        id="imgPreview"
                        src="{{ asset('storage/' . $blog->image) }}" alt="pic"/>
                </div>
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
