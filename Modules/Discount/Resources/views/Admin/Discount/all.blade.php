@component('Admin.component', ['title' => 'لیست کد تخفیف'])

@slot('breadcrumb')
  	<li class="breadcrumb-item"><a href="{{url('admin')}}">خانه</a></li>
  	<li class="breadcrumb-item active">لیست کد تخفیف</li>
@endslot

@slot('body')
		<div class=" mt-4 d-flex justify-content-center">
		<div class="card" style="width: 95%; margin-bottom: 30px;">
			<div class="card-header">
				<div class="d-flex justify-content-between">
					<span>
						لیست کد تخفیف
					</span>
					<div class="d-flex justify-content-between">
						<a href="{{route('admin.discount.create')}}" class="btn btn-success btn-sm ml-2 pt-2">ایجاد</a>
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
				<table class="table" style="font-size:13px;">
					<thead>
						<tr>
							<td>آدی تخفیف</td>
							<td>کد تخفیف</td>
							<td>میزان تخفیف(درصد)</td>
							<td>مهلت استفاده</td>
							<td>متعلق به کاربر</td>
							<td>متعلق به محصول</td>
							<td>متعلق به دسته بندی</td>
							<td>اقدامات</td>
						</tr>
					</thead>
					<tbody>
						@foreach($discounts as $discount)
							<tr>
								<td>{{$discount->id}}</td>
								<td>{{$discount->code}}</td>
								<td>{{$discount->percent}}</td>
								<td>{{jdate($discount->expired_at)->format('Y-m-d')}}</td>
								<td>{{$discount->users->count() ? $discount->users->pluck('name')->join(', ') : 'همه کاربران'}}</td>
								<td>{{$discount->products->count() ? $discount->products->pluck('name')->join(', ') : 'همه محصولات'}}</td>
								<td>{{$discount->categories->count() ? $discount->categories->pluck('title')->join(', ') : 'همه دسته بندی ها'}}</td>
								<td>
									<div class="d-flex justify-content-between">
										<a href="{{route('admin.discount.edit', $discount->code)}}" class="btn btn-warning btn-sm ml-1">ویرایش</a>
										<form action="{{route('admin.discount.destroy', $discount->code)}}" method="post">
											@csrf
											@method('delete')
											<button type="submit" class="btn btn-danger btn-sm">حذف</button>
										</form>
									</div>
										
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