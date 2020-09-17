@component('Admin.component', ['title' => 'ایجاد کد تخفیف'])

@slot('css')
	<link rel="stylesheet" href="{{url('plugins/select2/select2.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('kamaDatepicker-master/dist/kamadatepicker.min.css')}}">
@endslot

@slot('breadcrumb')
	<li class="breadcrumb-item"><a href="{{url('admin')}}">خانه</a></li>
  	<li class="breadcrumb-item"><a href="{{route('admin.discount.index')}}">لیست تخفیف</a></li>
  	<li class="breadcrumb-item active">ایجاد</li>
@endslot

@slot('body')
	<div class="mt-4 d-flex justify-content-center">
		<div class="card" style="width: 50%; margin-bottom: 30px;">
			<div class="card-header">
				فرم ایجاد کد تخفیف
			</div>
			<div class="card-body">
				<form action="{{route('admin.discount.store')}}" method="post">
					@csrf
					<div class="form-group">
						<label>کد تخفیف</label>
						<input type="text" name="code" autocomplete="off" class="form-control">
					</div>
					<div class="form-group">
						<label>درصد تخفیف</label>
						<input type="text" name="percent" autocomplete="off" class="form-control">
					</div>
					<div class="form-group">
						<label>مهلت استفاده</label>
						<input type="text" id="date1" autocomplete="off" name="expired_at" class="form-control">
					</div>
					<div class="form-group">
						<label>مربوط به کاربر</label>
						<select class="form-control select2" name="users[]" multiple>
							@foreach(\App\User::latest()->pluck('name', 'id')->toArray() as $id => $name)
								<option value="{{$id}}">{{$name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>مربوط به محصول</label>
						<select class="form-control select2" name="products[]" multiple>
							<option></option>
							@foreach(\App\Product::latest()->pluck('name', 'id')->toArray() as $id => $name)
								<option value="{{$id}}">{{$name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>مربوط به دسته بندی</label>
						<select class="form-control select2" name="categories[]" multiple>
							<option></option>
							@foreach(\App\Category::latest()->pluck('title', 'id')->toArray() as $id => $name)
								<option value="{{$id}}">{{$name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">
							ذخیره کن
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
	</script>
	<!-- Select2 -->
	<script src="{{url('plugins/select2/select2.full.min.js')}}"></script>
	<script>
		$('.select2').select2();
	</script>
@endslot
@endcomponent
