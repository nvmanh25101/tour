@php use App\Enums\TourStatusEnum; @endphp
@extends('admin.layouts.master')
@push('css')
    <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('admin.tours.update', $tour) }}" class="needs-validation"
              id="form-edit"
              enctype="multipart/form-data"
              novalidate>
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Code</label>
                <input type="text" class="form-control" name="code" placeholder="Code"
                       value="{{ $tour->code }}" required>
            </div>

            <div class="form-group">
                <label>Tên</label>
                <input type="text" class="form-control" name="name" placeholder="Tên"
                       value="{{ $tour->name }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Mô tả</label>
                <textarea class="form-control" name="description" placeholder="Mô tả"
                          required>{{ $tour->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Ảnh</label>
                <input type="file" class="form-control-file" name="image"
                       id="image"
                       accept="image/*">
                <div class="holder">
                    <img
                        id="imgPreview"
                        src="{{ asset('storage/' . $tour->image) }}" alt="pic"/>
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Giá bao gồm</label>
                <textarea class="form-control" name="price_include" placeholder="Giá bao gồm"
                          required>{{ $tour->price_include }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label>Giá không bao gồm</label>
                <textarea class="form-control" name="price_exclude" placeholder="Giá không bao gồm"
                          required>{{ $tour->price_exclude }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label>Giá khi có trẻ em</label>
                <textarea class="form-control" name="price_children" placeholder="Giá khi có trẻ em">{{ $tour->price_children }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label>Lưu ý</label>
                <textarea class="form-control" name="note" placeholder="Lưu ý"
                          required>{{ $tour->note }}</textarea>
            </div>

            <div class="form-group">
                <label>Thời gian khởi hành</label>
                <input type="text" class="form-control" name="departure_time" placeholder="Thời gian khởi hành"
                       value="{{ $tour->departure_time }}" required>
            </div>

            <div class="form-group">
                <label>Thời lượng</label>
                <input type="text" class="form-control" name="duration" placeholder="Thời lượng"
                       value="{{ $tour->duration }}" required>
            </div>

            <div class="form-group">
                <label>Phương tiện</label>
                <select class="form-control" name="vehicle">
                    @foreach(\App\Enums\TourVehicleEnum::asArray() as $key => $value)
                        <option value="{{ $value }}"
                                @if($tour->vehicle === $value)
                                    selected
                            @endif
                        >
                            {{ \App\Enums\TourVehicleEnum::getKeyByValue($value) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Điểm đến</label>
                <select class="form-control" name="destinations[]" multiple>
                    @foreach($destinations as $destination)
                        <option value="{{ $destination->id }}"
                                @if($tour->destinations)
                                    @foreach($tour->destinations as $item)
                                        @if($item->id === $destination->id)
                                            selected
                            @endif
                            @endforeach
                                @endif
                        >
                            {{ $destination->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Dịch vụ</label>
                <select class="form-control" name="destinations[]" multiple>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}"
                                @if($tour->services)
                                    @foreach($tour->services as $item)
                                        @if($item->id === $service->id)
                                            selected
                            @endif
                            @endforeach
                                @endif
                        >
                            {{ $service->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="form-group mb-3 col-8">
                    <label>Danh mục</label>
                    <select class="form-control" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    @if($tour->category_id === $category->id)
                                        selected
                                    @endif
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group mb-3
                @if($tour->status === TourStatusEnum::HOAT_DONG)
                        d-none
                @endif
            ">
                <label>Trạng thái</label>
                @foreach($arrTourStatus as $option => $value)
                    <br>
                    <div class="d-flex align-content-center font-16">
                        <label for="status{{ $value }}">
                            <input id="status{{ $value }}" type="radio" name="status" value="{{ $value }}" class="mr-1"
                                   @if ($tour->status === $value)
                                       checked
                                    @endif
                            >
                            {{ $option }}
                        </label>
                    </div>
                @endforeach
            </div>
            <button class="btn btn-primary mb-3" type="submit">Cập nhật</button>
        </form>
    </div>
    <hr>
    <h4 class="card-title mb-4">Danh sách đánh giá</h4>
    <table class="table table-bordered table-centered mb-0">
        <thead>
        <tr>
            <th>#</th>
            <th>Khách hàng</th>
            <th>Đánh giá</th>
            <th>Bình luận</th>
            <th class="text-center">Phản hồi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reviews as $review)
            <tr>
                <td>{{ $review->id }}</td>
                <td class="table-user">
                    {{ $review->customer->name }}
                </td>
                <td>
                    @for($i=1; $i <= 5; $i++)
                        @if($i < $review->rating)
                            <span class="star-full"><i
                                        class="mdi mdi-star"></i></span>
                        @else
                            <span class="star-out"><i
                                        class="mdi mdi-star-outline"></i></span>
                        @endif
                    @endfor
                </td>
                <td>{{ $review->content }}</td>
                <td class="table-action text-center">
                    <button type='button' class='btn action-icon' data-toggle='modal'
                            data-target='#update-reiview-{{ $review->id }}'><i
                                class="mdi mdi-pencil"></i></button>
                </td>
            </tr>

            <div id="update-reiview-{{ $review->id }}" class="modal fade form-modal" tabindex="-1" role="dialog"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form
                                    action="{{ route('admin.tours.review', ['id' => $tour, 'reviewId' => $review->id]) }}"
                                    class="pl-3 pr-3" method="post"
                                    novalidate>
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="year_start">Nội dung</label>
                                    <textarea class="form-control" rows="5" name="reply">{{ $review->reply }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Phản hồi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
@endsection
@push('js')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/notify.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            let image = $("#image");
            let imgPreview = $("#imgPreview");

            if (imgPreview.attr("src") !== "") {
                $(".holder").show();
            }
            let imgURL;
            image.change(function (e) {
                $(".holder").show();
                imgURL = URL.createObjectURL(e.target.files[0]);
                imgPreview.attr("src", imgURL);
            });

            @if(session('success'))
            $.notify('{{ session('success') }}', "success");
            @endif
            @if(session('error'))
            $.notify('{{ session('error') }}', "error");
            @endif
        })
    </script>
@endpush
