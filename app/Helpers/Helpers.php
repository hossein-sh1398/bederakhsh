<?php


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