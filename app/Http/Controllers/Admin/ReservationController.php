<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdminType;
use App\Enums\PaymentEnum;
use App\Enums\OrderPaymentStatusEnum;
use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\UpdateRequest;
use App\Models\Admin;
use App\Models\Reservation;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\DataTables;

class ReservationController extends Controller
{
    public string $ControllerName = 'Đơn đặt tour';

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

        $arrOrderPayment = PaymentEnum::getArrayView();
        view()->share('arrOrderPayment', $arrOrderPayment);
    }

    public function index()
    {
        return view('admin.orders.index');
    }

    public function api()
    {
        return DataTables::of(Reservation::query())
            ->addColumn('order_date', function ($object) {
                return $object->order_date;
            })
            ->editColumn('payment_method', function ($object) {
                if ($object->payment_method === null) {
                    return "Chưa thanh toán";
                }
                return PaymentEnum::getKeyByValue($object->payment_method);
            })
            ->editColumn('status', function ($object) {
                return OrderStatusEnum::getKeyByValue($object->status);
            })
            ->addColumn('edit', function ($object) {
                return route('admin.reservations.edit', $object);
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

        $reservation = Reservation::query()->with('voucher')->findOrFail($orderId);

        return view(
            'admin.orders.edit',
            [
                'reservation' => $reservation,
            ]
        );
    }

    public function update(UpdateRequest $request, $orderId)
    {
        $order = Reservation::query()->findOrFail($orderId);
        $order->fill($request->validated());
        if ($order->save()) {
            return redirect()->back()->with(['success' => 'Cập nhật thành công']);
        }
        return redirect()->back()->withErrors('message', 'Cập nhật thất bại');
    }

}
