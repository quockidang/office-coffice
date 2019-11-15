<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Support\Carbon;
use Pusher\Pusher;
class OrderController extends Controller
{
    protected $successStatusCode = 200;

    public function order(Request $request){
        $user = Auth::user();

        $order = new Order;
        $order->customer_id = $user->id;
        $order->orderdate = Carbon::now('Asia/Ho_Chi_Minh'); // 2018-10-18 21:15:43
        $order->store_code = $request->store_code;
        $order->status = 0; // chua xu li
        $order->table = $request->table;
        $order->save();


        $orderDetails = new OrderDetail;
        $orderDetails->order_id = $order->id;
        $orderDetails->product_id = $request->product_id;
        $orderDetails->price = $request->price;
        $orderDetails->quantity = $request->quantity;

        $orderDetails->save();

        $data['store_code'] = $request->store_code;
        $data['table'] = $request->table;
        $data['name'] = $user->name;
        $data['product'] = Product::find($request->product_id)->name;
        $data['price'] = $request->price;
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


        return response()->json('sucsess', 200);
    }

    public function historyorder(){
        $user = Auth::user();
        return response()->json($user->orders, $this->successStatusCode);
    }

    public function historyorderdetails(Request $request){
        $order = Order::find($request->id);
        return response()->json($order->orderdetails, $this->successStatusCode);
    }
}
