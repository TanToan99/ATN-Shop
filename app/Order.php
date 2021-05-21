<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'total', 'yourname', 'email', 'phone', 'address', 'status_id', 'payment_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function orderdetails()
    {
        return $this->hasMany('App\OrderDetail');
    }
    public function products() {
        return $this->hasManyThrough('App\Product', 'App\OrderDetail', 'product_id', 'id', 'id');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function paymentstatus()
    {
        return $this->belongsTo('App\PaymentStatus', 'payment_id');
    }
}
