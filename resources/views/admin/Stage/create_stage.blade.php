@component('Admin.component', ['title' => 'ایجاد مرحله جدید'])

@slot('css')
	<link rel="stylesheet" type="text/css" href="{{url('kamaDatepicker-master/dist/kamadatepicker.min.css')}}">
@endslot

@slot('breadcrumb')
	<li class="breadcrumb-item"><a href="{{url('admin')}}">خانه</a></li>
  	<li class="breadcrumb-item"><a href="{{route('admin.stage.index')}}">استیج</a></li>
  	<li class="breadcrumb-item active">ایجاد</li>
@endslot

@slot('body')
	<div class="mt-4 d-flex justify-content-center">
		<div class="card" style="width: 50%; margin-bottom: 30px;">
			<div class="card-header">
				Input Form Stage
			</div>
			<div class="card-body">
				<form action="{{url('admin/stage')}}" method="post">
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
	
@endslot

@slot('script')
	<script src="{{url('kamaDatepicker-master/dist/kamadatepicker.min.js')}}"></script>
	<script src="{{url('kamaDatepicker-master/dist/kamadatepicker.holidays.js')}}"></script>
	<script>
		var customOptions = {
				nextButtonIcon: "/kamaDatepicker-master/demo/assets/timeir_prev.png"
				, previousButtonIcon: "/kamaDatepicker-master/demo/assets/timeir_next.png"
			};

			kamaDatepicker('date1', customOptions);
			kamaDatepicker('date2', customOptions);
			kamaDatepicker('date3', customOptions);
	</script>

@endslot

@endcomponent
