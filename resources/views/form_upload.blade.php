<form method="post" action="{{route('upload.form')}}" enctype="multipart/form-data">
	@csrf
	<input type="file" name="file">
	<button type="Submit">Submit</button>
</form>