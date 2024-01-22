@extends('admin.layouts.master')
@push('css')
@endpush
@section('content')
    <div class="col-12 mt-4">
        <a id="create" class="btn btn-outline-primary" href="{{ route('admin.destinations.create') }}">Thêm mới
        </a>
    </div>
    <table class="table table-striped table-centered mb-0">
        <thead>
        <tr>
            <th>id</th>
            <th>Tên</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @foreach($destinations as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td class="table-action">
                    <a href="{{ route('admin.destinations.edit', $item) }}" class="action-icon me-4"> <i class="mdi mdi-pencil"></i></a>
                    <form action="{{ route('admin.destinations.destroy', $item) }}" method="post" class="action-icon">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="action-icon btn"><i class='mdi mdi-delete'></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
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
                            url: '{{ route('admin.destinations.store') }}',
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
