<?php
use Carbon\Carbon;
use App\Stage;
use \Morilog\Jalali\CalendarUtils;

function subjects()
{
	return [
		'campaign' => 'App\Campaign',
		'video' => 'App\Video',
		'article' => 'App\Models\Article',
	];
}


function views($viewable_id, $viewable_type)
{

	$subject = (new $viewable_type)->find($viewable_id);

    if ( auth()->check() ) {

        $count = $subject->views()->where( 'user_id' , auth()->id() )->count();
        if ( ! $count ) {
            
            $subject->views()->create( [ 'user_id' => auth()->id() ] );
        } 
    } else {

        $ip = request()->ip();
        $count = $subject->views()->where( 'ip' , $ip )->count();
        if ( ! $count ) {
            
            $subject->views()->create( [ 'ip' => $ip ] );
        }
    }
}

// get views today
function dateViews($viewable_id, $viewable_type, $date)
{

	$subject = (new $viewable_type)->find($viewable_id);
	
	return $subject
		->views()
		->whereDate('created_at', $date)
		->count();

}

// get views today
function dateComments($commentable_id, $commentable_type, $date)
{

	$subject = (new $commentable_type)->find($commentable_id);
	
	return $subject
		->comments()
		->whereDate('created_at', $date)
		->count();

}

// get views today
function dateLikes($likeable_id, $likeable_type, $date)
{

	$subject = (new $likeable_type)->find($likeable_id);
	
	
	return $subject
		->likes()
		->whereDate('created_at', $date)
		->count();

}


// current stage
function currentStage()
{
	// find current stage
	$currentDate = Carbon::now()->toDateString();

	return Stage::where('status', 'published')
				->whereDate('start_date', '<=', $currentDate)
				->whereDate('end_date', '>=', $currentDate)
				->first();
}


function toGregorian($shamsiDate)
{
	if ($shamsiDate) {

		if (strpos($shamsiDate, '-')) {

			$shamsiDate = str_replace('-', '/', $shamsiDate);
		}
			

		$arrayShamsi = explode( '/', $shamsiDate );

		if (is_array($arrayShamsi)) {

			if ( count($arrayShamsi) == 3 ) {

				$miladiDate = CalendarUtils::toGregorian( intval($arrayShamsi[0]), intval($arrayShamsi[1]), intval($arrayShamsi[2]) );
				
				return implode('-', $miladiDate);
				
			}
		}
	}
			
	return null;
}


