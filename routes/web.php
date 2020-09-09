<?php

use Illuminate\Support\Facades\Route;
use Vandaw\Cart\CartFacade;
use Illuminate\Notifications\Messages\MailMessage;
use App\Exceptions\MyException;

Route::get('logerror', function() 
{
	try {
		throw new MyException('khataye alaki');
		
	} catch (MyException $e) {
		report($e);
	}
	return 'eddddddddd';
	
});

Route::get('/', 'IndexController@index');

Route::get('localization', 'LocalizationController@index');

Route::get('collection', 'CollectionController@coll');

Route::get( 'user/make/{name}', 'UserController@make' );


Route::get( 'download/link/{path}', function( $path ) {

	return \URL::temporarySignedRoute( 
		'download', 
		now()->addseconds( 20 ), 
		[ 'path' => 'files/'. $path ] 
	);

} );


Route::get( 'download', function () {

	return \Storage::download( request('path') );

} )->name( 'download' )->middleware('signed');








// Route::get( '/', function() {
// 	$hasLikes = [];

// 	$articles = App\Models\Article::with( 'likes' )
// 					->get();

// 	// if ( auth()->check() ) {
// 	// 	foreach ( $articles as $article ) {
// 	// 		if ( auth()->user()->liked( $article ) ) {
// 	// 			$hasLikes[] = true;
// 	// 		} else {
// 	// 			$hasLikes[] = false;
// 	// 		} 
// 	// 	}
// 	// }
// 	return view( 'editor', [ 'articles' => $articles, 'hasLikes' => $hasLikes ] );
// } );

Route::post('like/{likeable_id}', 'LikeController@like')->name('like');

Route::get('articles/create', 'ArticleController@create');
Route::post('articles', 'ArticleController@store');
Route::get('articles/{article}', 'ArticleController@show');


Route::get('send', 'NotificationController@email');
Route::get('getMessageNotification', 'NotificationController@getMessageNotification');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get( 'cache', 'CacheController@cache' );

Route::get('model', 'ModelController@model');

Route::get( 'admin', function() {
	auth()->loginUsingId(1);
	return view('admin.dashboard');
} );

Route::get('comment', 'CommentController@index');
Route::get('comment/{comment}', 'CommentController@verify')->name('comment.verify');
Route::delete('comment/{comment}', 'CommentController@destroy')->name('comment.destroy');
Route::post('comment', 'CommentController@store')->name('comment.store');
Route::post('comment/ajax', 'CommentController@ajax');
//https://sepahboursese.etadbir.com/login.html

Route::get('query-builder', 'QueryBuilderController@builder');

Route::get('campaign-stage', 'CampaignStageController@index');

Route::get('video/{video}', 'VideoController@show');

Route::get('report', 'ReportController@report');



Route::get('date', function()
{
	return App\User::whereDate('created_at', '2020-09-08')
		->get();
});