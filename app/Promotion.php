<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
      'name', 'price', 'start_date', 'end_date',
    ];
}
