<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Content\FAQ;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\FAQRequest;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = FAQ::orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.content.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Content\FAQRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FAQRequest $request)
    {
        $inputs = $request->all();
        $faq = FAQ::create($inputs);
        return redirect()->route('admin.content.faqs.index')->with('toastr-success', 'پرسش با موفقیت ایجاد شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FAQ $faq)
    {
        return view('admin.content.faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Content\FAQRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FAQRequest $request, FAQ $faq)
    {
        $inputs = $request->all();
        // $inputs['slug'] = null;
        $faq->update($inputs);
        return redirect()->route('admin.content.faqs.index')->with('toastr-success', 'ویرایش پرسش با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FAQ $faq)
    {
        $faq->delete();
        return back();
    }

    public function changeStatus(FAQ $faq)
    {
        $faq->status = $faq->status === 0 ? 1 : 0;
        $result = $faq->save();
        if ($result) {
            if ($faq->status === 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
