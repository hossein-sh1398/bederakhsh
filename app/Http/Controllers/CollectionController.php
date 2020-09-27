<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Vote;

class CollectionController extends Controller
{
    public function coll()
    {
        $arr = collect([1,2,3,]);
        $videos = Vote::get();
        dd($videos->all());
        // $res = collect($arr)->map(function($item){
        //     return $item*3;
        // })->map(function($item){
        //     return $item+1;
        // });

        // dd($arr->has(1));
        // dd($arr->search(2));
        //dd($arr->search(2));
    }
}
