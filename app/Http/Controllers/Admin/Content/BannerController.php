<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Content\Banner;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Content\BannerRequest;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::latest()->paginate(10);
        $positions = Banner::$positions;
        return view('admin.content.banner.index', compact('banners', 'positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Banner::$positions;
        return view('admin.content.banner.create', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Content\BannerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'banner');
            $result = $imageService->save($request->file('image'));
            if ($result === false) {
                return back()->with('toastr-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }
        $banner = Banner::create($inputs);
        return redirect()->route('admin.content.banners.index')->with('toastr-success', 'بنر با موفقیت ایجاد شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        $positions = Banner::$positions;
        return view('admin.content.banner.edit', compact('banner', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Content\BannerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, Banner $banner, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->has('image_remove')){
            if ($request->input('image_remove') == 1) {
                $imageService->deleteImage($banner->image);
                $inputs['image'] = null;
            }
            unset($inputs['image_remove']);
        }

        if ($request->hasFile('image')) {
                if (!empty($banner->image)){
                    $imageService->deleteImage($banner->image);
                }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'banner');
            $result = $imageService->save($request->file('image'));
            if ($result === false) {
                return back()->with('toastr-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
            unset($inputs['image_remove']);
        }
        $banner = $banner->update($inputs);
        return redirect()->route('admin.content.banners.index')->with('toastr-success', 'ویرایش بنر با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return back();
    }

    public function changeStatus(Banner $banner)
    {
        $banner->status = $banner->status === 0 ? 1 : 0;
        $result = $banner->save();
        if ($result) {
            if ($banner->status === 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
