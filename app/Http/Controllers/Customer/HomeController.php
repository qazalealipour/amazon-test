<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $slideShowImages = Banner::where('position', '=', 0)->where('status', 1)->latest()->take(6)->get();
        $topBanners = Banner::where('position', '=', 1)->where('status', 1)->latest()->take(2)->get();
        $middleBanners = Banner::where('position', '=', 2)->where('status', 1)->latest()->take(2)->get();
        $bottomBanner = Banner::where('position', '=', 3)->where('status', 1)->latest()->first();

        $brands = Brand::where('status', 1)->get();
        $mostVisitedProducts = Product::where('status', 1)->latest()->take(10)->get();
        $offerProducts = Product::where('status', 1)->latest()->take(10)->get();
        return view('customer.home', compact('slideShowImages', 'topBanners', 'middleBanners', 'bottomBanner', 'brands', 'mostVisitedProducts', 'offerProducts'));
    }

    public function products(Request $request)
    {
        //get brands
        $brands = Brand::all();

        //switch for set sort for filtering
        switch ($request->sort) {
            case "1":
                $column = "created_at";
                $direction = "DESC";
                break;
            case "2":
                $column = "price";
                $direction = "DESC";
                break;
            case "3":
                $column = "price";
                $direction = "ASC";
                break;
            case "4":
                $column = "view";
                $direction = "DESC";
                break;
            case "5":
                $column = "sold_number";
                $direction = "DESC";
                break;
            default:
                $column = "created_at";
                $direction = "ASC";
        }
        if ($request->search) {
            $query = Product::where('name', 'LIKE', "%" . $request->search . "%")->orderBy($column, $direction);
        } else {
            $query = Product::orderBy($column, $direction);
        }
        $products = $request->max_price && $request->min_price ? $query->whereBetween('price', [$request->min_price, $request->max_price]) :
        $query->when($request->min_price, function ($query) use ($request) {
            $query->where('price', '>=', $request->min_price)->paginate(15);
        })->when($request->max_price, function ($query) use ($request) {
            $query->where('price', '<=', $request->max_price)->paginate(15);
        })->when(!($request->min_price && $request->max_price), function ($query) {
            $query->paginate(15);
        });
        $products = $products->when($request->brands, function () use ($request, $products) {
            $products->whereIn('brand_id', $request->brands);
        });
        $products = $products->when($request->product_category, function () use ($request, $products) {
            $products->where('category_id', $request->product_category);
        });
        $products = $products->paginate(15);
        $products->appends($request->query());

        //get selected brands
        $selectedBrandsArray = [];
        if ($request->brands) {
            $selectedBrands = Brand::find($request->brands);
            foreach ($selectedBrands as $selectedBrand) {
                array_push($selectedBrandsArray, $selectedBrand->original_name);
            }
        }
        $category = null;
        if ($request->product_category) {
            $category = ProductCategory::find($request->product_category);
        }
        return view('customer.market.product.products', compact('products', 'brands', 'selectedBrandsArray', 'category'));
    }

    public function categoryProducts(ProductCategory $category, Request $request)
    {
        //get brands
        $brands = Brand::all();

        //switch for set sort for filtering
        switch ($request->sort) {
            case "1":
                $column = "created_at";
                $direction = "DESC";
                break;
            case "2":
                $column = "price";
                $direction = "DESC";
                break;
            case "3":
                $column = "price";
                $direction = "ASC";
                break;
            case "4":
                $column = "view";
                $direction = "DESC";
                break;
            case "5":
                $column = "sold_number";
                $direction = "DESC";
                break;
            default:
                $column = "created_at";
                $direction = "ASC";
        }
        if ($request->search) {
            $query = Product::where('name', 'LIKE', "%" . $request->search . "%")->where('category_id', $category->id)->orderBy($column, $direction);
        } else {
            $query = Product::where('category_id', $category->id)->orderBy($column, $direction);
        }
        $products = $request->max_price && $request->min_price ? $query->whereBetween('price', [$request->min_price, $request->max_price]) :
        $query->when($request->min_price, function ($query) use ($request) {
            $query->where('price', '>=', $request->min_price)->paginate(15);
        })->when($request->max_price, function ($query) use ($request) {
            $query->where('price', '<=', $request->max_price)->paginate(15);
        })->when(!($request->min_price && $request->max_price), function ($query) {
            $query->paginate(15);
        });
        $products = $products->when($request->brands, function () use ($request, $products) {
            $products->whereIn('brand_id', $request->brands);
        });
        $products = $products->paginate(15);
        $products->appends($request->query());

        //get selected brands
        $selectedBrandsArray = [];
        if ($request->brands) {
            $selectedBrands = Brand::find($request->brands);
            foreach ($selectedBrands as $selectedBrand) {
                array_push($selectedBrandsArray, $selectedBrand->original_name);
            }
        }
        return view('customer.market.product.category-products', compact('products', 'brands', 'selectedBrandsArray', 'category'));
    }

    public function showAll(Request $request)
    {
        //get brands
        $brands = Brand::all();

        //switch for set sort for filtering
        switch ($request->sort) {
            case "1":
                $column = "created_at";
                $direction = "DESC";
                break;
            case "2":
                $column = "price";
                $direction = "DESC";
                break;
            case "3":
                $column = "price";
                $direction = "ASC";
                break;
            case "4":
                $column = "view";
                $direction = "DESC";
                break;
            case "5":
                $column = "sold_number";
                $direction = "DESC";
                break;
            default:
                $column = "created_at";
                $direction = "ASC";
        }
        if ($request->search) {
            $query = Product::where('name', 'LIKE', "%" . $request->search . "%")->orderByDesc('view')->orderBy($column, $direction);
        } else {
            $query = Product::orderBy($column, $direction)->orderByDesc('view');
        }
        $products = $request->max_price && $request->min_price ? $query->whereBetween('price', [$request->min_price, $request->max_price]) :
        $query->when($request->min_price, function ($query) use ($request) {
            $query->where('price', '>=', $request->min_price)->paginate(15);
        })->when($request->max_price, function ($query) use ($request) {
            $query->where('price', '<=', $request->max_price)->paginate(15);
        })->when(!($request->min_price && $request->max_price), function ($query) {
            $query->paginate(15);
        });
        $products = $products->when($request->brands, function () use ($request, $products) {
            $products->whereIn('brand_id', $request->brands);
        });
        $products = $products->when($request->product_category, function () use ($request, $products) {
            $products->where('category_id', $request->product_category);
        });
        $products = $products->paginate(15);
        $products->appends($request->query());

        //get selected brands
        $selectedBrandsArray = [];
        if ($request->brands) {
            $selectedBrands = Brand::find($request->brands);
            foreach ($selectedBrands as $selectedBrand) {
                array_push($selectedBrandsArray, $selectedBrand->original_name);
            }
        }
        $category = null;
        if ($request->product_category) {
            $category = ProductCategory::find($request->product_category);
        }
        return view('customer.market.product.show-all', compact('products', 'brands', 'selectedBrandsArray', 'category'));
    }
}
