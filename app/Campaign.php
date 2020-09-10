<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'name', 
        'user_id',
        'display_name',
        'cover',
        'participant_image',
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
