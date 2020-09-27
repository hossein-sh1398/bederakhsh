<?php

namespace App;
use App\Models\Article;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function articles()
    {
    	return $this->morphedByMany(Article::class, 'taggable');
    }

    public function videos()
    {
    	return $this->morphedByMany(Video::class, 'taggable');
    }
}
