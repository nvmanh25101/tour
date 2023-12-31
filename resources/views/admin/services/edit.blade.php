@php use App\Enums\ServiceStatusEnum; @endphp
@extends('admin.layouts.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
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
                <label>Họ tên</label>
                <input type="text" class="form-control" name="name" value="{{ $service->name }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Mô tả</label>
                <textarea class="form-control" name="description" placeholder="Mô tả"
                          required>{{ $service->description }}</textarea>
            </div>

            <div class="row">
                <div class="form-group mb-3 col-8">
                    <label>Danh mục</label>
                    <select class="form-control" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    @if($service->category_id === $category->id)
                                        selected
                                @endif
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group mb-3
                @if($service->status === ServiceStatusEnum::HOAT_DONG)
                        d-none
                @endif
            ">
                <label>Trạng thái</label>
                @foreach($arrServiceStatus as $option => $value)
                    <br>
                    <div class="d-flex align-content-center font-16">
                        <label for="status{{ $value }}">
                            <input id="status{{ $value }}" type="radio" name="status" value="{{ $value }}" class="mr-1"
                                   @if ($service->status === $value)
                                       checked
                                @endif
                            >
                            {{ $option }}
                        </label>
                    </div>
                @endforeach
            </div>
            <button class="btn btn-primary mb-3" type="submit">Cập nhật</button>
        </form>
    </div>
@endsection
