<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
    	return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
    	$user = Socialite::driver('google')->user();
    	$model_user = User::whereEmail($user->email)->first();
    	if (!$model_user) {
    		$model_user = User::create([
    			'name' => $user->name,
    			'email' => $user->email,
    			'username' => $user->name,
    			'password' => bcrypt('password')
    		]);
    	}
    	auth()->login($model_user);
    	return redirect('/home');
    }
}
