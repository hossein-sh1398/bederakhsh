<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Modules\Discount\Entities\Discount;

class Product extends Model
{
    protected $fillable = [ 'name', 'price', 'inventory' ];

    public function discounts()
    {
    	return $this->belongsToMany(Discount::class);
    }

    public function orders()
    {
    	return $this->belongsToMany(Order::class);
    }
}
