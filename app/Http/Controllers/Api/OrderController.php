<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\OrderItem;
use Illuminate\Support\Carbon;
use Pusher\Pusher;
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
            $item->product_id = $product->id;
            $item->price = $product->price;
            $item->quantity = $product->slChon;
            $item->save();
        }


        $data['store_code'] = $request->store_code;
        $data['table'] = $request->table;
        $data['name'] = $user->name;
        $data['price'] = $request->total_price;
        $data['products'] = $products;
            $options = array(
                'cluster' => 'ap1',
                'encrypted' => true
            );
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );

            $pusher->trigger('Notify', 'send-message', $data);

        return response()->json($order, 200);
    }
    protected $successStatusCode = 200;



    public function historyorder(){
        $user = auth('api')->user();
        return response()->json($user->orders, $this->successStatusCode);
    }

    public function historyorderdetails(Request $request){
        $order = Order::find($request->id);
        return response()->json($order->orderdetails, $this->successStatusCode);
    }
}


