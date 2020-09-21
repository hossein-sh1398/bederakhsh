<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permishn extends Model
{
    protected $fillable = ['name'];

    public function users()
    {
    	return $this->belongsToMany(User::class);
    }
}
