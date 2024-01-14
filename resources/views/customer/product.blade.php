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
                        <div class="group-star">
                            <span class=""><i class="mdi mdi-star"></i></span>
                            <span class=""><i class="mdi mdi-star-outline"></i></span>
                            <span class=""><i class="mdi mdi-star-outline"></i></span>
                            <span class=""><i class="mdi mdi-star-outline"></i></span>
                            <span class=""><i class="mdi mdi-star-outline"></i></span>
                        </div>
                        <div class="number-rating">( 02 reviews )</div>
                    </div>
                    @if($product->quantity < 20)
                        <div class="product-countdown text-center">
                            <h3>GẤP! CHỈ CÒN <span>{{ $product->quantity }}</span> SẢN PHẨM TRONG KHO.</h3>
                        </div>
                    @endif
                    <div class="single-product-button-group">
                        <div class="flex align-items-center element-button">
                            <div class="zoa-qtt">
                                <button type="button" class="quantity-left-minus btn btn-number js-minus"
                                        data-type="minus" data-field="">
                                    <i class="mdi mdi-minus"></i>
                                </button>
                                <input type="text" name="number" value="1"
                                       class="product_quantity_number js-number">
                                <button type="button" class="quantity-right-plus btn btn-number js-plus"
                                        data-type="plus" data-field="">
                                    <i class="mdi mdi-plus"></i>
                                </button>
                            </div>
                            <a href="" class="zoa-btn zoa-addcart">
                                <i class="zoa-icon-cart"></i>Thêm vào giỏ
                            </a>
                        </div>
                    </div>
                    <div class="single-product-tab bd-top">
                        <div class="zoa-tab-collapse-block panel-group">
                            <div class="panel zoa-tab-item">
                                <div class="panel-heading">
                                    <h3 class="panel-title zoa-tab-title"><a href="#panelBodyOne"
                                                                             class="accordion-toggle"
                                                                             data-toggle="collapse"
                                                                             data-parent="#accordion">Mô tả</a>
                                    </h3>
                                </div>
                                <div id="panelBodyOne" class="zoa-collapse-content panel-collapse collapse in">
                                    <div class="panel-body">
                                        <p>
                                            {{ $product->description }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel zoa-tab-item">
                                <div class="panel-heading">
                                    <h3 class="panel-title zoa-tab-title">
                                        <a href="#panelBodyTwo" class="accordion-toggle" data-toggle="collapse"
                                           data-parent="#accordion">
                                            Chi tiết vận chuyển
                                        </a>
                                    </h3>
                                </div>
                                <div id="panelBodyTwo" class="zoa-collapse-content panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>
                                            Miễn phí
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel zoa-tab-item">
                                <div class="panel-heading">
                                    <h3 class="panel-title zoa-tab-title"><a href="#panelBodyThree"
                                                                             class="accordion-toggle"
                                                                             data-toggle="collapse"
                                                                             data-parent="#accordion">Đánh giá (2)</a>
                                    </h3>
                                </div>
                                <div id="panelBodyThree" class="zoa-collapse-content panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="review-content">
                                            <li class="element-review">
                                                <div class="flex align-items-center justify-content-between">
                                                    <div class="review-left">
                                                        <p class="r-name">Felix Nguyen</p>
                                                        <p class="r-date">25, March 2018</p>
                                                    </div>
                                                    <div class="group-star">
                                                        <span class="star star-5"></span>
                                                        <span class="star star-4"></span>
                                                        <span class="star star-3"></span>
                                                        <span class="star star-2"></span>
                                                        <span class="star star-1"></span>
                                                    </div>
                                                </div>
                                                <p class="r-desc">
                                                    Free shipping on orders over 150€ within Europe and North
                                                    America.
                                                </p>
                                            </li>
                                        </ul>
                                        <div class="review-form">
                                            <h3 class="review-heading">Đánh giá của bạn</h3>
                                            <div class="rating-star">
                                                <span class="fa fa-star-o" aria-hidden="true"></span>
                                                <span class="fa fa-star-o" aria-hidden="true"></span>
                                                <span class="fa fa-star-o" aria-hidden="true"></span>
                                                <span class="fa fa-star-o" aria-hidden="true"></span>
                                                <span class="fa fa-star-o" aria-hidden="true"></span>
                                            </div>
                                            <div class="cmt-form">
                                                <div class="row">
                                                    <div class="col-xs-12 mg-bottom-30">
                                                            <textarea id="message" class="form-control"
                                                                      name="comment[body]" rows="9"
                                                                      placeholder="Your reviews"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group text-center">
                                                    <button type="submit" class="zoa-btn">
                                                        Xác nhận
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
