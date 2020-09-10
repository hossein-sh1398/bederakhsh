<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Stage extends Model
{
    protected $fillable = [
    	'name',
    	'description', 
    	'vote_date',
    	'period_id', 
    	'count', 
    	'start_date', 
    	'end_date',
    	'status'
    ];

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class);
    }

    public function votes()
    {
    	return $this->hasMany(Vote::class);
    }
}