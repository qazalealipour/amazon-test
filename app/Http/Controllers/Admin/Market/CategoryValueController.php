<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\CategoryValue;
use App\Models\Market\CategoryAttribute;
use App\Http\Requests\Admin\Market\CategoryValueRequest;

class CategoryValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryAttribute $property)
    {
        return view('admin.market.property-value.index', compact('property'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryAttribute $property)
    {
        return view('admin.market.property-value.create', compact('property'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Market\CategoryValueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryValueRequest $request, CategoryAttribute $property)
    {
        $inputs = $request->all();
        $inputs['value'] = json_encode([
            'value' => $request->value,
            'price_increase' => $request->price_increase,
        ]);
        $inputs['category_attribute_id'] = $property->id;
        $categoryValue = CategoryValue::create($inputs);
        return redirect()->route('admin.market.properties.values.index', [$property->id])->with('toastr-success', 'مقدار فرم با موفقیت ایجاد شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryAttribute $property, CategoryValue $value)
    {
        return view('admin.market.property-value.edit', compact('property', 'value'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Market\CategoryValueRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryValueRequest $request, CategoryAttribute $property, CategoryValue $value)
    {
        $inputs = $request->all();
        $inputs['value'] = json_encode([
            'value' => $request->value,
            'price_increase' => $request->price_increase,
        ]);
        $value->update($inputs);
        return redirect()->route('admin.market.properties.values.index', [$property->id])->with('toastr-success', 'ویرایش مقدار فرم با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryAttribute $property, CategoryValue $value)
    {
        $value->delete();
        return redirect()->route('admin.market.properties.values.index', [$property->id]);
    }
}
