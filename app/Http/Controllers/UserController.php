<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Events\RegisterUserEvent;

class UserController extends Controller
{
    public function make($name)
    {
        $user = User::create( [
            'name' => $name,
            'email' => $name . '@gmail.com',
            'password' => bcrypt( 'abcdefjhigklmnopqrstuvwxyz')
        ] );

        event( new RegisterUserEvent() );

    }

    public function real()
    {
    	// $user = User::with(['comments' => function($query) {
    	// 	$query->where('approved', 1);
    	// }])->find(1);

    	// dd($user->load('comments'));
    	// $users = User::all();
    	// dd($users->load('comments'));

    	// dd(User::has('comments')->get());
    	// dd(User::has('comments', '>', 5)->get());
    		// dd(User::withCount('comments')->find(1));
    	// dd(User::with('comments:user_id,id,comment')->find(1));
    	// dd(User::doesntHave('comments')->get());
    	
    	// dd(User::whereHas('comments', function($query) {
    	// 	$query->where('comment', 'LIKE', '%fs%');
    	// })->get());

    	// dd(User::whereDoesntHave('comments', function($query) {
    	// 	$query->where('comment', 'LIKE', '%fs%');
    	// })->get());

    	// $user->posts()->save($post)
    	// $user->posts()->saveMany([$post1, $post2, $post3, ...]);

    	// $user->posts[1]->title = 'ddd';
    	// $user->posts[2]->title = 'gggg';
    	// $user->push();

    	// $profile = new Profile(['age'=> 33, 'height' => 198, 'bio' => 'nothing...!']);
    	// $user = new User([
    	// 	'name' => 'hoss',
    	// 	'email' => 'fff@gmail.com',
    	// 	'password' => 'ffff'
    	// ]);
    	// $user->save();
    	//$profile->user()->associate($user);
    	// $profile->save()

    	// $post->tags()->attach([1,2,3]);
    	// $post->tags()->detach([3]);
    	// $post->tags()->detach();
    	// $post->tags()->sync([1,2]);
    	// $post->tags()->syncWithoutDetaching([1,33]);
    	// $post->tags()->toggle([1,33]);

    	// paginate posts user
    	// $user->posts()->paginate(); default number paginate 15

    	// {{$posts->appends(request()->query())->appends(['a' => 1])}}
    	// {{$posts->fragment('jjjj')}} bepare felan jaye safhe


    	//$posts->onEachSide(2)

    	// dd(User::find(1)->comments->where('approved', 1));

   

    }
}
