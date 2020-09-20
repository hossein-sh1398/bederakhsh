@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-header">
				article number {{$article->id}}
			</div>
			<div class="card-body">
				<h3>{{$article->title}}</h3>
				<p class="card-text">
					{{$article->body}}
				</p>
				<div class="card-footer">
					<span>View:</span>{{$article->views->count()}}
				</div>
			</div>
		</div>
	</div>



@stop