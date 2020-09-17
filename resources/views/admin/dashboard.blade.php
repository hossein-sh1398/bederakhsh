@component('Admin.component', ['title' => 'داشبورد پنل مدریت'])

@slot('breadcrumb')
  <li class="breadcrumb-item"><a href="{{url('admin')}}">خانه</a></li>
  <li class="breadcrumb-item active">داشبورد</li>
@endslot

@slot('body')
	
@endslot


@endcomponent