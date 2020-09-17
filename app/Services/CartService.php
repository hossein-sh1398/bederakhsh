<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CartService
{
	protected $cart;


	public function __construct()
	{
		$this->cart = session('cart') ?? collect([
			'items' => collect([]),
			'discount' => null
		]);
	}


	public function put(array $value, $obj = null)
	{
		if ( ! is_null($obj) && $obj instanceof Model) {

			$value = array_merge($value, [

				'id' => Str::random(10),
				'subject_id' => $obj->id,
				'subject_type' => get_class($obj),
				'discount_percent' => 0

			]);

		} elseif ( ! isset( $value['id'] ) ) {

			$value = array_merge( $value, ['id' => Str::random(10)] );
		}

		$this->cart['items']->put($value['id'], $value);

		session()->put('cart', $this->cart);

		return $this;
	}


	public function has($key)
	{
		if ($key instanceof Model) {

			return !! $this->cart['items']->where('subject_id', $key->id)
						->where( 'subject_type', get_class($key) )
						->first();

		} 

		return !! $this->cart['items']->firstWhere('id', $key);	
	}


	public function get($key, $withRealationShip = true)
	{
		$item = $key instanceof Model

				? $this->cart['items']->where('subject_id', $key->id)->where('subject_type', get_class($key))->first()

				: $this->cart['items']->firstWhere('id', $key);
				
		return $withRealationShip ? $this->withRealationShipIfExists($item) : $item;
	}



	public function all()
	{
		return $this->cart['items']->map(function($item) {
			return $this->withRealationShipIfExists($item);
		});
	}


	public function withRealationShipIfExists($item)
	{
		if ( isset( $item['subject_type'] ) and isset( $item['subject_id'] ) ) {

			$class = $item['subject_type'];
			$subject = (new $class)->find($item['subject_id']);
			$item[strtolower(class_basename($class))] = $subject;

			unset($item['subject_id']);
			unset($item['subject_type']);
		}

		return $item;
	}


	public function count($key)
	{
		return $this->has($key) ? $this->get($key)['quantity'] : 0;

	}

	public function sum()
	{
		$cart = $this->all();
		$sum = $cart->sum(function($item){
			return $item['product']->price * $item['quantity'];
		});

		return $sum;
	}


	public function update($key, $options)
	{
		$item =  collect( $this->get($key, false) );
		if ( is_numeric($options) )
		{
			$item = $item->merge([
				'quantity' => $item['quantity'] + $options
			]);

		} elseif ( is_array($options) && isset($options['quantity']) && count($options) == 1 ) {
			$item = $item->merge($options);
		}

		$this->put($item->toArray());

		return $this;
	}

	public function deleteItem($id)
	{
		$this->cart['items']->pull($id);
		
		session(['cart', $this->cart]);
	}

	public function flush()
	{
		$this->cart = collect([
			'items' => collect([]),
			'discount' => null
		]);
		
		session(['cart' => $this->cart]);
	}

}