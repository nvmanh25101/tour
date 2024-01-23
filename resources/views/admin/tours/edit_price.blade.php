@extends('admin.layouts.master')
@push('css')
    <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-12 mt-4">
        <form method="post" action="{{ route('admin.tours.edit_price', $tour) }}" class="needs-validation" novalidate
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if($prices)
                @foreach($prices as $item)
                    <input name="price_id[]" hidden value="{{ $item->id }}">
                    <div class="mb-4 form-group">
                        <div class="form-group">
                            <label>Nhóm tuổi</label>
                            <input type="text" class="form-control" name="age_group[]" placeholder=""
                                   value="{{ $item->age_group }}" required disabled>
                        </div>

                        <div class="form-group">
                            <label for="price">Giá tiền</label>
                            <div class="input-group">
                                <span class="input-group-text">VNĐ</span>
                                <input type="number" name="price[]" id="price" min="1" value="{{ $item->price }}"
                                       class="form__input form-control"/>
                        </div>
                    </div>
                @endforeach
            @endif
            <button class="btn btn-primary mb-3" type="submit">Cập nhật</button>
        </form>
    </div>
@endsection
