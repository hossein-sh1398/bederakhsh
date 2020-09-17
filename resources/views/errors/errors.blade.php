@if($errors->count())
	@foreach($errors->all() as $error)
		<span style="color: red;">
			{{$error}} 
		</span>
	@endforeach
@endif