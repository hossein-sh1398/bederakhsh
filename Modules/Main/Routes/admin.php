<?php

Route::prefix('module')->group(function() {
	Route::get('/', 'ModuleController@index')->name('module.index');
	Route::get('disable/{name}', 'ModuleController@disable')->name('module.disable');
	Route::get('enable/{name}', 'ModuleController@enable')->name('module.enable');
	Route::get('delete/{name}', 'ModuleController@delete')->name('module.delete');

});