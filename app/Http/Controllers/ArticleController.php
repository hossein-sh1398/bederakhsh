<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Carbon\Carbon;
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

}