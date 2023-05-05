<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        if (isset(request()->type)) {
            $orders = auth()->user()->orders()->where('order_status', request()->type)->get();
        } else {
            $orders = auth()->user()->orders()->get();
        }
        return view('customer.profile.orders', compact('orders'));
    }
}
