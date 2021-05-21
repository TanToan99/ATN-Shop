<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    protected $fillable = [
        'name', 'content', 'image_id'
    ];
    public function image()
    {
        return $this->belongsTo('App\Image');
    }
}
