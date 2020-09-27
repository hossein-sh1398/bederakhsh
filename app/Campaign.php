<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'firstname', 
        'lastname', 
        'user_id',
        'display_name',
        'status'
    ];
    
    public function comments()
    {
    	return $this->morphMany(Comment::class, 'commentable');
    }

    public function stages()
    {
    	return $this->belongsToMany(Stage::class);
    }

    public function views()
    {
    	return $this->morphMany(View::class, 'viewable');
    }

    public function videos()
    {
    	return $this->hasMany(Video::class);
    }
}
