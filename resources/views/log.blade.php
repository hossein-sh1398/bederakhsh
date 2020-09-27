<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post" action="{{route('logout')}}">
		@csrf
		<button type="submit">Log</button>
	</form>
</body>
</html>