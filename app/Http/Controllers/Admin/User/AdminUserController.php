<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use App\Models\User\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\User\AdminUserRequest;
use App\Models\User\Permission;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminUsers = User::where('user_type', 1)->latest()->paginate(10);
        return view('admin.user.admin-user.index', compact('adminUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.admin-user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\User\AdminUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('profile_photo_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'admin-user');
            $result = $imageService->save($request->file('profile_photo_path'));
            if ($result === false) {
                return back()->with('toastr-error', 'آپلود آواتار با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }
        $inputs['password'] = Hash::make($request->input('password'));
        $inputs['user_type'] = 1;
        $inputs['status'] = 1;
        $adminUser = User::create($inputs);
        return redirect()->route('admin.users.admin-users.index')->with('toastr-success', 'ادمین با موفقیت ایجاد شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        return view('admin.user.admin-user.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\User\AdminUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserRequest $request, User $admin, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->has('avatar_remove')) {
            if ($request->input('avatar_remove') == 1) {
                $imageService->deleteImage($admin->profile_photo_path);
                $inputs['avatar_remove'] = null;
            }
            unset($inputs['avatar_remove']);
        }

        if ($request->hasFile('profile_photo_path')) {
            if (!empty($admin->profile_photo_path)) {
                $imageService->deleteImage($admin->profile_photo_path);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'admin-user');
            $result = $imageService->save($request->file('profile_photo_path'));
            if ($result === false) {
                return back()->with('toastr-error', 'آپلود آواتار با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }
        $admin->update($inputs);
        return redirect()->route('admin.users.admin-users.index')->with('toastr-success', 'ویرایش ادمین با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin, ImageService $imageService)
    {
        if (!empty($admin->profile_photo_path)) {
            $imageService->deleteImage($admin->profile_photo_path);
        }
        $admin->forceDelete();
        return back();
    }

    public function changeStatus(User $admin)
    {
        $admin->status = $admin->status === 0 ? 1 : 0;
        $result = $admin->save();
        if ($result) {
            if ($admin->status === 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function changeActivation(User $admin)
    {
        $admin->activation = $admin->activation === 0 ? 1 : 0;
        $result = $admin->save();
        if ($result) {
            if ($admin->activation === 0) {
                return response()->json(['activation' => true, 'checked' => false]);
            } else {
                return response()->json(['activation' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['activation' => false]);
        }
    }

    public function roles(User $admin)
    {
        $roles = Role::all();
        return view('admin.user.admin-user.roles', compact('roles', 'admin'));
    }

    public function rolesStore(Request $request, User $admin)
    {
        $validated = $request->validate([
            'roles' => 'required|exists:roles,id|array'
        ]);
        $admin->roles()->sync($request->roles);
        return redirect()->route('admin.users.admin-users.index')->with('toastr-success', 'ویرایش نقش با موفقیت انجام شد');
    }

    public function permissions(User $admin)
    {
        $permissions = Permission::all();
        return view('admin.user.admin-user.permissions', compact('admin', 'permissions'));
    }

    public function permissionsStore(Request $request, User $admin)
    {
        $validated = $request->validate([
            'permissions' => 'required|exists:permissions,id|array'
        ]);
        $admin->permissions()->sync($request->permissions);
        return redirect()->route('admin.users.admin-users.index')->with('toastr-success', 'ویرایش سطح دسترسی با موفقیت انجام شد');
    }
}
