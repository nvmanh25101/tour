<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdminType;
use App\Enums\OrderPaymentEnum;
use App\Enums\OrderPaymentStatusEnum;
use App\Enums\OrderStatusEnum;
use App\Enums\VoucherApplyTypeEnum;
use App\Enums\VoucherStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Appointment\UpdateRequest;
use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Time;
use App\Models\Voucher;
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
        return DataTables::of(Appointment::query())
            ->editColumn('payment_method', function ($object) {
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

    public function edit($appointmentId)
    {
        $employees = Admin::query()->where('role', '=', AdminType::DICH_VU)
            ->get(['id', 'name']);
        $appointment = Appointment::query()->with('service', 'service.category')->findOrFail($appointmentId);
        $times = Time::query()->get();

        $vouchers = Voucher::query()->where('status', '=', VoucherStatusEnum::HOAT_DONG)
            ->where('applicable_type', VoucherApplyTypeEnum::DICH_VU)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->where('uses_per_voucher', '>', 0)
            ->get();

        return view(
            'admin.appointments.edit',
            [
                'appointment' => $appointment,
                'employees' => $employees,
                'times' => $times,
                'vouchers' => $vouchers,
            ]
        );
    }

    public function update(UpdateRequest $request, $appointmentId)
    {
        $appointment = Appointment::query()->findOrFail($appointmentId);
        $appointment->fill($request->validated());

        if ($appointment->save()) {
            return redirect()->route('admin.appointments.index')->with(['success' => 'Cập nhật thành công']);
        }
        return redirect()->back()->withErrors('message', 'Cập nhật thất bại');
    }

}
