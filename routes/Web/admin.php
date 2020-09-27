<?php

Route::get('/', 'AdminController@dashboard');


Route::get('stage/create', 'StageController@create')->name('stage.create');
Route::post('stage', 'StageController@store')->name('stage.store');
Route::get('stage', 'StageController@index')->name('stage.index');
Route::patch('stage/{stage}', 'StageController@update')->name('stage.update');