<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Models\User\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\PermissionRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.user.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $inputs = $request->all();
        Permission::create($inputs);
        return redirect()->route('admin.users.permissions.index')->with('swal-success', 'دسترسی جدید با موفقیت ثبت شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('admin.user.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $inputs = $request->all();
        $permission->update($inputs);
        return redirect()->route('admin.users.permissions.index')->with('swal-success', 'ویرایش دسترسی جدید با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return back();
    }

    public function changeStatus(Permission $permission)
    {
        $permission->status = $permission->status === 0 ? 1 : 0;
        $result = $permission->save();
        if ($result) {
            if ($permission->status === 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
