<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Order;
use App\OrderItem;
use App\Product;
use Illuminate\Support\Carbon;
use PDF;

class OrderController extends Controller
{


    public function index()
    {
        $user = auth('web')->user();

        $date = date('2019-11-22');
        $orders = Order::where('created_at', 'LIKE', '%' . $date . '%')->where('status', 1)->where('store_code', $user->store_code)->get();
        return view('backend.order.index', compact('orders'));
    }
    public function orderdetails($id)
    {
        $order = Order::find($id);
        $orderItems = OrderItem::where('order_id', $id)->get();
        foreach ($orderItems as $item) {
            $product = Product::find($item->product_id);
            $item->product_id = $product;
        }
        return view('backend.order.detail', compact('order', 'orderItems'));
    }

    public function printBill($id)
    {
        $order = Order::find($id);
        $orderItems = OrderItem::where('order_id', $id)->get();
        foreach ($orderItems as $item) {
            $product = Product::find($item->product_id);
            $item->product_id = $product;
        }
        // return view('backend.order.bill');
        $data = ['title' => 'Welcome to ItSolutionStuff.com'];
        switch ($order->store_code) {
            case 'CH53MT':
                $order->store_code = '102 Tân Hòa 2, P. Hiệp Phú, Quận 9, TP HCM';
        }

        $data['order'] = $order;
        $data['orderItems'] = $orderItems;
        $pdf = PDF::loadView('backend.order.bill', $data);
        return $pdf->setPaper(array(0, 0, 280, 450))->stream();
    }
}
