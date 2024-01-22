@extends('customer.layouts.master')
@push('css')
    <link href="{{ asset('css/customer/home.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('carousel')
    <div id="carouselExampleFade" class="carousel slide carousel-fade container" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item">
                <img class="d-block img-fluid" src="https://www.vietnambooking.com/wp-content/uploads/2023/01/tour-chao-thu-banner-09092023.png" alt="First slide">
            </div>
            <div class="carousel-item active">
                <img class="d-block img-fluid" src="https://www.vietnambooking.com/wp-content/uploads/2020/02/Tour_khách_đoàn.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" src="https://www.vietnambooking.com/wp-content/uploads/2022/12/dat-tour-mien-tay-14122022.png" alt="Third slide">
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
    <div class="row engoc-row-equal">
        @if($tours->count() === 0)
            <div class="text-center">
                <span class="fs-2">Không có tour nào</span>
            </div>
        @endif
        @foreach($tours as $tour)
                <div class="col-md-6 col-lg-3">

                    <!-- Simple card -->
                    <div class="card d-block">
                        <img class="card-img-top" src="{{ asset('storage/' . $tour->image) }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('customers.tour', $tour) }}" class="">{{ $tour->name }}</a></h5>
                            <p class="card-text"></p>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div>
        @endforeach
    </div>
    {{ $tours->links() }}
@endsection
@push('js')
@endpush
