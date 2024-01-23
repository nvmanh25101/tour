@extends('customer.layouts.master')
@push('css')
    <link href="{{ asset('css/customer/home.css') }}" rel="stylesheet" type="text/css">
@endpush
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
