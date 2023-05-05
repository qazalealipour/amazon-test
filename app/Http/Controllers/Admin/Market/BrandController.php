<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Market\Brand;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Market\BrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(10);
        return view('admin.market.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.market.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Market\BrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('logo_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brand');
            $result = $imageService->save($request->file('logo_path'));
            if ($result === false) {
                return back()->with('toastr-error', 'آپلود لوگو با خطا مواجه شد');
            }
            $inputs['logo_path'] = $result;
        }
        if ($request->input('brand_id') == 4) {
            $inputs['brand_id'] = null;
        }
        $brand = Brand::create($inputs);
        return redirect()->route('admin.market.brands.index')->with('toastr-success', 'برند با موفقیت ایجاد شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.market.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Market\BrandRequest  $request
     * @param  int  Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, Brand $brand, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->has('logo_remove')){
            if ($request->input('logo_remove') == 1) {
                $imageService->deleteImage($brand->logo_path);
                $inputs['logo_path'] = null;
            }
            unset($inputs['logo_remove']);
        }

        if ($request->hasFile('logo_path')) {
            if (!empty($brand->logo_path)) {
                $imageService->deleteImage($brand->logo_path);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brand');
            $result = $imageService->save($request->file('logo_path'));
            if ($result === false) {
                return back()->with('toastr-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['logo_path'] = $result;
        }
        // $inputs['slug'] = null;
        if ($request->input('brand_id') == 4) {
            unset($inputs['brand_id']);
        }
        $brand->update($inputs);
        return redirect()->route('admin.market.brands.index')->with('toastr-success', 'ویرایش برند با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return back();
    }

    public function changeStatus(Brand $brand)
    {
        $brand->status = $brand->status === 0 ? 1 : 0;
        $result = $brand->save();
        if ($result) {
            if ($brand->status === 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
