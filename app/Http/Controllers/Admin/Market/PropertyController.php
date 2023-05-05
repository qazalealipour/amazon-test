<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\ProductCategory;
use App\Models\Market\CategoryAttribute;
use App\Http\Requests\Admin\Market\CategoryAttributeRequest;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = CategoryAttribute::latest()->paginate(10);
        return view('admin.market.property.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCategories = ProductCategory::all();
        return view('admin.market.property.create', compact('productCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Market\CategoryAttributeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryAttributeRequest $request)
    {
        $inputs = $request->all();
        $categoryAttribute = CategoryAttribute::create($inputs);
        return redirect()->route('admin.market.properties.index')->with('toastr-success', 'فرم با موفقیت ایجاد شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryAttribute $property)
    {
        $productCategories = ProductCategory::all();
        return view('admin.market.property.edit', compact('productCategories', 'property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Market\CategoryAttributeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryAttributeRequest $request, CategoryAttribute $property)
    {
        $inputs = $request->all();
        $property->update($inputs);
        return redirect()->route('admin.market.properties.index')->with('toastr-success', 'ویرایش فرم با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryAttribute $property)
    {
        $property->delete();
        return back();
    }
}
