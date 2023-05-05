<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\User;
use App\Models\Market\Coupon;
use App\Models\Market\Product;
use App\Models\Market\AmazingSale;
use App\Http\Controllers\Controller;
use App\Models\Market\CommonDiscount;
use App\Http\Requests\Admin\Market\CouponRequest;
use App\Http\Requests\Admin\Market\AmazingSaleRequest;
use App\Http\Requests\Admin\Market\CommonDiscountRequest;

class DiscountController extends Controller
{
    public function coupons()
    {
        $coupons = Coupon::orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.market.discount.coupons', compact('coupons'));
    }

    public function couponCreate()
    {
        $users = User::all();
        return view('admin.market.discount.coupon-create', compact('users'));
    }

    public function couponStore(CouponRequest $request)
    {
        $inputs = $request->all();
        // Date fix 
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int) $realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int) $realTimestampEnd);
        if ($request->type == 0) {
            $inputs['user_id'] = null;
        }
        $coupon = Coupon::create($inputs);
        return redirect()->route('admin.market.discounts.coupons.index')->with('toastr-success', 'کوپن تخفیف با موفقیت ایجاد شد');
    }

    public function couponEdit(Coupon $coupon)
    {
        $users = User::all();
        return view('admin.market.discount.coupon-edit', compact('users', 'coupon'));
    }

    public function couponUpdate(CouponRequest $request, Coupon $coupon)
    {
        $inputs = $request->all();
        // Date fix 
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int) $realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int) $realTimestampEnd);
        if ($request->type == 0) {
            $inputs['user_id'] = null;
        }
        $coupon->update($inputs);
        return redirect()->route('admin.market.discounts.coupons.index')->with('toastr-success', 'ویرایش کوپن تخفیف با موفقیت انجام شد');
    }

    public function couponDestroy(Coupon $coupon)
    {
        $coupon->delete();
        return back();
    }

    public function commonDiscounts()
    {
        $commonDiscounts = CommonDiscount::orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.market.discount.common-discounts', compact('commonDiscounts'));
    }

    public function commonDiscountCreate()
    {
        return view('admin.market.discount.common-discount-create');
    }

    public function commonDiscountStore(CommonDiscountRequest $request)
    {
        $inputs = $request->all();
        // Date fix 
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int) $realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int) $realTimestampEnd);
        $commonDiscount = CommonDiscount::create($inputs);
        return redirect()->route('admin.market.discounts.common-discounts.index')->with('toastr-success', 'تخفیف عمومی با موفقیت ایجاد شد');
    }

    public function commonDiscountEdit(CommonDiscount $commonDiscount)
    {
        return view('admin.market.discount.common-discount-edit', compact('commonDiscount'));
    }

    public function commonDiscountUpdate(CommonDiscountRequest $request, CommonDiscount $commonDiscount)
    {
        $inputs = $request->all();
        // Date fix 
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int) $realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int) $realTimestampEnd);
        $commonDiscount->update($inputs);
        return redirect()->route('admin.market.discounts.common-discounts.index')->with('toastr-success', 'ویرایش تخفیف عمومی با موفقیت انجام شد');
    }

    public function commonDiscountDestroy(CommonDiscount $commonDiscount)
    {
        $commonDiscount->delete();
        return back();
    }

    public function amazingSale()
    {
        $amazingSales = AmazingSale::orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.market.discount.amazing-sale', compact('amazingSales'));
    }

    public function amazingSaleCreate()
    {
        $products = Product::orderByDesc('created_at')->cursor();
        return view('admin.market.discount.amazing-sale-create', compact('products'));
    }

    public function amazingSaleStore(AmazingSaleRequest $request)
    {
        $inputs = $request->all();
        // Date fix 
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int) $realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int) $realTimestampEnd);
        $amazingSale = AmazingSale::create($inputs);
        return redirect()->route('admin.market.discounts.amazing-sale.index')->with('toastr-success', 'کالا با موفقیت به فروش شگفت انگیز افزوده شد');
    }

    public function amazingSaleEdit(AmazingSale $amazingSale)
    {
        $products = Product::orderByDesc('created_at')->cursor();
        return view('admin.market.discount.amazing-sale-edit', compact('products', 'amazingSale'));
    }

    public function amazingSaleUpdate(AmazingSaleRequest $request, AmazingSale $amazingSale)
    {
        $inputs = $request->all();
        // Date fix 
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int) $realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int) $realTimestampEnd);
        $amazingSale->update($inputs);
        return redirect()->route('admin.market.discounts.amazing-sale.index')->with('toastr-success', 'ویرایش کالا در فروش شگفت انگیز با موفقیت انجام شد');
    }

    public function amazingSaleDestroy(AmazingSale $amazingSale)
    {
        $amazingSale->delete();
        return back();
    }
}
