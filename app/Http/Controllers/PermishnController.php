<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermishnController extends Controller
{
	public function __construct()
	{

	}
    public function test()
    {
    	$user = auth()->loginUsingId(1);
    	$this->authorize('show-user');
	    // if (Gate::denies('show-user') ) {
	    // 	abort(403);
	    // }
        dd( auth()->user()->email );
    }
}