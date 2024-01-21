<?php

namespace App\Http\Controllers\Customer;

use App\Enums\Category\StatusEnum;
use App\Enums\Category\TypeEnum;
use App\Enums\ProductStatusEnum;
use App\Enums\ServiceStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tour;
use App\Models\Service;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public string $ControllerName = 'Trang chủ';

    public function __construct()
    {
        view()->share('ControllerName', $this->ControllerName);
    }

    public function index()
    {
        return view('customer.home');
    }

    public function services(Request $request)
    {
        $categories = Category::query()->where('status', '=', StatusEnum::HOAT_DONG)
            ->where('type', '=', TypeEnum::DICH_VU)
            ->get(['id', 'name']);

        if ($request->query('category')) {
            $category = Category::query()->where('id', $request->query('category'))->get();
        } else {
            $category = $categories->first();
        }

        $services = Service::query()->with('priceServices')->whereBelongsTo($category)->where('status', '=',
            ServiceStatusEnum::HOAT_DONG)->get();

        return view('customer.services', [
            'categories' => $categories,
            'services' => $services
        ]);
    }

    public function products(Request $request)
    {
        $category_filter = $request->query('category');
        $categories = Category::query()->where('status', '=', StatusEnum::HOAT_DONG)
            ->where('type', '=', TypeEnum::SAN_PHAM)
            ->get(['id', 'name']);

        if ($category_filter) {
            $category = Category::query()->where('id', $request->query('category'))->get();
            $products = Tour::query()->whereBelongsTo($category)->where('status', '=',
                ProductStatusEnum::HOAT_DONG)->simplePaginate(12);
        } else {
            $products = Tour::query()->where('status', '=',
                ProductStatusEnum::HOAT_DONG)->simplePaginate(12);
        }

        return view('customer.products', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function product(Request $request, $id)
    {
        $product = Tour::query()->findOrFail($id);
        $reviews = $product->reviews()->with('customer')->simplePaginate(5);

        return view('customer.product', [
            'product' => $product,
            'reviews' => $reviews
        ]);
    }
}
