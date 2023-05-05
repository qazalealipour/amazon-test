<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Profile\EditProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('customer.profile.profile', compact('user'));
    }

    public function editProfile(EditProfileRequest $request)
    {
        $inputs = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'national_code' => $request->national_code,
        ];
        $user = auth()->user();
        $user->update($inputs);
        return redirect()->route('customer.profile.profile')->with('success', 'حساب کاربری با موفقیت ویرایش شد');
    }
}
