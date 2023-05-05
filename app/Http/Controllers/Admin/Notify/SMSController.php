<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Models\Notify\SMS;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\SMSRequest;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sms = SMS::orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.notify.sms.index', compact('sms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notify.sms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Notify\SMSRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SMSRequest $request)
    {
        $inputs = $request->all();
        // Date fix 
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int) $realTimestampStart);
        $sms = SMS::create($inputs);
        return redirect()->route('admin.notify.sms.index')->with('toastr-success', 'اطلاعیه پیامکی با موفقیت ایجاد شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SMS $sms)
    {
        return view('admin.notify.sms.edit', compact('sms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Notify\SMSRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SMSRequest $request, SMS $sms)
    {
        $inputs = $request->all();
        if ($request->has('published_at')) {
            // Date fix 
            $realTimestampStart = substr($request->published_at, 0, 10);
            $inputs['published_at'] = date('Y-m-d H:i:s', (int) $realTimestampStart);
        }
        $sms->update($inputs);
        return redirect()->route('admin.notify.sms.index')->with('toastr-success', 'ویرایش اطلاعیه با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SMS $sms)
    {
        $sms->delete();
        return back();
    }

    public function changeStatus(SMS $sms)
    {
        $sms->status = $sms->status === 0 ? 1 : 0;
        $result = $sms->save();
        if ($result) {
            if ($sms->status === 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}