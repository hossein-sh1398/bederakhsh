<?php

namespace Modules\Discount\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Category;
use App\User;

class Discount extends Model
{
    protected $fillable = [
    	'code',
    	'percent',
    	'expired_at'
    ];

    public function categories()
    {
    	return $this->belongsToMany(Category::class);
    }

    public function products()
    {
    	return $this->belongsToMany(Product::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
