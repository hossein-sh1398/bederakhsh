<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['fname', 'ename'];

    public $table = 'categories';
}
