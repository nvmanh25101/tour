@extends('customer.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/customer/product_base.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/customer/products.css') }}" type="text/css">
@endpush
@section('carousel')
    <div class="text-center text-white d-flex align-items-center position-relative page-header"
         style="background-image: url(https://laspas.vn/ma-may/wp-content/uploads/sites/5/2018/09/banner_demo.jpg);">
        <div class="m-auto">
            <h1 class="font-family-secondary h2 text-uppercase text-center mt-2 mb-3 page-title">
                Sản phẩm
            </h1>
        </div>
    </div>
@endsection
@section('content')
    <div class="shop-top">
        <div class="shop-element left">
            <ul class="js-filter">
                <li class="filter filter-static hidden-xs hidden-sm">
                    <span href="">Lọc danh mục</span>
                    <div class="dropdown-menu fullw">
                        <div class="col-md-15 col-lg-15 widget-filter filter-cate">
                            <ul>
                                <li>
                                    <a href="{{ route('customers.products') }}"
                                       @if(!request()->get('category'))
                                           class="active"
                                        @endif
                                    >Tất cả</a>
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('customers.products', ['category' => $category]) }}"
                                           @if($category->id == request()->get('category'))
                                               class="active"
                                            @endif
                                        >{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="product-collection-grid product-grid bd-bottom">
        <div class="row engoc-row-equal">
            @if($products->count() === 0)
                <div class="text-center">
                    <span class="fs-2">Không có sản phẩm nào</span>
                </div>
            @endif
            @foreach($products as $product)
                <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 product-item">
                    <div class="product-img">
                        <a href="{{ route('customers.product', $product) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" class="img-responsive">
                        </a>
                    </div>
                    <div class="product-info text-center">
                        <h3 class="product-title">
                            <a href="">{{ $product->name }}</a>
                        </h3>
                        <div class="product-price">
                            <span>{{ $product->price_format }}VNĐ</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $products->links() }}
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main_product.js') }}"></script>
@endpush
