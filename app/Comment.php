<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Like;

class Comment extends Model
{
    protected $fillable = [ 'user_id', 'comment', 'approved', 'commentable_id', 'commentable_type', 'parent_id'];

    public function likes()
    {
    	return $this->morphMany(Like::class, 'likeable');
    }

    //
    public function commentable()
    {
    	return $this->morphTo();
    }

    public function childs()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
