<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $fillable = [
    	'name',
    	'description', 
    	'start_date', 
    	'end_date',
    	'status'
    ];
}
