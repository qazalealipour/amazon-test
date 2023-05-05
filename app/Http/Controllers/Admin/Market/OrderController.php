<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Order;

class OrderController extends Controller
{
    public function all()
    {
        $orders = Order::orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.market.order.all', compact('orders'));
    }

    public function new()
    {
        $orders = Order::where('order_status', '=', 0)->orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.market.order.all', compact('orders'));
    }

    public function sending()
    {
        $orders = Order::where('delivery_status', '=', 1)->orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.market.order.all', compact('orders'));
    }

    public function unpaid()
    {
        $orders = Order::where('payment_status', '=', 0)->orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.market.order.all', compact('orders'));
    }

    public function canceled()
    {
        $orders = Order::where('order_status', '=', 4)->orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.market.order.all', compact('orders'));
    }

    public function returned()
    {
        $orders = Order::where('order_status', '=', 5)->orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.market.order.all', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('admin.market.order.show', compact('order'));
    }

    public function changeSendStatus(Order $order)
    {
        switch ($order->delivery_status) {
            case 0:
                $order->delivery_status = 1;
                break;
            case 1:
                $order->delivery_status = 2;
                break;
            case 2:
                $order->delivery_status = 3;
                break;
            default:
                $order->delivery_status = 0;
        }
        $order->save();
        return back()->with('toastr-success', 'تغییر وضعیت ارسال با موفقیت انجام شد');
    }

    public function changeOrderStatus(Order $order)
    {
        switch ($order->order_status) {
            case 1:
                $order->order_status = 2;
                break;
            case 2:
                $order->order_status = 3;
                break;
            case 3:
                $order->order_status = 4;
                break;
            case 4:
                $order->order_status = 5;
                break;
            default:
                $order->order_status = 1;
        }
        $order->save();
        return back()->with('toastr-success', 'تغییر وضعیت سفارش با موفقیت انجام شد');
    }

    public function cancelOrder(Order $order)
    {
        $order->order_status = 4;
        $order->save();
        return back()->with('toastr-success', 'سفارش مورد نظر با موفقیت باطل شد');
    }

    public function detail(Order $order)
    {
        return view('admin.market.order.detail', compact('order'));
    }
}
