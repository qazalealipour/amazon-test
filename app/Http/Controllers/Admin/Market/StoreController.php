<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\StoreRequest;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.market.store.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addToStore(Product $product)
    {
        return view('admin.market.store.add-to-store', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Market\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Product $product)
    {
        $product->marketable_number = $request->marketable_number;
        $product->save();
        Log::info('receiver => ' . $request->receiver . ', deliverer => ' . $request->deliverer . ', description => ' . $request->description . ', marketable_number => ' . $request->marketable_number);
        return redirect()->route('admin.market.store.index')->with('toastr-success', 'افزایش موجودی با موفقیت انجام شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.market.store.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Market\StoreRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'marketable_number' => 'required|numeric',
            'frozen_number' => 'required|numeric',
            'sold_number' => 'required|numeric',
        ]);
        $inputs = $request->all();
        $product->update($inputs);
        return redirect()->route('admin.market.store.index')->with('toastr-success', 'اصلاح موجودی با موفقیت انجام شد');
    }
}
