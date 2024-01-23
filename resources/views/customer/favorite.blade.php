@extends('customer.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/customer/favorite.css') }}">
@endpush
@section('carousel')
    <div class="text-center text-white d-flex align-items-center position-relative page-header"
         style="background-image: url(https://laspas.vn/ma-may/wp-content/uploads/sites/5/2018/08/slide-1.jpg);">
        <div class="m-auto">
            <h1 class="font-family-secondary h2 text-uppercase text-center mt-2 mb-3 page-title">
                Giỏ hàng của bạn
            </h1>
        </div>
    </div>
@endsection
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-borderless table-centered mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>Tour</th>
                                    <th>Giá</th>
                                    <th style="width: 50px;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($favorite->tours as $item)
                                    <input type="hidden" name="tour_id" value="{{ $item->id }}">
                                    <tr class="product">
                                        <td>
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="contact-img"
                                                 title="contact-img" class="rounded mr-3" height="64">
                                            <p class="m-0 d-inline-block align-middle product-name">
                                                <a href="{{ route('customers.tour', $item) }}"
                                                   class="text-body">{{ $item->name }}</a>
                                            </p>
                                        </td>
                                        <td>
                                            <span class="price_unit">
                                                @foreach($item->prices as $price)
                                                    @php
                                                        $stringToCheck = $price->age_group;

                                                        $pattern = "NGƯỜI LỚN";

                                                        $startsWithPattern = str_starts_with($stringToCheck, $pattern);
                                                    @endphp
                                                    @if($startsWithPattern)
                                                        <span class="price-tour fs-5">{{ number_format($price->price) }} VND/người</span>
                                                    @endif
                                                @endforeach
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('favorite.destroy', $item->pivot->favorite_id) }}"
                                                  method="post">
                                                @method('delete')
                                                @csrf
                                                <input type="hidden" name="tour_id"
                                                       value="{{ $item->pivot->product_id }}">
                                                <button type="submit" class="action-icon btn"><i
                                                        class="mdi mdi-delete"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div
                                class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade d-none"
                                role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>Lỗi - </strong>
                            </div>
                        </div> <!-- end table-responsive-->

                        <!-- action buttons-->
                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <a href="{{ route('customers.home') }}"
                                   class="btn text-muted d-none d-sm-inline-block btn-link font-weight-semibold">
                                    <i class="mdi mdi-arrow-left"></i> Tiếp tục xem tour </a>
                            </div> <!-- end col -->

                        </div> <!-- end row-->
                    </div>
                    <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/notify.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            @if(session('success'))
            $.notify('{{ session('success') }}', "success");
            @endif
            @if(session('error'))
            $.notify('{{ session('error') }}', "error");
            @endif
        });
    </script>
@endpush

