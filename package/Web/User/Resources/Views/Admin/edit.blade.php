@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('users.index') }}" title="کاربران">کاربران</a></li>
    <li><a href="#" title="ویرایش کاربر">ویرایش کاربر</a></li>
@endsection
@section('content')
    <div class="row no-gutters margin-bottom-20  ">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی کاربر</p>
            <form action="{{ route('users.update',$user->id) }}" class="padding-30" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <input type="text" name="name"  class="text" placeholder="نام و نام خانوادگی" value="{{$user->name}}">
                <input type="text" name="email" placeholder="ایمیل" class="text" value="{{$user->email}}" required />
                <input type="text" name="username" placeholder="نام کاریری" class="text" value="{{$user->username}}" />
                <input type="text" name="mobile" placeholder="موبایل" class="text" value="{{$user->mobile}}" />
                <select name="status" required>
                    <option value="">وضعیت حساب</option>
                    @foreach(\Web\User\Models\User::$status as $status)
                        <option value="{{ $status }}"
                                @if($status == $user->status) selected @endif>{{$status}}</option>
                    @endforeach
                </select>


                 <select name="role[]" class="no-plugin"  multiple>
                    <option value="" disabled>یک نقش کاربری انتخاب کنید :</option>
                    @foreach($roles as $role)
                         <option value="{{ $role->id }}" {{$user->roles->contains($role->id) ? 'selected' : ''}}>
                        {{$role->name}}</option>
                    @endforeach
                 </select>

                <br>
                <button class="btn btn-webamooz_net">بروزرسانی کاربر</button>
            </form>
        </div>
    </div>
@endsection
