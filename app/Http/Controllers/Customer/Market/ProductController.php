<?php

namespace App\Http\Controllers\Customer\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function product(Product $product)
    {
        $relatedProducts = Product::all();
        return view('customer.market..product.product', compact('product', 'relatedProducts'));
    }

    public function addComment(Request $request, Product $product)
    {
        $request->validate([
            'body' => 'required|min:2'
        ]);
        $inputs['body'] = str_replace(PHP_EOL, '</br>', $request->body);
        $inputs['author_id'] = Auth::user()->id;
        $inputs['commentable_id'] = $product->id;
        $inputs['commentable_type'] = Product::class;
        Comment::create($inputs);
        return back();
    }

    public function addToFavorites(Product $product)
    {
        if (Auth::check()){
            $product->users()->toggle([Auth::user()->id]);
            if ($product->users->contains(Auth::user()->id)){
                return response()->json(['status' => 1]);
            }
            else{
                return response()->json(['status' => 2]);
            }
        }
        else{
            return response()->json(['status' => 3]);
        }
    }
}
