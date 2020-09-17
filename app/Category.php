<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Modules\Discount\Entities\Discount;

class Category extends Model
{
    protected $fillable = ['title', 'language'];

    public function discounts()
    {
    	return $this->belongsToMany(Discount::class);
    }
}
