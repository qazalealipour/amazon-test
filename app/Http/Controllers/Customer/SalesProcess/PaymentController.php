<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Models\Market\Coupon;
use App\Models\Market\Payment;
use App\Models\Market\CartItem;
use App\Models\Market\CashPayment;
use App\Http\Controllers\Controller;
use App\Models\Market\OnlinePayment;
use Illuminate\Support\Facades\Auth;
use App\Models\Market\OfflinePayment;
// use App\Http\Services\Payment\PaymentService;
use App\Models\Market\OrderItem;

class PaymentController extends Controller
{
    public function payment()
    {
        $cartItems = CartItem::where('user_id', auth()->user()->id)->get();
        $order = Order::where('user_id', Auth::user()->id)->where('order_status', 0)->first();
        return view('customer.sales-process.payment', compact('cartItems', 'order'));
    }

    public function couponDiscount(Request $request)
    {
        $request->validate(
            ['coupon' => 'required']
        );
        $coupon = Coupon::where('code', $request->coupon)->where('status', 1)->where('end_date', '>', now())->where('start_date', '<', now())->first();
        if ($coupon != null) {
            if ($coupon->user_id != null) {
                $coupon = Coupon::where('code', $request->coupon)->where('status', 1)->where('end_date', '>', now())->where('start_date', '<', now())->where('user_id', Auth::user()->id)->first();
                if ($coupon == null) {
                    return back()->withErrors(['coupon' => ['کد تخفیف اشتباه وارد شده است']]);
                }
            }
            $order = Order::where('user_id', Auth::user()->id)->where('order_status', 0)->where('coupon_id', null)->first();
            if ($order) {
                if ($coupon->amount_type == 0) {
                    $couponDiscountAmount = $order->order_final_amount * ($coupon->amount / 100);
                    if ($couponDiscountAmount > $coupon->discount_ceiling) {
                        $couponDiscountAmount = $coupon->discount_ceiling;
                    }
                } else {
                    $couponDiscountAmount = $coupon->amount;
                }

                $order->order_final_amount = $order->order_final_amount - $couponDiscountAmount;

                $finalDiscount = $order->order_total_products_discount_amount + $couponDiscountAmount;

                $order->update(
                    ['coupon_id' => $coupon->id, 'order_coupon_discount_amount' => $couponDiscountAmount, 'order_total_products_discount_amount' => $finalDiscount]
                );
                return back()->with(['coupon' => 'کد تخفیف با موفقیت اعمال شد']);
            } else {
                return back()->withErrors(['coupon' => ['کد تخفیف اشتباه وارد شده است']]);
            }
        } else {
            return back()->withErrors(['coupon' => ['کد تخفیف اشتباه وارد شده است']]);
        }
    }

    // public function paymentSubmit(Request $request, PaymentService $paymentService)
    // {
    //     $request->validate(
    //         ['payment_type' => 'required']
    //     );
    //     $order = Order::where('user_id', Auth::user()->id)->where('order_status', 0)->first();
    //     $cartItems = CartItem::where('user_id', Auth::user()->id)->get();
    //     $cash_receiver = null;

    //     switch ($request->payment_type) {
    //         case '1':
    //             $targetModel = OnlinePayment::class;
    //             $type = 0;
    //             break;
    //         case '2':
    //             $targetModel = OfflinePayment::class;
    //             $type = 1;
    //             break;
    //         case '3':
    //             $targetModel = CashPayment::class;
    //             $type = 2;
    //             $cash_receiver = $request->cash_receiver ? $request->cash_receiver : null;
    //             break;
    //         default:
    //             return redirect()->back()->withErrors(['error' => 'خطا']);
    //     }
    //     $paymented = $targetModel::create([
    //         'amount' => $order->order_final_amount,
    //         'user_id' => auth()->user()->id,
    //         'pay_date' => now(),
    //         'cash_receiver' => $cash_receiver,
    //         'status' => 1,
    //     ]);

    //     $payment = Payment::create([
    //         'amount' => $order->order_final_amount,
    //         'user_id' => auth()->user()->id,
    //         'type' => $type,
    //         'paymentable_id' => $paymented->id,
    //         'paymentable_type' => $targetModel,
    //         'status' => 1,
    //     ]);
    //     if($request->payment_type == 1)
    //     {
    //         $paymentService->zarinpal($order->order_final_amount, $order, $paymented);
    //         $order->update([
    //             'order_status' => 3
    //         ]);
    //         foreach ($cartItems as $cartItem){
    //             OrderItem::create([
    //                 'order_id' => $order->id,
    //                 'product_id' => $cartItem->product_id,
    //                 'product' => $cartItem->product,
    //                 'amazing_sale_id' => $cartItem->product->activeAmazingSales()->id ?? null,
    //                 'amazing_sale_object' => $cartItem->product->activeAmazingSales() ?? null,
    //                 'amazing_sale_discount_amount' => empty($cartItem->product->activeAmazingSales()) ? 0 : $cartItem->cartItemProductPrice()() * ($cartItem->product->activeAmazingSales()->percentage / 100),
    //                 'number' => $cartItem->number,
    //                 'final_product_price' => empty($cartItem->product->activeAmazingSales()) ? $cartItem->cartItemProductPrice() : ($cartItem->cartItemProductPrice() * ($cartItem->product->activeAmazingSales()->percentage / 100)),
    //                 'final_total_price' => empty($cartItem->product->activeAmazingSales()) ? $cartItem->cartItemProductPrice() * $cartItem->number : $cartItem->cartItemProductPrice() * ($cartItem->product->activeAmazingSales()->percentage / 100) * $cartItem->number,
    //                 'color_id' => $cartItem->color_id,
    //                 'guarantee_id' => $cartItem->guarantee_id,
    //             ]);
    //             $cartItem->delete();
    //         }
    //     }
    //     $order->update([
    //         'order_status' => 3
    //     ]);
    //     foreach ($cartItems as $cartItem){
    //         $cartItem->delete();
    //     }
    //     return redirect()->route('customer.home')->with('success', 'سفارش شما با موفقیت ثبت شد');
    // }


    // public function paymentCallback(Order $order, OnlinePayment $onlinePayment, PaymentService $paymentService)
    // {
    //     $amount = $onlinePayment->amount * 10;
    //     $result = $paymentService->zarinpalVerify($amount, $onlinePayment);
    //     $cartItems = CartItem::where('user_id', Auth::user()->id)->get();
    //     foreach ($cartItems as $cartItem){
    //         $cartItem->delete();
    //     }
    //     if($result['success'])
    //     {
    //         $order->update([
    //             'order_status' => 3
    //         ]);
    //         return redirect()->route('customer.home')->with('success', 'پرداخت با موفقیت انجام شد');
    //     }
    //     else{
    //         return redirect()->route('customer.home')->with('danger', 'سفارش شما با  خطا مواجه شد');
    //     }
    // }
}
