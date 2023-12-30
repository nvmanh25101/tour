@php use App\Enums\Category\StatusEnum; @endphp
@extends('admin.layouts.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('admin.categories.update', $category) }}" class="needs-validation"
              id="form-edit"
              novalidate>
            @csrf
            @method('PUT')
            @include('admin.layouts.errors')
            <div class="row">
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" class="form-control" name="name" value="{{ $category->name }}" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Mô tả</label>
                <textarea class="form-control" name="description" rows="5">{{ $category->description }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label>Loại</label>
                <select class="form-control" name="type">
                    @foreach($arrCategoryType as $option => $value)
                        <option value="{{ $value }}"
                                @if($category->type === $value)
                                    selected
                            @endif
                        >
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3
                @if($category->status === StatusEnum::HOAT_DONG)
                    d-none
                @endif
            ">
                <label>Trạng thái</label>
                @foreach($arrCategoryStatus as $option => $value)
                    <br>
                    <div class="d-flex align-content-center font-16">
                        <label for="status{{ $value }}">
                            <input id="status{{ $value }}" type="radio" name="status" value="{{ $value }}" class="mr-1"
                                   @if ($category->status === $value)
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
