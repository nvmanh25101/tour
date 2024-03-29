@php use App\Enums\ServiceStatusEnum; @endphp
@extends('admin.layouts.master')
@push('css')
    <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/tours.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('admin.services.update', $service) }}" class="needs-validation"
              id="form-edit"
              novalidate>
            @csrf
            @method('PUT')
            @include('admin.layouts.errors')
            <div class="form-group">
                <label>Tên</label>
                <input type="text" class="form-control" name="name" placeholder="Tên"
                       value="{{ $service->name }}" required>
            </div>
            <button class="btn btn-primary mb-3" type="submit">Cập nhật</button>
        </form>
        @method('DELETE')
    </div>
@endsection
