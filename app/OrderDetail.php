<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'orderdetails';


    public $timestamps = false;
    public function order(){
        return $this->belongsTo('App\Order', 'order_id');
    }
}
