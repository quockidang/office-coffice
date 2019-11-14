<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'customer_id',
        'orderdate',
        'status',
        'store_code',
        'table'
    ];

    public function customer(){
        return $this->belongsTo('App\Customer', 'customer_id');
    }

    public function orderdetails(){
        return $this->hasMany('App\OrderDetails', 'order_id');
    }
}
