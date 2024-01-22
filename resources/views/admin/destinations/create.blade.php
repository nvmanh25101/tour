@extends('admin.layouts.master')
@push('css')
    <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-12 mt-4">
        <form method="post" action="{{ route('admin.destinations.store') }}" class="needs-validation" novalidate
              enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Tên</label>
                <input type="text" class="form-control" name="name"
                       value="{{ old('name') }}" required>
            </div>
            <button class="btn btn-primary mb-3" type="submit">Thêm</button>
        </form>
    </div>
@endsection
