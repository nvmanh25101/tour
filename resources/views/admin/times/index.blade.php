@extends('admin.layouts.master')
@push('css')
    <meta name="csrf_token" content="{{ csrf_token() }}"/>
    <link href="{{ asset('datetimepicker/DateTimePicker.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-12">
        <button id="create" class="btn btn-outline-primary" type="button">Thêm mới
        </button>
    </div>
    <div class="row mb-3 mt-2" id="list">
        @foreach($times as $time)
            <div class="col-2 d-flex">
                <input class="form-control" type="text" data-field="time" data-id="{{ $time->id }}"
                       value="{{ $time->time }}" readonly>
                <form action="{{ route('admin.times.destroy', $time->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn-delete btn btn-danger"><i class='mdi mdi-delete'></i></button>
                </form>
            </div>
        @endforeach
        <div id="dtBox"></div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('datetimepicker/DateTimePicker.js') }}"></script>
    <script src="{{ asset('js/notify.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    {{--    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/r-2.5.0/rg-1.4.1/sc-2.3.0/sb-1.6.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>--}}

    <script>
        const CSRF_TOKEN = document.querySelector('meta[name="csrf_token"]').getAttribute("content");

        $(document).ready(function () {
            let list = $("#list");

            $("#create").on('click', function () {
                let html = `
                    <div class="col-3">
                    <input class="form-control" type="text" data-field="time" value="" readonly>
                </div>
                `;
                list.append(html);
            });

            $("#dtBox").DateTimePicker({
                minuteInterval: 15,
                buttonClicked: function (type, oInputElement) {
                    let oDTP = this
                    let value = oDTP.getDateTimeStringInFormat()
                    if (type === 'SET') {
                        let id = oInputElement.getAttribute('data-id')
                        $.ajax({
                            url: '{{ route('admin.times.store') }}',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                _token: CSRF_TOKEN,
                                time: value,
                                id: id,
                            },
                            success: function (res) {
                                setTimeout(function () {
                                    window.location.reload();
                                }, 1000)
                                $.notify(`${res.success}`, "success")
                            },
                            error: function (res) {
                                console.log(res)
                                $.notify(res.responseJSON.errors.time[0], "error");
                            },
                        });
                    }
                }
            })

            $(document).on('click', '.btn-delete', function () {
                let form = $(this).parents('form');
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                    title: "Bạn có chắc chắn muốn xóa?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Đồng ý",
                    cancelButtonText: "Hủy",
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: form.attr('action'),
                            type: 'POST',
                            dataType: 'json',
                            data: form.serialize(),
                            success: function (res) {
                                swalWithBootstrapButtons.fire({
                                    title: "Thành công!",
                                    text: res['message'],
                                    icon: "info"
                                });
                                setTimeout(function () {
                                    window.location.reload();
                                }, 1000)
                            },
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire({
                            title: "Hủy!",
                            text: "An toàn :)",
                            icon: "error"
                        });
                    }
                });
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
