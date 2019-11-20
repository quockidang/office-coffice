<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'store_code',
        'table',
        'total_price',
        'customer_id',
        'order_here',
        'address',
        'order_date',
    ];

    protected $timestamps = false;

    public function orderitems(){
        $this->hasMany('App\OrderItem', 'order_id');
    }
}
