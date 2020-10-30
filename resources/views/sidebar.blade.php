@extends('layouts.app')

@section('style')
	<style type="text/css">
		body{
			text-align: right;
			direction: rtl;
		}
		ul{
			padding: 0;
		}
		#main{
			position: relative;
		}
		#sidebar{
		    position: relative;
		    right: :0;
		    top: 0;
		    width: 250px;
		    transition: 1s right;
		    -webkit-transition: 1s right;
		}
		.right{
			right:-265px;
		}
		
	</style>
@endsection

@section('content')
	<div id="main" class="container-fluid">
		{{-- <div id="content">
			<h3>Main Content</h3>
		</div> --}}
		<div id="sidebar">
			<ul class="list-group">
				<li class="list-group-item">Home</li>
				<li class="list-group-item">Contact</li>
				<li class="list-group-item">About Me</li>
				<li class="list-group-item">Logout</li>
			</ul>
		</div>
		<button class="btn btn-success" onclick="toggle()">Toggle</button>
	</div>

@endsection


@section('script')
	<script>
		function toggle()
		{
			$('#sidebar').toggleClass('right');
		}
	</script>

@endsection