<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Content\Page;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PageRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.content.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Content\PageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $inputs = $request->all();
        $page = Page::create($inputs);
        return redirect()->route('admin.content.pages.index')->with('toastr-success', 'پیج با موفقیت ایجاد شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.content.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Content\PageRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        $inputs = $request->all();
        // $inputs['slug'] = null;
        $page->update($inputs);
        return redirect()->route('admin.content.pages.index')->with('toastr-success', 'ویرایش پیج با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return back();
    }

    public function changeStatus(Page $page)
    {
        $page->status = $page->status === 0 ? 1 : 0;
        $result = $page->save();
        if ($result) {
            if ($page->status === 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
