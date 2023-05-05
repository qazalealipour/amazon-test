<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductMeta;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Market\ProductCategory;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Market\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.market.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = ProductCategory::all();
        return view('admin.market.product.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Market\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        // Date fix
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int) $realTimestampStart);
        if ($request->hasFile('image_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product');
            $result = $imageService->createIndexAndSave($request->file('image_path'));
            if ($result === false) {
                return redirect()->route('admin.market.products.index')->with('toastr-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image_path'] = $result;
        }

        DB::transaction(function () use ($request, $inputs) {
            $product = Product::create($inputs);
            $meta = array_combine($request->meta_key, $request->meta_value);
            foreach ($meta as $metaKey => $metaValue) {
                $meta = ProductMeta::create([
                    'meta_key' => $metaKey,
                    'meta_value' => $metaValue,
                    'product_id' => $product->id,
                ]);
            }
        });
        return redirect()->route('admin.market.products.index')->with('toastr-success', 'کالا با موفقیت ایجاد شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $brands = Brand::all();
        $categories = ProductCategory::all();
        return view('admin.market.product.edit', compact('brands', 'categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Market\ProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->has('published_at')) {
            // Date fix
            $realTimestampStart = substr($request->published_at, 0, 10);
            $inputs['published_at'] = date('Y-m-d H:i:s', (int) $realTimestampStart);
        }

        if ($request->has('image_remove')) {
            if ($request->input('image_remove') == 1) {
                $imageService->deleteDirectoryAndFiles($product->image_path['directory']);
                $inputs['image_path'] = null;
            }
            unset($inputs['image_remove']);
        }

        if ($request->hasFile('image_path')) {
            if (!empty($product->image_path)) {
                $imageService->deleteDirectoryAndFiles($product->image_path['directory']);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post');
            $result = $imageService->createIndexAndSave($request->file('image_path'));
            if ($result === false) {
                return back()->with('toastr-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image_path'] = $result;
            unset($inputs['image_remove']);
        }
        // $inputs['slug'] = null;
        DB::transaction(function () use ($request, $inputs, $product) {
            $product->update($inputs);
            if ($request->meta_key != null) {
                $meta_keys = $request->meta_key;
                $meta_values = $request->meta_value;
                $meta_ids = array_keys($request->meta_key);
                $meta = array_map(function ($meta_id, $meta_key, $meta_value) {
                    return array_combine(
                        ['meta_id', 'meta_key', 'meta_value'],
                        [$meta_id, $meta_key, $meta_value]
                    );
                }, $meta_ids, $meta_keys, $meta_values);
                foreach ($meta as $item) {
                    ProductMeta::where('id', $item['meta_id'])->update(
                        ['meta_key' => $item['meta_key'], 'meta_value' => $item['meta_value']]
                    );
                }
            }
        });
        return redirect()->route('admin.market.products.index')->with('toastr-success', 'ویرایش کالا با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }

    public function changeStatus(Product $product)
    {
        $product->status = $product->status === 0 ? 1 : 0;
        $result = $product->save();
        if ($result) {
            if ($product->status === 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function changeMarketable(Product $product)
    {
        $product->marketable = $product->marketable === 0 ? 1 : 0;
        $result = $product->save();
        if ($result) {
            if ($product->marketable === 0) {
                return response()->json(['marketable' => true, 'checked' => false]);
            } else {
                return response()->json(['marketable' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['marketable' => false]);
        }
    }
}
