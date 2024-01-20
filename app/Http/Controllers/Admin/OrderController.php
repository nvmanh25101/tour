<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdminType;
use App\Enums\OrderPaymentEnum;
use App\Enums\OrderPaymentStatusEnum;
use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\UpdateRequest;
use App\Models\Admin;
use App\Models\Order;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public string $ControllerName = 'Đơn hàng';

    public function __construct()
    {
        $pageTitle = Route::currentRouteAction();
        $pageTitle = explode('@', $pageTitle)[1];
        view()->share('ControllerName', $this->ControllerName);
        view()->share('pageTitle', $pageTitle);

        $arrOrderStatus = OrderStatusEnum::getArrayView();
        view()->share('arrOrderStatus', $arrOrderStatus);

        $arrOrderPaymentStatus = OrderPaymentStatusEnum::getArrayView();
        view()->share('arrOrderPaymentStatus', $arrOrderPaymentStatus);

        $arrOrderPayment = OrderPaymentEnum::getArrayView();
        view()->share('arrOrderPayment', $arrOrderPayment);
    }

    public function index()
    {
        return view('admin.orders.index');
    }

    public function api()
    {
        return DataTables::of(Order::query())
            ->addColumn('order_date', function ($object) {
                return $object->order_date;
            })
            ->editColumn('payment_method', function ($object) {
                if ($object->payment_method === null) {
                    return "Chưa thanh toán";
                }
                return OrderPaymentEnum::getKeyByValue($object->payment_method);
            })
            ->editColumn('status', function ($object) {
                return OrderStatusEnum::getKeyByValue($object->status);
            })
            ->addColumn('edit', function ($object) {
                return route('admin.orders.edit', $object);
            })
            ->filterColumn('status', function ($query, $keyword) {
                if ($keyword !== '-1') {
                    $query->where('status', $keyword);
                }
            })
            ->make(true);
    }

    public function edit($orderId)
    {
        $employees = Admin::query()->where('role', '=', AdminType::VAN_CHUYEN)
            ->get(['id', 'name']);
        $order = Order::query()->with('voucher')->findOrFail($orderId);

        return view(
            'admin.orders.edit',
            [
                'order' => $order,
                'employees' => $employees,
            ]
        );
    }

    public function update(UpdateRequest $request, $orderId)
    {
        $order = Order::query()->findOrFail($orderId);
        $order->fill($request->validated());
        if ($order->save()) {
            return redirect()->back()->with(['success' => 'Cập nhật thành công']);
        }
        return redirect()->back()->withErrors('message', 'Cập nhật thất bại');
    }

}
