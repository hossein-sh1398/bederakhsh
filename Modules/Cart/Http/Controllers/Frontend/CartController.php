<?php

namespace Modules\Cart\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Product; 
use Illuminate\Routing\Controller;
use Cart;

class CartController extends Controller
{

    public function addToCart(Product $product)
    {
        if ( Cart::has($product) ) {
            
            Cart::update($product, 1);

        } else {
            
            Cart::put(
                [
                    'quantity' => 1,
                    'price' => $product->price
                ],
                $product
            );
            
        }
        return redirect()->back();
    }


    public function cart()
    {
        $carts = Cart::all();

    	return view('cart::Frontend.cart', ['carts' => $carts]);
    }


    public function changeQuantity(Request $request)
    {
        $validData = $request->validate([
            'id' => 'required|string',
            'quantity' => 'required|numeric'
        ]);

        if ( Cart::has($validData['id']) )
        {
            Cart::update($validData['id'], [
                'quantity' => $validData['quantity']
            ]);
        }

        return back();
    }


    public function deleteItemCart($id)
    {
        if ( Cart::has($id) ) {
            Cart::deleteItem($id);
        }
        return back();
    }
}