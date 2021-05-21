<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    protected $fillable = [
        'name'
    ];
    public function orders()
    {
    	return $this->hasMany('App\Order');
    }
}
