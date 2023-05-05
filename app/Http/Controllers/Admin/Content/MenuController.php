<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Content\Menu;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\MenuRequest;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.content.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentMenus = Menu::whereNull('parent_id')->orderByDesc('created_at')->get();
        return view('admin.content.menu.create', compact('parentMenus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Content\MenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $inputs = $request->all();
        $menu = Menu::create($inputs);
        return redirect()->route('admin.content.menus.index')->with('toastr-success', 'منو با موفقیت ایجاد شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $parentMenus = Menu::whereNull('parent_id')->orderByDesc('created_at')->get()->except($menu->id);
        return view('admin.content.menu.edit', compact('parentMenus', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Content\MenuRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $inputs = $request->all();
        // $inputs['slug'] = null;
        $menu->update($inputs);
        return redirect()->route('admin.content.menus.index')->with('toastr-success', 'ویرایش منو با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return back();
    }

    public function changeStatus(Menu $menu)
    {
        $menu->status = $menu->status === 0 ? 1 : 0;
        $result = $menu->save();
        if ($result) {
            if ($menu->status === 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
