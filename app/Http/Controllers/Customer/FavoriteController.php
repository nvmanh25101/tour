<?php

namespace App\Http\Controllers\Customer;

use App\Enums\Category\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Tour;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public string $ControllerName = 'Danh sách yêu thích';

    public function __construct()
    {
        view()->share('ControllerName', $this->ControllerName);

        $categories = Category::query()->where('status', '=', StatusEnum::HOAT_DONG)->get(['id', 'name']);
        view()->share('categories', $categories);
    }

    public function index()
    {
        $favorite = Favorite::query()->where('customer_id', auth()->id())->first();

        return view('customer.favorite', [
            'favorite' => $favorite,
        ]);
    }

    public function store(Request $request, $tourId)
    {
        $favorite = Favorite::query()->where('customer_id', auth()->id())->first();
        if (!$favorite) {
            $favorite = Favorite::query()->create([
                'customer_id' => auth()->id()
            ]);
        }

        $favorite->tours()->attach($tourId);

        return redirect()->route('favorite.index', [
            'favorite' => $favorite,
        ])->with([
            'success' => 'Thêm tour vào danh sách yêu thích thành công'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $favorite = Favorite::query()->findOrFail($id);

        $favorite->tours()->detach($request->get('tour_id'));

        return redirect()->route('favorite.index')->with([
            'success' => 'Xóa tour khỏi danh sách yêu thích thành công'
        ]);
    }
}
