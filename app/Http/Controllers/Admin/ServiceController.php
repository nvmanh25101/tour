<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Category\StatusEnum;
use App\Enums\Category\TypeEnum;
use App\Enums\ServiceStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Service\StoreRequest;
use App\Http\Requests\Admin\Service\UpdateRequest;
use App\Models\Category;
use App\Models\Price;
use App\Models\Service;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\DataTables;

class ServiceController extends Controller
{
    public string $ControllerName = 'Dịch vụ';

    public function __construct()
    {
        $pageTitle = Route::currentRouteAction();
        $pageTitle = explode('@', $pageTitle)[1];
        view()->share('ControllerName', $this->ControllerName);
        view()->share('pageTitle', $pageTitle);
    }

    public function index()
    {
        $services = Service::query()->get();
        return view('admin.services.index', [
            'services' => $services,
        ]);
    }
    public function store(StoreRequest $request)
    {
        $service = Service::query()->create($request->validated());
        if ($service) {
            return redirect()->route('admin.services.index')->with(['success' => 'Thêm mới thành công']);
        }
        return redirect()->back()->withErrors('message', 'Thêm mới thất bại');
    }

    public function create()
    {
        return view(
            'admin.services.create',
        );
    }

    public function edit($serviceId)
    {
        $service = Service::query()->findOrFail($serviceId);

        return view(
            'admin.services.edit',
            [
                'service' => $service,
            ]
        );
    }

    public function update(UpdateRequest $request, $serviceId)
    {
        $service = Service::query()->findOrFail($serviceId);
        $service->fill($request->validated());

        if ($service->save()) {
            return redirect()->route('admin.services.index')->with(['success' => 'Cập nhật thành công']);
        }
        return redirect()->back()->withErrors('message', 'Cập nhật thất bại');
    }

    public function destroy($serviceId)
    {
        $tours = Service::query()->findOrFail($serviceId)->tours;
        if (count($tours) > 0) {
            return redirect()->back()->withErrors('message', 'Không thể xóa dịch vụ này');
        }

        if (Service::destroy($serviceId)) {
            return redirect()->route('admin.services.index')->with(['success' => 'Xóa thành công']);
        }

        return redirect()->back()->withErrors('message', 'Xóa thất bại');
    }
}
