<?php
namespace Vandaw\Cart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class CartServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('cart', function(){
			return new CartService;
		});
		$this->mergeConfigFrom(__DIR__.'\config\cart.php', 'cart');

		// Copy controllers to main path
		$path = app_path('Http\Controllers');
		File::copy(
			__DIR__.'\controllers\IndexController.php',
			$path . '\IndexController.php'
		);

	}

	public function boot()
	{

		$this->loadViewsFrom(__DIR__.'\views', 'cart');

		$this->publishes([
			__DIR__.'\config\cart.php' => config_path('cart.php'),
			__DIR__.'\views' => resource_path('views\cart')
		]);

		require __DIR__.'\routes\route.php';
	}
}