<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\ProductCategory;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Market\ProductCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCategories = ProductCategory::latest()->paginate(15);
        return view('admin.market.category.index', compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = ProductCategory::all();
        return view('admin.market.category.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Market\ProductCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCategoryRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-category');
            $result = $imageService->createIndexAndSave($request->file('image_path'));
            if ($result === false) {
                return back()->with('toastr-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image_path'] = $result;
        }
        $productCategory = ProductCategory::create($inputs);
        return redirect()->route('admin.market.categories.index')->with('toastr-success', 'دسته بندی با موفقیت ایجاد شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $category)
    {
        $parentCategories = ProductCategory::all()->except($category->id);
        return view('admin.market.category.edit', compact('parentCategories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Market\ProductCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCategoryRequest $request, ProductCategory $category, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->has('image_remove')) {
            if ($request->input('image_remove') == 1) {
                $imageService->deleteDirectoryAndFiles($category->image_path['directory']);
                $inputs['image_path'] = null;
            }
            unset($inputs['image_remove']);
        }

        if ($request->hasFile('image_path')) {
            if (!empty($category->image_path)) {
                $imageService->deleteDirectoryAndFiles($category->image_path['directory']);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
            $result = $imageService->createIndexAndSave($request->file('image_path'));
            if ($result === false) {
                return back()->with('toastr-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image_path'] = $result;
        }
        // $inputs['slug'] = null;
        $category->update($inputs);
        return redirect()->route('admin.market.categories.index')->with('toastr-success', 'ویرایش دسته بندی با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $category)
    {
        $category->delete();
        return back();
    }

    public function changeStatus(ProductCategory $category)
    {
        $category->status = $category->status === 0 ? 1 : 0;
        $result = $category->save();
        if ($result) {
            if ($category->status === 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function showInMenu(ProductCategory $category)
    {
        $category->show_in_menu = $category->show_in_menu === 0 ? 1 : 0;
        $result = $category->save();
        if ($result) {
            if ($category->show_in_menu === 0) {
                return response()->json(['show_in_menu' => true, 'checked' => false]);
            } else {
                return response()->json(['show_in_menu' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['show_in_menu' => false]);
        }
    }
}
