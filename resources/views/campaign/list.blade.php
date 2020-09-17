@extends('layouts.app')

@section('content')
	<div class="container mt-4">
		<div class="card-body">
			<h2>Campaign List</h2>
			<ul class="list-grout">
				@foreach($campaigns as $campaign)
					<li class="list-group-item">{{$campaign->name}}</li>
				@endforeach
			</ul>
			<div class="card-footer">
				{{$campaigns->onEachSide(2)->links()}}
			</div>
		</div>
	</div>
@endsection