<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ModelController extends Controller
{
    public function model()
    {
    	// $user = User::firstOrNew([
    	// 	'name' => 'fjhf',
    	// 	'email' => 'fjhf@gmail.com',
    	// 	'password' => bcrypt('ddddddddddddd')
    	// ])->save();

    	//$user->save();
    	//dd(User::where('name', 'fjhf')->first());

    	// $user = User::updateOrCreate(['name' => 'ffggg'], [
    	// 	'name' => 'ffggg',
    	// 	'email' => 'e@gmail.com',
    	// 	'password' => bcrypt('ddddddddddddd')
    	// ]);
    	// dd($user);
    	//dd(User::withTrashed()->find(33));
    	//User::find(33)->delete();
    	// User::onlyTrashed()->get();
    	// User::onlyTrashed()->where('id', '>', 100)->get();
    	dd(User::find(4));
    }
}
