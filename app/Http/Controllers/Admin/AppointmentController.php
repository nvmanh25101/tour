<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdminType;
use App\Enums\AppointmentStatusEnum;
use App\Enums\VoucherApplyTypeEnum;
use App\Enums\VoucherStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Appoinment\StoreRequest;
use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Time;
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
            ->addColumn('destroy', function ($object) {
                return route('admin.appointments.destroy', $object);
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

    public function store(StoreRequest $request)
    {
       

        $service = Service::query()->create($request->validated());
        if ($service) {
            $service->priceServices()->createMany($duration_price);
            return redirect()->route('admin.appointments.index')->with(['success' => 'Thêm mới thành công']);
        }
        return redirect()->back()->withErrors('message', 'Thêm mới thất bại');
    }

    public function create()
    {
        $categories = Category::query()->where('status', '=', StatusEnum::HOAT_DONG)
            ->where('type', '=', TypeEnum::DICH_VU)
            ->get(['id', 'name']);
        return view(
            'admin.appointments.create',
            [
                'categories' => $categories,
            ]
        );
    }


    public function update(UpdateRequest $request, $serviceId)
    {
        $duration_price = getDurationPrice($request);
        $price_id = $request->validated()['price_id'];
        unset($request->validated()['price_id']);
        $price_data = array_map(function ($id, $duration_price) {
            return [
                "id" => $id,
                "duration_price" => $duration_price,
            ];
        }, $price_id, $duration_price);


        $service = Service::query()->findOrFail($serviceId);
        $service->fill($request->validated());

        if ($service->save()) {
            foreach ($price_data as $item) {
                if ($item['id'] === '-1') {
                    $service->priceServices()->create($item['duration_price']);
                    continue;
                }
                $price = $service->priceServices()->whereId($item['id'])->first();
                $price->duration = $item['duration_price']['duration'];
                $price->price = $item['duration_price']['price'];
                $price->push();
            }
            return redirect()->route('admin.appointments.index')->with(['success' => 'Cập nhật thành công']);
        }
        return redirect()->back()->withErrors('message', 'Cập nhật thất bại');
    }

    public function destroy($serviceId)
    {
        if (Service::destroy($serviceId)) {
            return response()->json([
                'success' => 'Xóa thành công',
            ]);
        }

        return response()->json([
            'error' => 'Xóa thất bại',
        ]);
    }
}
