@php use App\Enums\TourStatusEnum; @endphp
@extends('admin.layouts.master')
@push('css')
    <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-12 mt-4">
        <form method="post" action="{{ route('admin.destinations.update', $destination) }}" class="needs-validation"
              id="form-edit"
              enctype="multipart/form-data"
              novalidate>
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Tên</label>
                <input type="text" class="form-control" name="name" placeholder="Tên"
                       value="{{ $destination->name }}" required>
            </div>
            <button class="btn btn-primary mb-3" type="submit">Cập nhật</button>
        </form>
@endsection
