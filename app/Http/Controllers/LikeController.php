<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'auth' );
    }


 	public function like(Request $request, $likeable_id )
    {
        $request->validate( [
            'likeable_type' => [ 'required', 'string', Rule::in( 'App\Models\Article', 'App\Comment' )]
        ] );

        $subject = ( new $request->likeable_type)->findOrFail( $likeable_id );

        $user = auth()->user();

        if ( $user->liked( $subject ) ) {
            
            $user
                ->likes()
                ->where( [ 'likeable_id' => $subject->id, 'likeable_type' => get_class( $subject ) ] )
                ->delete();

        } else {
            $subject->likes()->create( [ 'user_id' => auth()->id() ] );
    	}

    	return back();
    }  
}
