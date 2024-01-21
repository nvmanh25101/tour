@php use Carbon\Carbon; @endphp
@extends('customer.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/customer/product_base.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/customer/products.css') }}" type="text/css">
@endpush
@section('content')
    <div class="single-product-detail v3">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 zoa-width1">
                <div class="product-img-slide">
                    <div class="product-images">
                        <div class="main-img js-product-slider-normal slick-initialized slick-slider">
                            <div aria-live="polite" class="slick-list draggable">
                                <div class="slick-track"
                                     style="opacity: 1; width: 4970px; transform: translate3d(-710px, 0px, 0px);"
                                     role="listbox">
                                    <a href="#" class="hover-images effect slick-slide slick-cloned"
                                       data-slick-index="-1" aria-hidden="true" style="width: 710px;" tabindex="-1"><img
                                            src="" alt="photo" class="img-responsive"></a>
                                    <a href="#" class="hover-images effect slick-slide slick-current slick-active"
                                       data-slick-index="0" aria-hidden="true"
                                       style="width: 710px;" tabindex="-1" role="option">
                                        <img
                                            src="{{ asset('storage/' . $product->image) }}" alt="photo"
                                            class="img-responsive">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 zoa-width2">
                <div class="single-product-info product-info product-grid-v2">
                    <h3 class="product-title"><a href="#">{{ $product->name  }}</a></h3>
                    <div class="product-price">
                        <span>{{ $product->price_format }}VNĐ</span>
                    </div>
                    <div class="flex product-rating">
                        <div class="number-rating">( {{ $reviews->count() }} đánh giá )</div>
                    </div>
                    @include('customer.layouts.errors')
                    @if($product->quantity < 20)
                        <div class="product-countdown text-center">
                            <h3>GẤP! CHỈ CÒN <span>{{ $product->quantity }}</span> SẢN PHẨM TRONG KHO.</h3>
                        </div>
                    @endif
                    <div class="single-product-button-group">
                        <form action="{{ route('cart.store') }}" method="post"
                              class="flex align-items-center element-button">
                            @csrf
                            <div class="zoa-qtt">
                                <button type="button" class="quantity-left-minus btn btn-number js-minus"
                                        data-type="minus" data-field="">
                                    <i class="mdi mdi-minus"></i>
                                </button>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="text" name="quantity" value="1"
                                       class="product_quantity_number js-number form-control">
                                <button type="button" class="quantity-right-plus btn btn-number js-plus"
                                        data-type="plus" data-field="">
                                    <i class="mdi mdi-plus"></i>
                                </button>
                            </div>
                            <button class="zoa-btn zoa-addcart">
                                Thêm vào giỏ
                            </button>
                        </form>
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
                                        MÔ TẢ
                                        <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                    </a>
                                </h5>
                            </div>

                            <div id="collapseFour" class="collapse show"
                                 aria-labelledby="headingFour"
                                 data-parent="#custom-accordion-one">
                                <div class="card-body panel-body">
                                    <p>
                                        {!! nl2br($product->description) !!}
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
                                        Chi tiết vận chuyển
                                        <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseFive" class="collapse"
                                 aria-labelledby="headingFive"
                                 data-parent="#custom-accordion-one">
                                <div class="card-body  panel-body">
                                    <p>Miễn phí vận chuyển</p>
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
                                                <strong>Thông báo - </strong> Bạn đã đánh giá sản phẩm này!
                                            </div>
                                        @elseif($order_count > 0)
                                            <form class="review-form" action="{{ route('products.review', $product) }}"
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
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main_product.js') }}"></script>
@endpush

