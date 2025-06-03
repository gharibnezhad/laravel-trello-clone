@extends('User::Front.master')

@section('content')
<form action="{{route('login')}}" class="form" method="post">
    @csrf
    <a class="account-logo" href="index.html">
        <img src="img/weblogo.jpg" alt="">
    </a>
    <div class="form-content form-account">
        <input type="text" name="login" class="txt @error('login') is-invalid @enderror" placeholder="ایمیل یا شماره موبایل"
               value="{{ old('login') }}" required autocomplete="username" autofocus>

        @error('login')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
        @enderror


        <input type="password" name="password" class="txt" placeholder="رمز عبور"
               required autocomplete="current-password" autofocus>

        @error('password')
        <span class="invalid-feedback" role="alert">
                   <strong>{{ $message }}</strong>
                   </span>
        @enderror

        <br>
        <button class="btn btn--login">ورود</button>
        <label class="ui-checkbox">
            مرا بخاطر داشته باش
            <input type="checkbox" id="remember" checked="checked" {{old('remember' ? 'checked' : '')}}>
            <span class="checkmark"></span>
        </label>
        <div class="recover-password">
            <a href="{{route('password.request')}}">بازیابی رمز عبور</a>
        </div>
    </div>
    <div class="form-footer">
        <a href="{{route('register')}}">صفحه ثبت نام</a>
    </div>
</form>
@endsection
