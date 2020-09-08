<?php

Route::namespace('App\Http\Controllers')->group(function(){
	Route::get('home', 'IndexController@index');
	Route::get('aboutme', 'IndexController@aboutMe');
	Route::get('contact', 'IndexController@contact');
	
});
