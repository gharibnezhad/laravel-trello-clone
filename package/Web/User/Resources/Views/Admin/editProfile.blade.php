@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('users.index') }}" title="کاربران">کاربران</a></li>
    <li><a href="#" title="ویرایش کاربر">ویرایش کاربر</a></li>
@endsection
@section('content')
    <div class="row no-gutters margin-bottom-20  ">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی کاربر</p>
            <form action="{{ route('users.updateProfile',$user->id) }}" id="profileForm"
                  data-confirm-url="{{ route('users.confirm-password') }}"
                  data-email-change-url="{{ route('users.email-change.request', $user->id) }}"
                  class="padding-30" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <input type="hidden" id="originalEmail" value="{{ $user->email }}">
                <x-input type="text" name="name"  class="text" placeholder="نام و نام خانوادگی" value="{{$user->name}}"/>
                <x-input type="email" name="email" id="email" class="text" placeholder="ایمیل" value="{{$user->email}}" autocomplete="off"/>
                <x-input type="text" name="username" placeholder="نام کاریری" class="text" value="{{$user->username}}" />
                <x-input type="text" name="mobile" placeholder="موبایل" class="text" value="{{$user->mobile}}" />
                <x-input type="password" name="password" class="text" placeholder="رمز عبور جدید" value="" autocomplete="new-password"/>
                <div id="passwordModal" style="display:none">
                    <input type="password" id="current_password" placeholder="Current Password">
                    <span id="passwordError"></span>
                    <button class="btn btn-webamooz_net" type="button" id="confirmPasswordBtn">تایید</button>
                </div>
                <br>
                <button class="btn btn-webamooz_net">بروزرسانی کاربر</button>
            </form>

        </div>
    </div>
@endsection

