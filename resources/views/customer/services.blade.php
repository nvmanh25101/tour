@extends('customer.layouts.master')
@push('css')
    <link href="{{ asset('css/customer/services.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('carousel')
    <div class="text-center text-white d-flex align-items-center position-relative page-header"
         style="background-image: url(https://laspas.vn/ma-may/wp-content/uploads/sites/5/2018/09/banner_demo.jpg);">
        <div class="m-auto">
            <h1 class="font-family-secondary h2 text-uppercase text-center mt-2 mb-3 page-title">
                Dịch vụ của chúng tôi
            </h1>
        </div>
    </div>
@endsection
@section('content')
    <div class="border border-yellow mb-4 d-none d-sm-none d-md-none d-lg-block mt-4">
        <div class="row mx-0">
            <div class="col-3 border-right border-yellow px-0">
                <div class=" text-uppercase text-white title d-flex py-2 px-4 mb-3">Dịch vụ</div>
                <ul class="nav nav-tab flex-column">
                    @foreach($categories as $category)
                        <li class="mb-2">
                            <a class="text-uppercase service-item
                            @if($category->id == request()->get('category'))
                                active
                            @elseif($loop->first && !request()->get('category'))
                                active
                            @endif
                            "
                               href="{{ route('customers.services', ['category' => $category]) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-9 p-0">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="signature-packages">
                        <div class=" text-uppercase text-white title d-flex py-2 px-5">
                            <span>Các gói</span>
                            <span class="ml-auto">Giá (VND)</span>
                        </div>
                        <div class="py-4 px-5 services">
                            @foreach($services as $service)
                                <div class="mb-3">
                                    <div class="align-items-baseline mb-1">
                                        <div class="d-flex service-option">
                                            <strong>
                                                {{ $loop->index+1 }}. {{ $service->name }} - <span>@foreach($service->priceServices as $price)
                                                        {{ $price->duration }}'@if(!$loop->last)
                                                            /
                                                        @endif
                                                    @endforeach</span>
                                            </strong>
                                            <div class="border-bottom border-secondary flex-grow-1 mx-2"></div>
                                            <div class="price_service">
                                                <span>
                                                    @foreach($service->priceServices as $price)
                                                        {{ $price->price_display }}@if(!$loop->last)
                                                            /
                                                        @endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <p>{{ $service->description }}</p>
                                    <div class="booking">
                                        <a href="{{ route('reservations.booking', ['service' => $service]) }}">
                                            Đặt lịch
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
