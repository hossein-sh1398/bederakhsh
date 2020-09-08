<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.container{
			width: 800px!important;
			display: flex;
			justify-content: center;
		}
		.right{
			text-align: right;
			direction: rtl;
		}
		.left{
			text-align: left;
			direction: ltr;
		}
		ul{
			display: flex;
			justify-content: flex-start;
			padding: 0;
		}
		ul li{
			display: block;
			padding: 15px;
			margin: 5px;
			text-align:right;
			direction: rtl;
		}
	</style>
</head>
<body class="{{app()->getLocale() == 'fa' ? 'right' : 'left'}}">
	<div class="container">
		<header>
			<h1>{{__('messages.title')}}</h1>
			<ul>
				@foreach($categories as $category)
					<li>{{$category->title}}</li>
				@endforeach
			</ul>
		</header>
		
	</div>
</body>
</html>