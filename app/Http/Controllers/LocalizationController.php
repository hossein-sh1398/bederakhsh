<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class LocalizationController extends Controller
{
    public function index()
    { 	
    	app()->setLocale(request('lang'));
    	$lang = app()->getLocale();
    	$categories = Category::where('language', $lang)->get();
    	return view('index', compact('categories'));
    }

    public function base()
    {
    	$names = [ 'hossein', 'vahid', 'naghi', 'taghi' ];
    }
}
