@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-header">
				video number {{$video->id}}
			</div>
			<div class="card-body">
				<h3>{{$video->title}}</h3>
				<div class="card-footer">
					<span>View:</span>{{$video->views->count()}}
				</div>
			</div>
		</div>
	</div>
@stop