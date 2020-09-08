<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Article;
use App\User;
class ReportController extends Controller
{
	// دریافت تعداد بازدیدهای یک هفته گذشته
    public function report()
    {

    	$article = Article::paginate(1);
        $dt = new Carbon();
        $views = [];

        for ($i = 0; $i <= 6 ; $i++ ) {

            if ( ! $i ) {

                $date = $dt->now()->toDateString();
            } else {

                $date = $dt->subDays(1)->toDateString(); 
            }
            $views[$date] = [ 
            	'view' => dateViews($article->id, get_class($article), $date),
            	'comment' => dateComments($article->id, get_class($article), $date),
            	'like' => dateLikes($article->id, get_class($article), $date),
            ];
        }

        dd($views);
    }
}