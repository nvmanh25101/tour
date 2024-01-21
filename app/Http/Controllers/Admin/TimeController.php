<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Time\StoreRequest;
use App\Models\Destination;
use Illuminate\Support\Facades\Route;

class TimeController extends Controller
{
    public string $ControllerName = 'Khung giờ';

    public function __construct()
    {
        $pageTitle = Route::currentRouteAction();
        $pageTitle = explode('@', $pageTitle)[1];
        view()->share('ControllerName', $this->ControllerName);
        view()->share('pageTitle', $pageTitle);
    }

    public function index()
    {
        $times = Destination::query()->get();
        return view('admin.times.index', [
            'times' => $times,
        ]);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $id = $data['id'];
        unset($data['id']);
        if ($id) {
            $time_obj = Destination::query()->findOrFail($id);
            $time_obj->fill($data);
            if ($time_obj->save()) {
                return response()->json([
                    'success' => 'Cập nhật thành công',
                ]);
            }
            return response()->json([
                'error' => 'Cập nhật thất bại',
            ]);
        }
        if (Destination::query()->create($data)) {
            return response()->json([
                'success' => 'Thêm mới thành công',
            ]);
        }

        return response()->json([
            'error' => 'Thêm mới thất bại',
        ]);
    }

    public function destroy($timeId)
    {
        $appointments = Destination::query()->findOrFail($timeId)->appointments;
        if (!$appointments->isEmpty()) {
            return response()->json([
                'message' => 'Không thể xóa khung giờ này',
            ]);
        }

        Destination::destroy($timeId);

        return response()->json([
            'message' => 'Xóa thành công',
        ]);
    }
}
