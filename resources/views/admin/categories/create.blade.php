@extends('admin.layouts.master')
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('admin.categories.store') }}" class="needs-validation" novalidate>
            @csrf
            <div class="form-group">
                <label>Tên</label>
                <input type="text" class="form-control" name="name" placeholder="Tên"
                       value="{{ old('name') }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Mô tả</label>
                <textarea class="form-control" name="description" rows="5">{{ old('description') }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label>Loại</label>
                <select class="form-control" name="type">
                    <option value="-1">Chọn</option>
                    @foreach($arrCategoryType as $option => $value)
                        <option value="{{ $value }}">
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary mb-3" type="submit">Thêm</button>
        </form>
    </div>
@endsection
