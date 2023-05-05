<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\GuaranteeRequest;
use App\Models\Market\Guarantee;

class GuaranteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return view('admin.market.guarantee.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('admin.market.guarantee.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Market\GuaranteeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuaranteeRequest $request, Product $product)
    {
        $inputs = $request->all();
        $inputs['product_id'] = $product->id;
        $guarantee = Guarantee::create($inputs);
        return redirect()->route('admin.market.products.guarantees.index', [$product->id])->with('toastr-success', 'گارانتی با موفقیت ایجاد شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Guarantee $guarantee)
    {
        $guarantee->delete();
        return redirect()->route('admin.market.products.guarantees.index', [$product->id]);
    }
}
