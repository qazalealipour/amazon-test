<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function all()
    {
        $payments = Payment::orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.market.payment.all', compact('payments'));
    }

    public function online()
    {
        $payments = Payment::where('paymentable_type', '=', 'App\Models\Market\OnlinePayment')->orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.market.payment.all', compact('payments'));
    }

    public function offline()
    {
        $payments = Payment::where('paymentable_type', '=', 'App\Models\Market\OfflinePayment')->orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.market.payment.all', compact('payments'));
    }

    public function cash()
    {
        $payments = Payment::where('paymentable_type', '=', 'App\Models\Market\CashPayment')->orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.market.payment.all', compact('payments'));
    }

    public function returned(Payment $payment)
    {
        $payment->status = 3;
        $payment->save();
        return back()->with('toastr-success', 'وضعیت پرداخت با موفقیت تغییر یافت');
    }

    public function canceled(Payment $payment)
    {
        $payment->status = 2;
        $payment->save();
        return back()->with('toastr-success', 'وضعیت پرداخت با موفقیت تغییر یافت');
    }

    public function show(Payment $payment)
    {
        return view('admin.market.payment.show', compact('payment'));
    }
}
