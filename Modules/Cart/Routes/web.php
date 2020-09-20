<?php



Route::prefix('cart')->namespace('Frontend')->group(function() {
    Route::post('add/{product}', 'CartController@addToCart')->name('cart.add');

	Route::get('/', 'CartController@cart')->name('cart');

	Route::patch('quantity/change', 'CartController@changeQuantity')
		->name('cart.change.quantity');
		
	Route::get('item/{id}/delete', 'CartController@deleteItemCart')->name('cart.item.delete');
});
