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
			<div class="card" style="width: 95%; margin-bottom: 30px;">
				<div class="card-header">
					Stage List
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>Name</th>
								<th>Description</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Vote Date</th>
							</tr>
						</thead>
						<tbody>
							@foreach($stages as $stage)
								<tr>
									<td>{{$stage->name}}</td>
									<td>{{$stage->description}}</td>
									<td>{{jdate($stage->start_date)->format('Y-m-d')}}</td>
									<td>{{jdate($stage->end_date)->format('Y-m-d')}}</td>
									<td>{{jdate($stage->vote_date)->format('Y-m-d')}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	@include('sweet::alert')
</body>
</html>