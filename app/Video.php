<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title', 'campaign_id', 'created_at'];

    public function comments()
    {
    	return $this->morphMany(Comment::class, 'commentable');
    }

    public function views()
    {
    	return $this->morphMany(View::class, 'viewable');
    }

    public $timestamps = false;

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
