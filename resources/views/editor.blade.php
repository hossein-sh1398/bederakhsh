<!DOCTYPE html>
<html>
<head>
    <title>Vandaw Cart</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<!-- <script src="/js/ckeditor_full_4/ckeditor.js"></script> -->
	<script src="/js/ckeditor_standard_4/ckeditor.js"></script>
</head>
<body>
	<div class="container">
	    <div class="row">
	    	<div class="col-12">
	    		<hr>
				<div class="card mt-4">
					<div class="card-header">
						Create Article Form
					</div>
					<div class="card-body">
					    <form action="/" method="post" enctype="multipart/form-data">
					    	@csrf
					    	<div class="form-group">
					    		<div class="input-group">
					    		<input type="text" id="image_label" class="form-control" name="image"
					           aria-label="Image" aria-describedby="button-image">
							    <div class="input-group-append">
							        <button class="btn btn-outline-secondary" type="button" id="button-image">Select</button>
							    </div>
								</div>
								<input type="file" name="file">
					    	</div>
					    	<!-- <div class="form-group">
					    		<textarea id="body" class="form-control">
					    			
					    		</textarea>
					    	</div> -->
					    	<div class="form-group">
					    		<button class="btn btn-primary">Upload</button>
					    	</div>
					    </form>
					</div>
				</div>

				<hr>
				<hr>
				<hr>
				<ul class="list-group">
					@foreach( $articles as $key => $article )
						<li class="list-group-item"> 
						<form method="post" action="{{ route( 'like', $article->id ) }}">
								@csrf
								<input type="hidden" name="likeable_type" value="{{ get_class( $article ) }}">
								<button type="submit" class="btn btn-success">Like</button>
							</form>
							<p>
								<div>
									{{$article->title}}
									<span style="color:red;">{{ $article->likes->count() }}</span>
								</div>
								<div>
									@if ( auth()->check() )
										@if ( auth()->user()->liked( $article ) )
											<strong style="color: red;">Like</strong>
										@else
											<strong>Like</strong>
										@endif
									@else
										<strong>Like</strong>
									@endif
									
								</div>	
							</p>
						</li>
					@endforeach
				</ul>
	    	</div>
	    </div>
	</div>
    <script>
  
		CKEDITOR.replace('body', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'});

    	document.addEventListener("DOMContentLoaded", function() {

  			document.getElementById('button-image').addEventListener('click', (event) => {
    		event.preventDefault();

    		window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
  			});
		});

		// set file link
		function fmSetLink($url) {
		  document.getElementById('image_label').value = $url;
		}

    </script>
</body>
</html>