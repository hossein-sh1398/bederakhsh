<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $fillable = ['title'];

    public function campaigns()
    {
    	return $this->belongsToMany(Campaign::class);
    }
}
