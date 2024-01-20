@extends('admin.layouts.master')
@push('css')
    <link href="{{ asset('datatables/datatables.min.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="col-4 d-flex mb-1">
        <label>Trạng thái</label>
        <select class="form-control" id="select-status">
            <option value="-1">Tất cả</option>
            @foreach($arrOrderStatus as $key => $value)
                <option value="{{ $value }}">
                    {{ $key }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <table id="data-table" class="table table-striped dt-responsive nowrap w-100">
            <thead>
            <tr>
                <th>#</th>
                <th>Mã đơn</th>
                <th>Tên khách hàng</th>
                <th>SĐT</th>
                <th>Hình thức thanh toán</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày đặt</th>
                <th>Sửa</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/notify.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    {{--    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/r-2.5.0/rg-1.4.1/sc-2.3.0/sb-1.6.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>--}}

    <script>
        $(document).ready(function () {
            let table = $('#data-table').DataTable({
                dom: 'BRSlrtip',
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.orders.api') }}',
                "order": [[0, "desc"]],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'code', name: 'code'},
                    {data: 'name_receiver', name: 'name_receiver'},
                    {data: 'phone_receiver', name: 'phone_receiver'},
                    {data: 'payment_method', name: 'payment_method'},
                    {data: 'total', name: 'total'},
                    {data: 'status', name: 'status'},
                    {data: 'order_date', name: 'order_date'},
                    {
                        data: 'edit',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return `<a class="btn btn-primary" href="${data}"><i class='mdi mdi-pencil'></i></a>`;
                        }
                    },
                ]
            });

            $('#select-status').change(function () {
                let value = this.value;
                table.column(5).search(value).draw();
            });

            @if(session('success'))
            $.notify('{{ session('success') }}', "success");
            @endif
            @if(session('error'))
            $.notify('{{ session('error') }}', "error");
            @endif
        });
    </script>
@endpush
