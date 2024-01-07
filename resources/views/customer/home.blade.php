@extends('customer.layouts.master')
@push('css')
    <link href="{{ asset('css/customer/home.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('carousel')
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item">
                <img class="d-block img-fluid" src="{{ asset('storage/slider/1.jpg') }}" alt="First slide">
            </div>
            <div class="carousel-item active">
                <img class="d-block img-fluid" src="{{ asset('storage/slider/2.jpg') }}" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" src="{{ asset('storage/slider/3.jpg') }}" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
@endsection
@section('content')
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
