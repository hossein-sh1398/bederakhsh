<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Carbon\Carbon;
use App\Tag;
use App\Video;

class ArticleController extends Controller
{

	public function create()
	{
		return view('editor');
	}

	
    public function store()
    {

    	dd(request()->all());
    }

    public function show(Article $article)
    {      
        views($article->id, get_class($article));

    	return view('article', compact('article'));
    }

    public function morph()
    {
        $video = Video::first();
        $video->tags()->sync([1,2]);
        exit();
        $tag = Tag::find(1);
        $tag->articles()->sync([1,2,3,4]);
        //dd($tag->articles);
        //$article->tags()->sync([1,2,3,4]);
        //dd($article->tags);
        // \DB::table('taggables')->insert([
        //     'tag_id' => 1,
        //     'taggable_id' => $article->id,
        //     'taggable_type' => get_class($article)
        // ]);
        
    }
   
}