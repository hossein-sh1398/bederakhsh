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

Route::post('discount/check', 'DiscountController@check')->name('discount.check');

Route::get('discount/delete', 'DiscountController@delete')->name('discount.delete');
