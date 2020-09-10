<div>

	<p>Hello {{$name}}</p>

	<p {{ $attributes->merge( ['class' => 'alert'] ) }}>
		{{$message}}
	</p>

	@if($blue)
		<h3>Blue</h3>
	@endif

</div>