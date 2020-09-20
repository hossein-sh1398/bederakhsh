<?php

namespace Modules\Cart\Services;

use Illuminate\Support\Facades\Facade;
/**
* Class Cart
* @package App\Services\Cart
* @method static bool has($id);
* @method static Collection all();
* @method static array get($id);
* @method static Cart put(array $value, Model $obj = null);
*/

class Cart extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'cart';
	}
}