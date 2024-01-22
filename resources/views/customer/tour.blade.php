@php use Carbon\Carbon; @endphp
@extends('customer.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/customer/product_base.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/customer/tours.css') }}" type="text/css">
@endpush
@section('carousel')
    <div class="text-center text-white d-flex align-items-center position-relative page-header"
         style="background-image: url(https://laspas.vn/ma-may/wp-content/uploads/sites/5/2018/08/slide-1.jpg);">
        <div class="m-auto">
            <h1 class="font-family-secondary h2 text-uppercase text-center mt-2 mb-3 page-title">
                Tour
            </h1>
        </div>
    </div>
@endsection
@section('content')
    <div class="single-product-detail v3">
        <div class="row">
            <div class="row">
                <div class="col-8">
                    <div class="product-img-slide">
                        <div class="product-images">
                            <img
                                src="{{ asset('storage/' . $tour->image) }}" alt="photo"
                                class="img-responsive">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <a href="{{ route('reservations.booking', $tour) }}" class="btn btn-primary">Đặt tour</a>
                </div>
            </div>

            <div class="col-12">
                @include('customer.layouts.errors')
                <p>{!! nl2br($tour->description) !!}--}}</p>
                <h3 class="product-title"><a href="#">{{ $tour->name  }}</a></h3>
                <div class="flex product-rating">
                    <div class="number-rating">( {{ $reviews->count() }} đánh giá )</div>
                </div>
                @if(session('error'))
                    <div
                        class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
                        role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Lỗi - </strong> {{ session('error') }}!
                    </div>
                @endif
                <div class="accordion custom-accordion" id="custom-accordion-one">
                    <div class="card mb-4">
                        <div class="card-header panel-heading" id="headingFour">
                            <h5 class="m-0">
                                <a class="custom-accordion-title d-block py-1"
                                   data-toggle="collapse" href="#collapseFour"
                                   aria-expanded="true" aria-controls="collapseFour">
                                    Chương trình tour
                                    <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                </a>
                            </h5>
                        </div>

                        <div id="collapseFour" class="collapse show"
                             aria-labelledby="headingFour"
                             data-parent="#custom-accordion-one">
                            <div class="card-body panel-body">
                                <p>
{{--                                    {!! nl2br($tour->description) !!}--}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header panel-heading" id="headingFive">
                            <h5 class="m-0">
                                <a class="custom-accordion-title collapsed d-block py-1"
                                   data-toggle="collapse" href="#collapseFive"
                                   aria-expanded="false" aria-controls="collapseFive">
                                    Dịch vụ bao gồm
                                    <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseFive" class="collapse"
                             aria-labelledby="headingFive"
                             data-parent="#custom-accordion-one">
                            <div class="card-body  panel-body">
                                <div class="">
                                    <h5>Giá tour bao gồm</h5>
                                    <p>{!! nl2br($tour->price_include) !!}--}}</p>
                                </div>
                                <div class="">
                                    <h5>Giá tour không bao gồm</h5>
                                    <p>{!! nl2br($tour->price_exclude) !!}--}}</p>
                                </div>
                                @if($tour->price_childen)
                                    <div class="">
                                        <h5>Giá tour khi có trẻ em</h5>
                                        <p>{!! nl2br($tour->price_childen) !!}--}}</p>
                                    </div>
                                @endif
                                @if($tour->note)
                                    <div class="">
                                        Lưu ý: <br>
                                        <p>{!! nl2br($tour->note) !!}--}}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header panel-heading" id="headingSix">
                            <h5 class="m-0">
                                <a class="custom-accordion-title collapsed d-block py-1"
                                   data-toggle="collapse" href="#collapseSix"
                                   aria-expanded="false" aria-controls="collapseSix">
                                    Đánh giá @if($reviews->count() > 0)
                                        ({{ $reviews->count() }})
                                    @endif
                                    <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
                             data-parent="#custom-accordion-one">
                            <div class="card-body  panel-body">
                                <ul class="review-content">
                                    @foreach($reviews as $review)
                                        <li class="element-review">
                                            <div class="flex align-items-center justify-content-between">
                                                <div class="review-left">
                                                    <p class="r-name">{{ $review->customer->name }}</p>
                                                    <p class="r-date">{{ Carbon::parse($review->reivew_at)->format('d/m/Y')}}</p>
                                                </div>
                                                <div class="group-star">
                                                    @for($i=1; $i <= 5; $i++)
                                                        @if($i < $review->rating)
                                                            <span class="star-full"><i
                                                                    class="mdi mdi-star"></i></span>
                                                        @else
                                                            <span class="star-out"><i
                                                                    class="mdi mdi-star-outline"></i></span>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                            <p class="r-desc">
                                                {{ $review->content }}
                                            </p>
                                            @if($review->reply)
                                                <hr>
                                                <p class="r-desc">
                                                    Phản hồi: {{ $review->reply }}
                                                </p>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                                @auth
                                    @if($reviews->where('customer_id', auth()->user()->id)->count() > 0)
                                        <div
                                            class="alert alert-info alert-dismissible bg-danger text-white border-0 fade show"
                                            role="alert">
                                            <strong>Thông báo - </strong> Bạn đã đánh giá tour này!
                                        </div>
                                    @elseif($order_count > 0)
                                        <form class="review-form" action="{{ route('tours.review', $tour) }}"
                                              method="post">
                                            @csrf
                                            <h3 class="review-heading">Đánh giá của bạn</h3>
                                            <div class="rate">
                                                <input type="radio" id="star5" name="rating" value="5"/>
                                                <label for="star5" title="text">5 stars</label>
                                                <input type="radio" id="star4" name="rating" value="4"/>
                                                <label for="star4" title="text">4 stars</label>
                                                <input type="radio" id="star3" name="rating" value="3"/>
                                                <label for="star3" title="text">3 stars</label>
                                                <input type="radio" id="star2" name="rating" value="2"/>
                                                <label for="star2" title="text">2 stars</label>
                                                <input type="radio" id="star1" name="rating" value="1"/>
                                                <label for="star1" title="text">1 star</label>
                                            </div>
                                            <div class="cmt-form">
                                                <div class="row">
                                                    <div class="col-xs-12 mg-bottom-30">
                                                            <textarea id="message" class="form-control"
                                                                      name="content" rows="9"
                                                                      placeholder="Đánh giá của bạn"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group text-center">
                                                    <button type="submit" class="zoa-btn">
                                                        Xác nhận
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <div
                                            class="alert alert-info alert-dismissible bg-danger text-white border-0 fade show"
                                            role="alert">
                                            <strong>Thông báo - </strong> Bạn cần mua sản phẩm này để đánh giá!
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main_product.js') }}"></script>
@endpush

