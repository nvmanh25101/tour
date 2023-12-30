@php use App\Enums\AdminType; @endphp
@extends('admin.layouts.master')
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('admin.employees.store') }}" class="needs-validation" novalidate>
            @csrf
            @include('admin.layouts.errors')
            <div class="form-group">
                <label>Họ tên</label>
                <input type="text" class="form-control" name="name" placeholder="Họ và tên"
                       value="{{ old('name') }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}"
                       required>
            </div>

            <div class="form-group mb-3">
                <label>Mật khẩu</label>
                <input type="password" class="form-control" name="password" placeholder="Mật khẩu"
                       value="{{ old('password') }}" required>
            </div>

            <div class="row">
                <div class="form-group col-8">
                    <label>Địa chỉ thường trú</label>
                    <input type="text" class="form-control" name="address" placeholder="Địa chỉ"
                           value="{{ old('address') }}" required>
                </div>

                <div class="form-group col-4">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control" name="phone" placeholder="Số điện thoại"
                           value="{{ old('phone') }}" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Chức vụ</label>
                <select class="form-control" name="role">
                    <option value="-1">Chọn</option>
                    @foreach($arrAdminLevel as $option => $value)
                        @if($value === AdminType::QUAN_LY)
                            @continue
                        @endif
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
