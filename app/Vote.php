<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
    	'stage_id',
    	'campaign_id'
    ];

    
}
