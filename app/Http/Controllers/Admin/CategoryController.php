<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Category\StatusEnum;
use App\Enums\Category\TypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use App\Models\Tour;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public string $ControllerName = 'Danh mục';

    public function __construct()
    {
        $pageTitle = Route::currentRouteAction();
        $pageTitle = explode('@', $pageTitle)[1];
        view()->share('ControllerName', $this->ControllerName);
        view()->share('pageTitle', $pageTitle);

        $arrCategoryStatus = StatusEnum::getArrayView();
        view()->share('arrCategoryStatus', $arrCategoryStatus);
    }

    public function index()
    {
        return view('admin.categories.index');
    }

    public function api()
    {
        return DataTables::of(Category::query())
            ->editColumn('status', function ($object) {
                return StatusEnum::getKeyByValue($object->status);
            })
            ->addColumn('edit', function ($object) {
                return route('admin.categories.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('admin.categories.destroy', $object);
            })
            ->filterColumn('status', function ($query, $keyword) {
                if ($keyword !== '-1') {
                    $query->where('status', $keyword);
                }
            })
            ->make(true);
    }

    public function store(StoreRequest $request)
    {
        $path = Storage::disk('public')->putFile('categories', $request->file('image'));
        $arr = $request->validated();
        $arr['image'] = $path;
        if (Category::query()->create($arr)) {
            return redirect()->route('admin.categories.index')->with(['success' => 'Thêm mới thành công']);
        }
        return redirect()->back()->withErrors('message', 'Thêm mới thất bại');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit($categoryId)
    {
        $category = Category::query()->findOrFail($categoryId);

        return view(
            'admin.categories.edit',
            [
                'category' => $category,
            ]
        );
    }

    public function update(UpdateRequest $request, $categoryId)
    {
        $category = Category::query()->findOrFail($categoryId);

        $arr = $request->validated();
        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            $path = Storage::disk('public')->putFile('categories', $request->file('image'));
            $arr['image'] = $path;
        }
        $category->fill($arr);
        if ($category->save()) {
            return redirect()->route('admin.categories.index')->with(['success' => 'Cập nhật thành công']);
        }
        return redirect()->back()->withErrors('message', 'Cập nhật thất bại');
    }

    public function destroy($categoryId)
    {
        if (Tour::query()->where('category_id', $categoryId)->exists()) {
            return response()->json([
                'error' => 'Không thể xóa danh mục này vì có tour thuộc danh mục này',
            ]);
        }

        Category::destroy($categoryId);

        return response()->json([
            'success' => 'Xóa thành công',
        ]);
    }
}
