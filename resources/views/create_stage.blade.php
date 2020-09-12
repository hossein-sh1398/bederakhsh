<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link type="text/css" rel="stylesheet" href="/kamaDatepicker-master/dist/kamadatepicker.min.css" />

	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

	<script src="/kamaDatepicker-master/dist/kamadatepicker.min.js"></script>
	<script src="/kamaDatepicker-master/dist/kamadatepicker.holidays.js"></script>
</head>

<body>
	<div>
		<div class="container mt-4 d-flex justify-content-center">
			<div class="card" style="width: 50%; margin-bottom: 30px;">
				<div class="card-header">
					Input Form Stage
				</div>
				<div class="card-body">
					<form action="{{url('stage')}}" method="post">
						@csrf
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" autocomplete="off" class="form-control">
						</div>
						<div class="form-group">
							<label>Description</label>
							<input type="text" name="description" autocomplete="off" class="form-control">
						</div>
						<div class="form-group">
							<label>Count</label>
							<input type="number" name="count" class="form-control">
						</div>
						<div class="form-group">
							<label>Start Date</label>
							<input type="text" id="date1" autocomplete="off" name="start_date" class="form-control">
						</div>
						<div class="form-group">
							<label>End Date</label>
							<input type="text" id="date2" autocomplete="off" name="end_date" class="form-control">
						</div>
						<div class="form-group">
							<label>Vote Date</label>
							<input type="text" id="date3" autocomplete="off" name="vote_date" class="form-control">
						</div>
						<div class="form-group">
							<label>Periods</label>
							<select class="form-control" name="period_id">
								@foreach($periods as $id => $name)
									<option value="{{$id}}">
										{{$name}}
									</option>
								@endforeach
							</select>
						</div>	
						<div class="form-group">
							<label>Status</label>
							<select class="form-control" name="status">
								<option value="published">
									منتشر شده
								</option>
							</select>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">
								Save
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@include('sweet::alert')
</body>
</html>

<script>
	var customOptions = {
			nextButtonIcon: "/kamaDatepicker-master/demo/assets/timeir_prev.png"
			, previousButtonIcon: "/kamaDatepicker-master/demo/assets/timeir_next.png"
		};

		kamaDatepicker('date1', customOptions);
		kamaDatepicker('date2', customOptions);
		kamaDatepicker('date3', customOptions);
</script>