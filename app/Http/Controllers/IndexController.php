<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Vandaw\Cart\Traitd\CartTrait;

class IndexController extends Controller
{
	use CartTrait;

	public function index()
	{
		return 'Home Page';
	}

	public function aboutMe()
	{
		return 'About Page';
	}
}