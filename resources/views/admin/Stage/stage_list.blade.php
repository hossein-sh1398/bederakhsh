@component('Admin.component', ['title' => 'لیست استیج ها'])

@slot('breadcrumb')
	<li class="breadcrumb-item"><a href="{{url('admin')}}">خانه</a></li>
  	<li class="breadcrumb-item active">لیست استیج ها</li>
@endslot

@slot('body')
	<div class=" mt-4 d-flex justify-content-center">
		<div class="card" style="width: 95%; margin-bottom: 30px;">
			<div class="card-header">
				<div class="d-flex justify-content-between">
					<span>
						لیست استیج ها
					</span>
					<div class="d-flex justify-content-between">
						<a href="{{route('admin.stage.create')}}" class="btn btn-success btn-sm ml-2 pt-2">ایجاد</a>
						<form class="d-flex justify-content-between">
							<input 	type="text" 
									name="search" 
									value="{{request('search')}}"
									autocomplete="off"
									class="form-control" placeholder="جستجو...">
							<button class="btn btn-primary"><i class="fa fa-search"></i></button>
						</form>
					</div>	
				</div>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<td>عنوان</td>
							<td>توضیحات</td>
							<td>دوره</td>
							<td>تاریخ شروع</td>
							<td>تاریخ پایان</td>
							<td>تاریخ رای گیری</td>
							<td>اقدامات</td>
						</tr>
					</thead>
					<tbody>
						@foreach($stages as $stage)
							<tr>
								<td>{{$stage->name}}</td>
								<td>{{$stage->description}}</td>
								<td>{{$stage->period->name ?? ''}}</td>
								<td>{{jdate($stage->start_date)->format('Y-m-d')}}</td>
								<td>{{jdate($stage->end_date)->format('Y-m-d')}}</td>
								<td>{{jdate($stage->vote_date)->format('Y-m-d')}}</td>
								<td>
									<a href="">ویرایش</a>
									<a href="">حذف</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endslot

@endcomponent
					

