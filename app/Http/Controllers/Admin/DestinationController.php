<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Destination\StoreRequest;
use App\Models\Destination;
use Illuminate\Support\Facades\Route;

class DestinationController extends Controller
{
    public string $ControllerName = 'Địa điểm';

    public function __construct()
    {
        $pageTitle = Route::currentRouteAction();
        $pageTitle = explode('@', $pageTitle)[1];
        view()->share('ControllerName', $this->ControllerName);
        view()->share('pageTitle', $pageTitle);
    }

    public function index()
    {
        $destinations = Destination::query()->get();
        return view('admin.destinations.index', [
            'destinations' => $destinations,
        ]);
    }
    public function create()
    {
        return view('admin.destinations.create');
    }

    public function store(StoreRequest $request)
    {
        if (Destination::query()->create($request->validated())) {
            return redirect()->route('admin.destinations.index')->with('success', 'Thêm mới thành công');
        }

        return redirect()->back()->with('error', 'Thêm mới thất bại');
    }
    public function edit($id)
    {
        $destination = Destination::query()->findOrFail($id);
        return view('admin.destinations.edit', [
            'destination' => $destination,
        ]);
    }

    public function update(StoreRequest $request, $id)
    {
        $destination = Destination::query()->findOrFail($id);
        $destination->fill($request->validated());
        if ($destination->save()) {
            return redirect()->route('admin.destinations.index')->with('success', 'Cập nhật thành công');
        }

        return redirect()->back()->with('error', 'Cập nhật thất bại');
    }
    public function destroy($destinationId)
    {
        $tours = Destination::query()->findOrFail($destinationId)->tours;
        if (!$tours->isEmpty()) {
            return response()->json([
                'message' => 'Không thể xóa điểm đến này',
            ]);
        }

        Destination::destroy($destinationId);

        return response()->json([
            'message' => 'Xóa thành công',
        ]);
    }
}
