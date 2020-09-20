@extends('layouts.app')

@section('content')
	<div class="container" style="text-align: right;direction: rtl;">
		<table class="table" >
			<tr>
				<th>نام</th>
				<th>قیمت واحد (تومان)</th>
				<th>تعداد</th>
				<th>جمع قیمت (تومان)</th>
			</tr>
			@foreach($carts as $item)
				@if( isset($item['product']) )
					@php 
						$product = $item['product'];
					@endphp
					<tr>
						<td>{{$product->name}}</td>
						<td>
							@if($item['discount_percent'])
								<del>
									<span style="color: red;">
										{{number_format($product->price)}}
									</span>
								</del>
								<span class="mr-2">{{number_format($product->price - ($item['discount_percent'] * $product->price) )}}</span>
							@else
								{{$product->price}}
							@endif
						</td>
						<td>
							<select style="width: 50px;" 
								onchange="changeQuantityCart(event, '{{$item['id']}}')">
								@foreach(range(1, $product->inventory) as $i)
									<option {{$item['quantity'] == $i ? 'selected' : ''}}  value="{{$i}}">{{$i}}</option>
								@endforeach
							</select>
						</td>
						<td>
							@if($item['discount_percent'])
								<del>
									<span style="color: red;">
										{{number_format($product->price * $item['quantity'])}}
									</span>
								</del>
								<span class="mr-2">{{number_format( ( $product->price - ( $item['discount_percent'] * $product->price ) ) * $item['quantity'])}}</span>
							@else
								{{number_format($product->price * $item['quantity'])}}
							@endif

						</td>
						<td>
							<a href="{{route('cart.item.delete', $item['id'])}}"><strong style="color: red;">X</strong></a>
						</td>
					</tr>
				@endif
			@endforeach
		</table>
		<div>
			<p>قیمت نهایی (تومان): 
				<strong>
					{{number_format(Cart::sum())}}
				</strong>
			</p>
		</div>
		<div>
			@if ( in_array( 'Discount', array_keys(\Module::getByStatus(1)) ) )
				@if($discount = Cart::getDiscount())
					<strong>کد تخفیف فعال: {{$discount->code}}</strong> 
					<a href="{{route('discount.delete')}}" class="badge badge-danger">حذف</a>
					<p>میزان تخفیف: {{$discount->percent}} درصد</p>
				@else
					<strong>کد تخفیف دارید؟</strong>
					<form action="{{route('discount.check')}}" method="post">
						@csrf
						<input type="text" name="code">
						@error('code')
						<span style="color:red;">{{$message}}</span>
						@enderror
						<button class="btn btn-success" type="submit">
							اعمال کد تخفیف
						</button>
					</form>
				@endif
			@endif
		</div>
		<br>

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