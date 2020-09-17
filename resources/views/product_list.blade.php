@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			@foreach($products as $product)
				<div class="col-md-3">
					<h4>{{$product->name}}</h4>
					<p>Price: {{$product->price}}</p>
					<form method="post" action="{{route('cart.add', $product->id)}}" id="add-to-cart-{{$product->id}}">
						@csrf
					</form>
					@if (Cart::count($product) < $product->inventory)
					<button type="button" class="btn btn-success" onclick="document.getElementById('add-to-cart-{{$product->id}}').submit();">Add to cart</button type="button">
						{{-- <a href="{{route('cart.add', $product->id)}}" class="btn btn-success">Add to cart</a> --}}
					@endif
				</div>
			@endforeach
		</div>
	</div>
@endsection