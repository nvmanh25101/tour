@extends('admin.layouts.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('admin.employees.update', $admin) }}" class="needs-validation"
              id="form-edit"
              novalidate>
            @csrf
            @method('PUT')
            @include('admin.layouts.errors')
            <div class="row">
                <div class="form-group col-8">
                    <label>Họ tên</label>
                    <input type="text" class="form-control" name="name" value="{{ $admin->name }}" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $admin->email }}"
                       readonly="">
            </div>

            <div class="row">
                <div class="form-group col-8">
                    <label>Địa chỉ thường trú</label>
                    <input type="text" class="form-control" name="address" value="{{ $admin->address }}" required>
                </div>

                <div class="form-group col-4">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control" name="phone" value="{{ $admin->phone }}" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Chức vụ</label>
                <select class="form-control" name="role">
                    @foreach($arrAdminLevel as $option => $value)
                        <option value="{{ $value }}"
                                @if($admin->role === $value)
                                    selected
                            @endif
                        >
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary mb-3" type="submit">Cập nhật</button>
        </form>
    </div>
@endsection
