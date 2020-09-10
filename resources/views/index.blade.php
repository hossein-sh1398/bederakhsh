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
		.alert{
			font-size: 20px;
			text-align: center;
			padding: 20px;
		}
			
		.red{
			color: red;
		}
		.green{
			color: green;
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
		
		@php 
			$message = 'this is a component alert'
		@endphp
		<x-alert name='Hossein' :message="$message" class="red"></x-alert>
	</div>
</body>
</html>