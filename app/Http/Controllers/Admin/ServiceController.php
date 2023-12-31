<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Category\TypeEnum;
use App\Enums\ServiceStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Service\StoreRequest;
use App\Http\Requests\Admin\Service\UpdateRequest;
use App\Models\Admin;
use App\Models\Category;
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

        $arrServiceStatus = ServiceStatusEnum::getArrayView();
        view()->share('arrServiceStatus', $arrServiceStatus);
    }

    public function index()
    {
        return view('admin.services.index');
    }

    public function api()
    {
        return DataTables::of(Service::query())
            ->addColumn('category_name', function ($object) {
                return $object->category->name;
            })
            ->editColumn('status', function ($object) {
                return ServiceStatusEnum::getKeyByValue($object->status);
            })
            ->addColumn('edit', function ($object) {
                return route('admin.services.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('admin.services.destroy', $object);
            })
            ->filterColumn('status', function ($query, $keyword) {
                if ($keyword !== '-1') {
                    $query->where('status', $keyword);
                }
            })
            ->filterColumn('category_name', function ($query, $keyword) {
                $query->whereHas('category', function ($query) use ($keyword) {
                    $query->where('id', $keyword);
                });
            })
            ->make(true);
    }

    public function store(StoreRequest $request)
    {
        if (Service::query()->create($request->validated())) {
            return redirect()->route('admin.services.index')->with(['success' => 'Thêm mới thành công']);
        }
        return redirect()->back()->withErrors('message', 'Thêm mới thất bại');
    }

    public function create()
    {
        $categories = Category::query()->where('status', '=', ServiceStatusEnum::HOAT_DONG)
            ->where('type', '=', TypeEnum::DICH_VU)
            ->get(['id', 'name']);
        return view(
            'admin.services.create',
            [
                'categories' => $categories,
            ]
        );
    }

    public function show(admin $admin)
    {
        //
    }

    public function edit($serviceId)
    {
        $categories = Category::query()->where('status', '=', ServiceStatusEnum::HOAT_DONG)
            ->where('type', '=', TypeEnum::DICH_VU)
            ->get(['id', 'name']);
        $service = Service::query()->findOrFail($serviceId);

        return view(
            'admin.services.edit',
            [
                'service' => $service,
                'categories' => $categories,
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
        Service::destroy($serviceId);

        return response()->json([
            'success' => 'Xóa thành công',
        ]);
    }
}
