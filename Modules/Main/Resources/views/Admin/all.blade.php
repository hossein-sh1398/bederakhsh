@component('Admin.component', ['title' => 'مدریت ماژول ها'])

@slot('breadcrumb')
    <li class="breadcrumb-item"><a href="{{url('admin')}}">خانه</a></li>
    <li class="breadcrumb-item active">لیست ماژول ها</li>
@endslot

@slot('body')
    <div class=" mt-4 d-flex justify-content-center">
        <div class="card" style="width: 95%; margin-bottom: 30px;">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <span>
                        لیست ماژول های موجود
                    </span> 
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>نام</th>
                            <th>نام فارسی</th>
                            <th>توضیحات</th>
                            <th>وضعیت</th>
                            <th>امکانات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($modules as $module)
                            <tr>
                                <td>{{$module->get('name')}}</td>
                                <td>{{$module->get('title')}}</td>
                                <td>{{$module->get('description')}}</td>
                                <td>
                                    @if( Module::isEnable( $module->get('name') ) )
                                        <span class="badge badge-success">فعال</span>
                                    @else
                                        <span class="btn badge badge-warning">غیر فعال</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        @if( Module::isEnable( $module->get('name') ) )
                                             @if (Module::canDisable($module->get('name')))
                                                <a href="{{route('admin.main.module.disable', $module->getName())}}" class="btn btn-warning ml-1 btn-sm">غیر فعال</a>
                                            @endif
                                        @else
                                            <a href="{{route('admin.main.module.enable', $module->getName())}}" class="btn btn-success ml-1 btn-sm">فعال</a>
                                        @endif
                                        {{-- <a href="{{route('admin.main.module.delete', $module->getName())}}" class="btn btn-danger btn-sm">حذف</a> --}}
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