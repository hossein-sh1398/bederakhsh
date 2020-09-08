<?php
namespace Vandaw\Cart;

class CartService
{
	protected $cart;

	public function __construct()
	{
		$this->cart = session()->get('cart') ? session()->get('cart') : [];
	}
	
	public function all()
	{
		return $this->cart;
	}

	public function get($key)
	{
		if (isset($this->cart[$key])) {
			return $this->cart[$key];
		} else {
			return false;
		}
	}

	public function put($key)
	{
		if (isset($this->cart[$key])) {
			$this->cart[$key]  += 1;
		} else {
			$this->cart[$key] = 1;
		}
		session()->put('cart', $this->cart);
	}

	public function has($key)
	{
		if (isset($this->cart[$key])) {
			return true;
		} else {
			return false;
		}
	}

	public function update($key, $value)
	{
		if (isset($this->cart[$key])) {
			$this->cart[$key] = $value;
			session()->put('cart', $this->cart);
		}
	}

	public function delete($key)
	{
		if (isset($this->cart[$key])) {
			unset($this->cart[$key]);
			session()->put('cart', $this->cart);
		}	
	}

}