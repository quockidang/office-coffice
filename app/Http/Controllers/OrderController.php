<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\OrderDetail;
use Illuminate\Support\Carbon;
class OrderController extends Controller
{

    public function __construct(Type $var = null) {
        $this->var = $var;
    }


    public function order(Request $request){
        $user = User::find($request->id);

        $order = new Order;
        $order->customer_id = $user->id;
        $order->orderdate = Carbon::now('Asia/Ho_Chi_Minh'); // 2018-10-18 21:15:43
        $order->store_code = $request->store_code;
        $order->status = 0; // chua xu li
        $order->save();


        $orderDetails = new OrderDetail;
        $orderDetails->order_id = $order->id;
        $orderDetails->product_id = $request->product_id;
        $orderDetails->price = $request->price;
        $orderDetails->quantity = $request->quantity;

        $orderDetails->save();
    }
}
