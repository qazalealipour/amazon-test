<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketCategoryRequest;
use App\Models\Ticket\TicketCategory;

class TicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticketCategories = TicketCategory::orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.ticket.category.index', compact('ticketCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ticket.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Ticket\TicketCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketCategoryRequest $request)
    {
        $inputs = $request->all();
        $ticketCategory = TicketCategory::create($inputs);
        return redirect()->route('admin.tickets.categories.index')->with('toastr-success', 'دسته بندی با موفقیت ایجاد شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketCategory $category)
    {
        return view('admin.ticket.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Ticket\TicketCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TicketCategoryRequest $request, TicketCategory $category)
    {
        $inputs = $request->all();
        $category->update($inputs);
        return redirect()->route('admin.tickets.categories.index')->with('toastr-success', 'ویرایش دسته بندی با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketCategory $category)
    {
        $category->delete();
        return back();
    }

    public function changeStatus(TicketCategory $category)
    {
        $category->status = $category->status === 0 ? 1 : 0;
        $result = $category->save();
        if ($result) {
            if ($category->status === 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
