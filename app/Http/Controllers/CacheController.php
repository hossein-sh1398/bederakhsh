<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\User;

class CacheController extends Controller
{
	public function cache()
	{
		//Cache::put( 'name' , 'Hossein', 10);
		// return Cache::get( 'name', 'default value' );

		// Cache::forget('name');// delete key in cache

		Cache::remember('user', 100, function() {
			return User::first();
		});
		return Cache::get('user');
	}
}
