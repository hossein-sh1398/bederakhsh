<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Str;
use App\Payment;
use Exception;

class PaymentController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}


    public function payment(Request $request)
    {
    	$cart = session('cart');
    	
    	if (! is_null($cart)) {

	    	if ($cart->isNotEmpty()) {

	    		$user = auth()->user();

	    		$order = $user->orders()->create([
	    			'price' => Cart::sum(),
	    			'status' => 'unpaid'
	    		]);
	    	

		    	$allItems = Cart::all();
		    	$product_ids = $allItems->mapWithKeys(function($item) {
		    		return [
		    			$item['product']->id => ['quantity' => $item['quantity']] 
		    		];
		    	});

		    	$order->products()->attach($product_ids);

		    	$token = env('PAYPING_TOKEN');
		    	$resNumber = Str::random(20);

				$args = [
				    "amount" => $order->price,
				    "payerName" => auth()->user()->name,
				    "returnUrl" => route('payment.callback'),
				    "clientRefId" => $resNumber
				];

				$payment = new \PayPing\Payment($token);

				try {
				    $payment->pay($args);
				} catch (Exception $e) {
				   throw $e;
				   
				}

				$order->payments()->create(['resnumber' => $resNumber]);
				
				Cart::flush();

				return redirect($payment->getPayUrl());
	    	}
    	}
    	return redirect(route('cart'));
    }

    public function callback(Request $request)
    {
    	$payment = Payment::with('order')->where('resnumber', $request->clientrefid)->firstOrFail();

    	$price = $payment->order->price;

    	$token = env('PAYPING_TOKEN');

		$payping = new \PayPing\Payment($token);

		try {

		    if( $payping->verify( $request->refid, $price ) ){
		        
		        $payment->update([
		        	'status' => 1
		        ]);

		        $payment->order->update([
		        	'status' => 'paid'
		        ]);

		        // alert()->success();
		        // return redirect('products');

		    } else {
		        // alert()->error();
		        // return redirect('products');
		    }
		} catch (Exception $e) {

			$error = collect( json_decode($e->getMessage(), true) );
			// alert()->error($error->first());
			// return redirect('products');
		}
    }
}

