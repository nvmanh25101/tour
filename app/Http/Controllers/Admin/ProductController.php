<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Category\StatusEnum;
use App\Enums\Category\TypeEnum;
use App\Enums\ProductStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Tour;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public string $ControllerName = 'Sản phẩm';

    public function __construct()
    {
        $pageTitle = Route::currentRouteAction();
        $pageTitle = explode('@', $pageTitle)[1];
        view()->share('ControllerName', $this->ControllerName);
        view()->share('pageTitle', $pageTitle);

        $arrProductStatus = ProductStatusEnum::getArrayView();
        view()->share('arrProductStatus', $arrProductStatus);
    }

    public function index()
    {
        return view('admin.products.index');
    }

    public function api()
    {
        return DataTables::of(Tour::query())
            ->addColumn('category_name', function ($object) {
                return $object->category->name;
            })
            ->addColumn('price_format', function ($object) {
                return $object->price_format;
            })
            ->editColumn('status', function ($object) {
                return ProductStatusEnum::getKeyByValue($object->status);
            })
            ->addColumn('edit', function ($object) {
                return route('admin.products.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('admin.products.destroy', $object);
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
        $product = Tour::query()->create($arr);
        if ($product) {
            return redirect()->route('admin.products.index')->with(['success' => 'Thêm mới thành công']);
        }
        return redirect()->back()->withErrors('message', 'Thêm mới thất bại');
    }

    public function create()
    {
        $categories = Category::query()->where('status', '=', StatusEnum::HOAT_DONG)
            ->where('type', '=', TypeEnum::SAN_PHAM)
            ->get(['id', 'name']);
        return view(
            'admin.products.create',
            [
                'categories' => $categories,
            ]
        );
    }

    public function edit($productId)
    {
        $categories = Category::query()->where('status', '=', StatusEnum::HOAT_DONG)
            ->where('type', '=', TypeEnum::SAN_PHAM)
            ->get(['id', 'name']);
        $product = Tour::query()->findOrFail($productId);
        $reviews = $product->reviews()->with('customer')->get();

        return view(
            'admin.products.edit',
            [
                'product' => $product,
                'categories' => $categories,
                'reviews' => $reviews,
            ]
        );
    }

    public function update(UpdateRequest $request, $productId)
    {
        $product = Tour::query()->findOrFail($productId);
        $arr = $request->validated();
        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $path = Storage::disk('public')->putFile('images', $request->file('image'));
            $arr['image'] = $path;
        }
        $product->fill($arr);

        if ($product->save()) {
            return redirect()->route('admin.products.index')->with(['success' => 'Cập nhật thành công']);
        }
        return redirect()->back()->withErrors('message', 'Cập nhật thất bại');
    }

    public function destroy($productId)
    {
        if (Tour::destroy($productId)) {
            return response()->json([
                'success' => 'Xóa thành công',
            ]);
        }

        return response()->json([
            'error' => 'Xóa thất bại',
        ]);
    }
}
