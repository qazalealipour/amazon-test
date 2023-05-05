<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\User\CustomerRequest;
use App\Notifications\NewUserRegistered;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = User::where('user_type', '=', 0)->orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.user.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\User\CustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('profile_photo_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'customer');
            $result = $imageService->save($request->file('profile_photo_path'));
            if ($result === false) {
                return back()->with('toastr-error', 'آپلود آواتار با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }
        $inputs['password'] = Hash::make($request->input('password'));
        $inputs['user_type'] = 0;
        $inputs['status'] = 1;
        $user = User::create($inputs);
        $details = [
            'message' => 'یک کاربر جدید در سایت ثبت نام کرد',
        ];
        $adminUser = User::find(1);
        $adminUser->notify(new NewUserRegistered($details));
        return redirect()->route('admin.users.customers.index')->with('toastr-success', 'مشتری با موفقیت ایجاد شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $customer)
    {
        return view('admin.user.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\User\CustomerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, User $customer, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->has('avatar_remove')) {
            if ($request->input('avatar_remove') == 1) {
                $imageService->deleteImage($customer->profile_photo_path);
                $inputs['avatar_remove'] = null;
            }
            unset($inputs['avatar_remove']);
        }

        if ($request->hasFile('profile_photo_path')) {
            if (!empty($customer->profile_photo_path)) {
                $imageService->deleteImage($customer->profile_photo_path);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'customer');
            $result = $imageService->save($request->file('profile_photo_path'));
            if ($result === false) {
                return back()->with('toastr-error', 'آپلود آواتار با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }
        $customer->update($inputs);
        return redirect()->route('admin.users.customers.index')->with('toastr-success', 'ویرایش مشتری با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $customer, ImageService $imageService)
    {
        if (!empty($customer->profile_photo_path)) {
            $imageService->deleteImage($customer->profile_photo_path);
        }
        $customer->forceDelete();
        return back();
    }

    public function changeStatus(User $customer)
    {
        $customer->status = $customer->status === 0 ? 1 : 0;
        $result = $customer->save();
        if ($result) {
            if ($customer->status === 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function changeActivation(User $customer)
    {
        $customer->activation = $customer->activation === 0 ? 1 : 0;
        $result = $customer->save();
        if ($result) {
            if ($customer->activation === 0) {
                return response()->json(['activation' => true, 'checked' => false]);
            } else {
                return response()->json(['activation' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['activation' => false]);
        }
    }
}
