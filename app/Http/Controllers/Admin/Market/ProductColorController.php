<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductColorRequest;
use App\Models\Market\ProductColor;

class ProductColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return view('admin.market.product-color.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('admin.market.product-color.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Market\ProductColorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductColorRequest $request, Product $product)
    {
        $inputs = $request->all();
        $inputs['product_id'] = $product->id;
        $productColor = ProductColor::create($inputs);
        return redirect()->route('admin.market.products.colors.index', [$product->id])->with('toastr-success', 'رنگ کالا با موفقیت ایجاد شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, ProductColor $color)
    {
        $color->delete();
        return redirect()->route('admin.market.products.colors.index', [$product->id]);
    }
}
