@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="نقش های کاربری">نقش های کاربری</a></li>
@endsection

@section('content')
    <div class="row no-gutters  ">
        <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">نقش های کاربری</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>نقش های کاربری</th>
                        <th>مجوزها</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr role="row" class="">
                            <td><a href="">{{$role->id}}</a></td>
                            <td><a href="">{{$role->name}}</a></td>
                            <td>
                                <ul>
                                    @foreach($role->permissions as $permission)
                                        <li> {{$permission->name}}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <form action="{{ route('role-permissions.destroy', $role->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="item-delete mlg-15" title="حذف" onclick="return confirm('آیا مطمئن هستید؟')"></button>
                                </form>
                                <a href="{{route('role-permissions.edit',$role->id)}}" class="item-edit "
                                   title="ویرایش"></a>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-4 bg-white">
            @include('RolePermissions::create')
        </div>
    </div>
@endsection

