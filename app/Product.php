<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'description', 'category_id', 'quantity'
    ];
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }
    public function orderdetails()
    {
        return $this->hasMany('App\OrderDetail');
    }
    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
