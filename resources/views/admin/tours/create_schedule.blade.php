@php use App\Enums\TourStatusEnum; @endphp
@extends('admin.layouts.master')
@push('css')
    <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('admin.tours.store_schedule') }}" class="needs-validation"
              id="form-edit"
              enctype="multipart/form-data"
              novalidate>
            @csrf
            <div class="row">
                <div class="form-group mb-3 col-8">
                    <label>Tour</label>
                    <select class="form-control" name="tour_id">
                        @foreach($tours as $tour)
                            <option value="{{ $tour->id }}">
                                {{ $tour->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Ngày</label>
                <input type="number" class="form-control" name="day"
                       value="{{ old('day') }}" required>
            </div>

            <div class="form-group">
                <label>Hoạt động</label>
                <input type="text" class="form-control" name="activity"
                       value="{{ old('activity') }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Mô tả</label>
                <textarea class="form-control" name="description" placeholder="Mô tả"
                          required>{{ old('description') }}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">Thêm</button>
        </form>
@endsection
@push('js')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/notify.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            @if(session('success'))
            $.notify('{{ session('success') }}', "success");
            @endif
            @if(session('error'))
            $.notify('{{ session('error') }}', "error");
            @endif
        })
    </script>
@endpush
