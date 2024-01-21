@php use Carbon\Carbon; @endphp
@extends('customer.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/customer/product_base.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/customer/products.css') }}" type="text/css">
@endpush
@section('carousel')
    <div class="text-center text-white d-flex align-items-center position-relative page-header"
         style="background-image: url(https://laspas.vn/ma-may/wp-content/uploads/sites/5/2018/08/slide-1.jpg);">
        <div class="m-auto">
            <h1 class="font-family-secondary h2 text-uppercase text-center mt-2 mb-3 page-title">
                Blog
            </h1>
        </div>
    </div>
@endsection
@section('content')
    <div class="col-12">
        <div class="article-inner ">
            <header class="entry-header mb-4">
                <div class="entry-header-text entry-header-text-top text-center mb-4">
                    <h1 class="entry-title">{{ $blog->title }}</h1>
                    <div class="entry-divider is-divider small"></div>
                    <div class="entry-meta uppercase is-xsmall">
                        <span class="posted-on">Đã đăng vào <span
                                rel="bookmark"><time class="entry-date published"
                                                     datetime="{{ $blog->created_date }}">{{ $blog->created_date }}</time></span>
                        </span><span class="byline">bởi <span class="meta-author vcard">{{ $blog->admin->name }}</span></span>
                    </div>
                </div>
                <div class="entry-image relative text-center">
                    <img width="600" height="400"
                         src="{{ asset('storage/' . $blog->image) }}"
                         class="attachment-large size-large wp-post-image" alt=""></div>
            </header>
            <div class="entry-content single-page mb-4">
                <p>{!! nl2br($blog->content) !!}</p>

            </div>
        </div>
        @endsection
        @push('js')
            <script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/main_product.js') }}"></script>
    @endpush

