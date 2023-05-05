<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Gallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return view('admin.market.gallery.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('admin.market.gallery.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product, ImageService $imageService)
    {
        $validatedData = $request->validate([
            'image_path' => 'required|image|mimes:png,jpg,jpeg,gif',
        ]);
        $inputs = $request->all();
        if ($request->hasFile('image_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-gallery');
            $result = $imageService->createIndexAndSave($request->file('image_path'));
            if ($result === false) {
                return back()->with('toastr-error', 'آپلود عکس با خطا مواجه شد');
            }
            $inputs['image_path'] = $result;
        }
        $inputs['product_id'] = $product->id;
        $gallery = Gallery::create($inputs);
        return redirect()->route('admin.market.products.gallery.index', [$product->id])->with('toastr-success', 'عکس با موفقیت به گالری اضافه شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Gallery $image)
    {
        $image->delete();
        return redirect()->route('admin.market.products.gallery.index', [$product->id]);
    }
}
