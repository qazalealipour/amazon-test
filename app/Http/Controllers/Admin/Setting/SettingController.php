<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\Setting;
use Database\Seeders\SettingSeeder;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\SettingRequest;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        if ($setting === null){
            $default = new SettingSeeder();
            $default->run();
            $setting = Setting::first();
        }
        return view('admin.setting.index', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('admin.setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\SettingRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, Setting $setting, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->has('logo_remove')){
            if ($request->input('logo_remove') == 1) {
                $imageService->deleteImage($setting->logo);
                $inputs['logo'] = null;
            }
            unset($inputs['logo_remove']);
        }

        if ($request->has('icon_remove')){
            if ($request->input('icon_remove') == 1) {
                $imageService->deleteImage($setting->icon);
                $inputs['icon'] = null;
            }
            unset($inputs['icon_remove']);
        }

        if ($request->hasFile('logo')) {
            if (!empty($setting->logo)) {
                $imageService->deleteImage($setting->logo);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'setting');
            $imageService->setImageName('logo');
            $result = $imageService->save($request->file('logo'));
            if ($result === false) {
                return back()->with('toastr-error', 'آپلود لوگو با خطا مواجه شد');
            }
            $inputs['logo'] = $result;
        }

        if ($request->hasFile('icon')) {
            if (!empty($setting->icon)) {
                $imageService->deleteImage($setting->icon);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'setting');
            $imageService->setImageName('icon');
            $result = $imageService->save($request->file('icon'));
            if ($result === false) {
                return back()->with('toastr-error', 'آپلود آیکون با خطا مواجه شد');
            }
            $inputs['icon'] = $result;
        }
        $setting->update($inputs);
        return redirect()->route('admin.setting.index')->with('toastr-success', 'ویرایش تنظیمات با موفقیت انجام شد');
    }
}
