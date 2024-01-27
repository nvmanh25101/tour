<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdminType;
use App\Enums\Category\StatusEnum;
use App\Enums\TourStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tour\StoreRequest;
use App\Http\Requests\Admin\Tour\UpdateRequest;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Price;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class TourController extends Controller
{
    public string $ControllerName = 'Tour';

    public function __construct()
    {
        $pageTitle = Route::currentRouteAction();
        $pageTitle = explode('@', $pageTitle)[1];
        view()->share('ControllerName', $this->ControllerName);
        view()->share('pageTitle', $pageTitle);

        $arrTourStatus = TourStatusEnum::getArrayView();
        view()->share('arrTourStatus', $arrTourStatus);
    }

    public function index()
    {
        return view('admin.tours.index');
    }

    public function api()
    {
        return DataTables::of(Tour::query())
            ->addColumn('category_name', function ($object) {
                return $object->category->name;
            })
            ->editColumn('status', function ($object) {
                return TourStatusEnum::getKeyByValue($object->status);
            })
            ->addColumn('edit', function ($object) {
                return route('admin.tours.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('admin.tours.destroy', $object);
            })
            ->addColumn('schedule', function ($object) {
                return route('admin.tours.edit_schedule', $object);
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
        $path = Storage::disk('public')->putFile('images', $request->file('image'));
        $arr = $request->validated();
        $arr['image'] = $path;
        $arr['admin_id'] = Auth::guard('admin')->user()->id;

        $tour = Tour::query()->create($arr);
        $tour->destinations()->attach($request->get('destinations'));
        $tour->services()->attach($request->get('services'));
        $age_groups = $request->validated()['age_group'];
        $prices = $request->validated()['price'];
        $result = array_map(function ($age_group, $price ) {
            return [
                'age_group' => $age_group,
                'price' => $price,
            ];
        }, $age_groups, $prices);

        foreach ($result as $item) {
            $item['tour_id'] = $tour->id;
        }

        $tour->prices()->createMany($result);

        return redirect()->route('admin.tours.index')->with(['success' => 'Thêm mới thành công']);
    }

    public function create()
    {
        $categories = Category::query()->where('status', '=', StatusEnum::HOAT_DONG)
            ->get(['id', 'name']);
        $destinations = Destination::query()->get();
        $services = Service::query()->get();
        return view(
            'admin.tours.create',
            [
                'categories' => $categories,
                'destinations' => $destinations,
                'services' => $services,
            ]
        );
    }

    public function edit($tourId)
    {
        $categories = Category::query()->where('status', '=', StatusEnum::HOAT_DONG)
            ->get(['id', 'name']);
        $tour = Tour::query()->with(['destinations', 'prices'])->findOrFail($tourId);
        $reviews = $tour->reviews()->with('customer')->get();
        $destinations = Destination::query()->get();
        $services = Service::query()->get();

        return view(
            'admin.tours.edit',
            [
                'tour' => $tour,
                'categories' => $categories,
                'reviews' => $reviews,
                'destinations' => $destinations,
                'services' => $services,
            ]
        );
    }
    public function create_schedule()
    {
        $tours = Tour::query()->get();
        return view('admin.tours.create_schedule', ['tours' => $tours]);
    }

    public function edit_schedule($tourId)
    {
        $tour = Tour::query()->findOrFail($tourId);
        $schedules = $tour->schedules()->get();

        return view(
            'admin.tours.edit_schedule',
            [
                'tour' => $tour,
                'schedules' => $schedules,
            ]
        );
    }

    public function update_price($priceIds, $prices)
    {
        $result = array_map(function ($priceId, $price ) {
            return [
                'price_id' => $priceId,
                'price' => $price,
            ];
        }, $priceIds, $prices);

        foreach ($result as $item) {
            Price::query()->where('id', $item['price_id'])->update([
                'price' => $item['price'],
            ]);
        }
    }
    public function store_schedule(Request $request)
    {
        $arr['tour_id'] = $request->get('tour_id');
        $arr['activity'] = $request->get('activity');
        $arr['day'] = $request->get('day');
        $arr['description'] = $request->get('description');
        Schedule::query()->create($arr);

        return redirect()->route('admin.tours.index')->with(['success' => 'Thêm mới thành công']);
    }

    public function update_schedule(Request $request)
    {
        $scheduleIds = $request->get('schedule_id');
        $days = $request->get('day');
        $activities = $request->get('activity');
        $descriptions = $request->get('description');

        $result = array_map(function ($scheduleId, $day, $activity, $description) {
            return [
                'schedule_id' => $scheduleId,
                'day' => $day,
                'activity' => $activity,
                'description' => $description,
            ];
        }, $scheduleIds, $days, $activities, $descriptions);

        foreach ($result as $item) {
            Schedule::query()->where('id', $item['schedule_id'])->update([
                'day' => $item['day'],
                'activity' => $item['activity'],
                'description' => $item['description'],
            ]);
        }

        return redirect()->route('admin.tours.index')->with(['success' => 'Cập nhật thành công']);
    }

    public function destroy($tourId)
    {
        tour::destroy($tourId);

        return response()->json([
            'success' => 'Xóa thành công',
        ]);
    }

    public function review(Request $request, $id, $reviewId)
    {
        $user = Auth::guard('admin')->user();
        if ($user->role !== AdminType::NHAN_VIEN) {
            return redirect()->back()->withErrors('message', 'Bạn không có quyền truy cập');
        }

        $tour = Tour::query()->findOrFail($id);
        $review = $tour->reviews()->findOrFail($reviewId);
        $review->update([
            'reply' => $request->get('reply'),
            'admin_id' => Auth::guard('admin')->user()->id,
        ]);

        return redirect()->back()->with(['success' => 'Phản hồi thành công']);
    }

    public function update(UpdateRequest $request, $tourId)
    {
        $tour = Tour::query()->findOrFail($tourId);
        $tour->destinations()->sync($request->get('destinations'));
        $tour->services()->sync($request->get('services'));
        $arr = $request->validated();
        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($tour->image)) {
                Storage::disk('public')->delete($tour->image);
            }
            $path = Storage::disk('public')->putFile('images', $request->file('image'));
            $arr['image'] = $path;
        }
        $tour->fill($arr);

        $priceIds = $request->validated()['price_id'];
        $prices = $request->validated()['price'];
        $this->update_price($priceIds, $prices);

        if ($tour->save()) {
            return redirect()->route('admin.tours.index')->with(['success' => 'Cập nhật thành công']);
        }
        return redirect()->back()->withErrors('message', 'Cập nhật thất bại');
    }

}
