@php use App\Enums\TourStatusEnum; @endphp
@extends('admin.layouts.master')
@push('css')
    <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('admin.tours.update_schedule', $tour) }}" class="needs-validation"
              id="form-edit"
              enctype="multipart/form-data"
              novalidate>
            @csrf
            @method('PUT')
            @if($schedules)
                @foreach($schedules as $item)
                    <input name="schedule_id[]" hidden value="{{ $item->id }}">
                    <div class="mb-4 form-group">
                        <div class="form-group">
                            <label>Ngày</label>
                            <input type="number" class="form-control" name="day[]"
                                   value="{{ $item->day }}" required>
                        </div>

                        <div class="form-group">
                            <label>Hoạt động</label>
                            <input type="text" class="form-control" name="activity[]"
                                   value="{{ $item->activity }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Mô tả</label>
                            <textarea class="form-control" name="description[]" placeholder="Mô tả"
                                      required>{{ $item->description }}</textarea>
                        </div>
                    </div>
                @endforeach
            @endif
            <button class="btn btn-primary" type="submit">Cập nhật</button>
        </form>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/notify.min.js') }}"></script>

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

            @if(session('success'))
            $.notify('{{ session('success') }}', "success");
            @endif
            @if(session('error'))
            $.notify('{{ session('error') }}', "error");
            @endif
        })
    </script>
@endpush
