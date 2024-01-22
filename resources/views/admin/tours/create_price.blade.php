@extends('admin.layouts.master')
@push('css')
    <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-12 mt-4">
        <form method="post" action="{{ route('admin.tours.store_price') }}" class="needs-validation" novalidate
              enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Nhóm tuổi</label>
                <input type="text" class="form-control" name="age_group" placeholder=""
                       value="{{ old('age_group') }}" required>
            </div>

            <div class="form-group">
                <label for="price">Giá tiền</label>
                <div class="input-group">
                    <span class="input-group-text">VNĐ</span>
                    <input type="number" name="price" id="price" min="1" value="{{ old('price') }}"
                           class="form__input form-control"/>
                </div>
            </div>
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
            <button class="btn btn-primary mb-3" type="submit">Thêm</button>
        </form>
    </div>
@endsection
