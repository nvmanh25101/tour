<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdminType;
use App\Enums\AppointmentStatusEnum;
use App\Enums\VoucherApplyTypeEnum;
use App\Enums\VoucherStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Appointment\UpdateRequest;
use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Destination;
use App\Models\Voucher;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\DataTables;

class AppointmentController extends Controller
{
    public string $ControllerName = 'Lịch đặt';

    public function __construct()
    {
        $pageTitle = Route::currentRouteAction();
        $pageTitle = explode('@', $pageTitle)[1];
        view()->share('ControllerName', $this->ControllerName);
        view()->share('pageTitle', $pageTitle);

        $arrAppointmentStatus = AppointmentStatusEnum::getArrayView();
        view()->share('arrAppointmentStatus', $arrAppointmentStatus);
    }

    public function index()
    {
        return view('admin.appointments.index');
    }

    public function api()
    {
        return DataTables::of(Appointment::query())
            ->addColumn('service_name', function ($object) {
                return $object->service->name;
            })
            ->addColumn('datetime', function ($object) {
                return $object->time->time_display.' - '.$object->date_display;
            })
            ->editColumn('status', function ($object) {
                return AppointmentStatusEnum::getKeyByValue($object->status);
            })
            ->addColumn('edit', function ($object) {
                return route('admin.appointments.edit', $object);
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
        $times = Destination::query()->get();

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
