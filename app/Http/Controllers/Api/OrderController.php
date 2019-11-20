<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\OrderItem;
use Illuminate\Support\Carbon;

use function GuzzleHttp\json_decode;

class OrderController extends Controller
{
    public function order(Request $request)
    {
        $user = auth('api')->user();

        $order = new Order;

        $order->store_code = $request->store_code;
        $order->table = $request->table;
        $order->total_price = $request->total_price;
        $order->customer_id = $user->id;
        $order->order_here = 1;
        $order->order_date = Carbon::now('Asia/Ho_Chi_Minh');

        $order->save();

        $products = json_decode($request->products);

        foreach($products as $product){
            $item = new OrderItem;
            $item->order_id = $order->id;
            $item->product_id = $product->product_id;
            $item->price = $product->price;
            $item->quantity = $product->quantity;
            $item->save();
        }

        return response()->json($order, 200);
    }
}
