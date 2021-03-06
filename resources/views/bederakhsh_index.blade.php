@extends('layouts.app')
@section('content')
	<div class="container">
		<h2>Random Campaign</h2>
		<div class="row">
			@foreach($randomCampaigns as $campaign)
				<div class="col-md-6">
					<h3>{{$campaign->name}}</h3>
				</div>
			@endforeach
		</div>
		<hr>
		<h2>New Campaign</h2>
		<div class="row">
			@foreach($newcampaigns as $campaign)
				<div class="col-md-6">
					<h3>{{$campaign->name}}</h3>
				</div>
			@endforeach
		</div>

		<hr>
		<h2>Best views Campaign</h2>
		<div class="row">
			@foreach($bestViewsCampaign as $campaign)
				<div class="col-md-6">
					<span>count: {{$campaign['count']}}</span>
					<h3>{{$campaign['campaign']->name}}</h3>
				</div>
			@endforeach
		</div>

		<hr>
		<h2>Last Uploaded video For Campaign</h2>
		<div class="row">
			@foreach($lastUploadedVideo as $campaign)
				<div class="col-md-6">
					<span>created_at: {{$campaign['created_at']}}</span>
					<h3>{{$campaign['campaign']->name}}</h3>
				</div>
			@endforeach
		</div>

		<hr>
		<h2>Last Updated Campaign</h2>
		<div class="row">
			@foreach($lastUpdated as $campaign)
				<div class="col-md-6">
					<h3>{{$campaign->name}}</h3>
				</div>
			@endforeach
		</div>
	</div>
@stop
@section('script')
 	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	@include('sweet::alert')
@endsection