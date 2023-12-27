@extends('layouts.master')
@push('css')
    <link href="{{ asset('css/home_admin.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-3">
        <a href="{{ route('academicYear.index') }}" class="dash-item">
            <i class="mdi mdi-school dash-item_icon"></i>
            <span class="dash-item_span"> Niên khóa</span>
        </a>
    </div>
    <div class="col-3">
        <a href="{{ route('faculty.index') }}" class="dash-item">
            <i class="mdi mdi-school dash-item_icon"></i>
            <span class="dash-item_span"> Khoa </span>
        </a>
    </div>
    <div class="col-3">
        <a href="{{ route('teachers.index') }}" class="dash-item">
            <i class="mdi mdi-school dash-item_icon"></i>
            <span class="dash-item_span"> Giảng viên </span>
        </a>
    </div>
    <div class="col-3">
        <a href="{{ route('major.index') }}" class="dash-item">
            <i class="mdi mdi-school dash-item_icon"></i>
            <span class="dash-item_span"> Ngành học </span>
        </a>
    </div>
    <div class="col-3">
        <a href="{{ route('classroom.index') }}" class="dash-item">
            <i class="mdi mdi-school dash-item_icon"></i>
            <span class="dash-item_span"> Lớp học </span>
        </a>
    </div>
    <div class="col-3">
        <a href="{{ route('subjects.index') }}" class="dash-item">
            <i class="mdi mdi-school dash-item_icon"></i>
            <span class="dash-item_span"> Môn học </span>
        </a>
    </div>
    <div class="col-3">
        <a href="{{ route('course.index') }}" class="dash-item">
            <i class="mdi mdi-school dash-item_icon"></i>
            <span class="dash-item_span"> Học phần </span>
        </a>
    </div>
    <div class="col-3">
        <a href="{{ route('courseDetail.index') }}" class="dash-item">
            <i class="mdi mdi-school dash-item_icon"></i>
            <span class="dash-item_span"> Xếp lịch học </span>
        </a>
    </div>
    <div class="col-3">
        <a href="{{ route('training.index') }}" class="dash-item">
            <i class="mdi mdi-school dash-item_icon"></i>
            <span class="dash-item_span"> Hệ đào tạo </span>
        </a>
    </div>
    <div class="col-3">
        <a href="{{ route('semester.index') }}" class="dash-item">
            <i class="mdi mdi-school dash-item_icon"></i>
            <span class="dash-item_span"> Học kỳ </span>
        </a>
    </div>
    <div class="col-3">
        <a href="{{ route('plan.index') }}" class="dash-item">
            <i class="mdi mdi-school dash-item_icon"></i>
            <span class="dash-item_span"> Chương trình đào tạo </span>
        </a>
    </div>
    <div class="col-3">
        <a href="{{ route('assignment.index') }}" class="dash-item">
            <i class="mdi mdi-school dash-item_icon"></i>
            <span class="dash-item_span"> Phân công giảng dạy </span>
        </a>
    </div>
@endsection
@push('js')
    @if (session('error'))
        <script>
            $.toast({
                heading: 'Thông báo',
                text: '{{ session('error') }}',
                icon: 'success',
                loader: true,
                loaderBg: 'rgba(0,0,0,0.2)',
                position: 'top-right',
                showHideTransition: 'slide',
            })
        </script>
    @endif
@endpush