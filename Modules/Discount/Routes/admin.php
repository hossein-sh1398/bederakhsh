<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('discount', 'DiscountController@index')->name('discount.index');
Route::get('discount/create', 'DiscountController@create')->name('discount.create');
Route::post('discount', 'DiscountController@store')->name('discount.store');
Route::get('discount/{discount:code}/edit', 'DiscountController@edit')->name('discount.edit');
Route::patch('discount/{discount:code}', 'DiscountController@update')->name('discount.update');
Route::delete('discount/{discount:code}', 'DiscountController@destroy')->name('discount.destroy');

