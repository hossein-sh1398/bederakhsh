<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function list()
    {
    	$products = Product::get();
    	return view('product_list', compact('products'));
    }

    public function product()
    {
    	
    }
}
