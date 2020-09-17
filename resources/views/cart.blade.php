@extends('layouts.app')

@section('content')
	<div class="container" style="text-align: right;direction: rtl;">
		<table class="table" >
			<tr>
				<th>نام</th>
				<th>قیمت واحد</th>
				<th>تعداد</th>
				<th>جمع قیمت</th>
			</tr>
			@foreach($carts as $item)
				@if( isset($item['product']) )
					@php 
						$product = $item['product']
					@endphp
					<tr>
						<td>{{$product->name}}</td>
						<td>{{$product->price}}</td>
						<td>
							<select style="width: 50px;" 
								onchange="changeQuantityCart(event, '{{$item['id']}}')">
								@foreach(range(1, $product->inventory) as $i)
									<option {{$item['quantity'] == $i ? 'selected' : ''}}  value="{{$i}}">{{$i}}</option>
								@endforeach
							</select>
						</td>
						<td>
							{{number_format($product->price * $item['quantity'])}}
						</td>
						<td>
							<a href="{{route('cart.item.delete', $item['id'])}}"><strong style="color: red;">X</strong></a>
						</td>
					</tr>
				@endif
			@endforeach
		</table>
		<div>
			<p>قیمت نهایی: <strong>{{ number_format(Cart::sum()) }}</strong></p>
		</div>
		<form action="{{route('cart.change.quantity')}}" method="post" id="form-update">
			@method('patch')
			@csrf
			<input type="hidden" name="id" id="id">
			<input type="hidden" name="quantity" id="quantity">
		</form>
		<form method="post" action="{{route('cart.payment')}}" id="payment-form">
			@csrf
		</form>
		<button class="btn btn-success" onclick="document.getElementById('payment-form').submit();">
			پرداخت
		</button>
	</div>

	@include('sweet::alert')
@endsection

@section('script')
	<script>
		function changeQuantityCart(event, id)
		{
			document.getElementById('id').value = id;
			document.getElementById('quantity').value = event.target.value;
			document.getElementById('form-update').submit();
			// location.reaload();
		}
		// function db(event)
		// {
		// 	alert(event.target.value);
		// 	location.reload();
		// }
	</script>
@endsection