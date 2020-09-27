<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use App\View;
use App\Tag;

class Article extends Model
{
    protected $fillable = [
    	'title',
    	'image',
    	'body',
    	'status',
    ];

    public function likes()
    {

    	return $this->morphMany(Like::class, 'likeable');
    }

    public function comments()
    {

        return $this->morphMany(Comment::class, 'commentable');
    }

    public function views()
    {

        return $this->morphMany(View::class, 'viewable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

}
