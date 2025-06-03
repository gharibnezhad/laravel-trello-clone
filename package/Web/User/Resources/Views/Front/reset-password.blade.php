@extends('User::Front.master')

@section('content')
    <form method="POST" class="form" action="{{route('password.store')}}">

        <a class="account-logo" href="/">
            <img src="/img/weblogo.jpg" alt="">
        </a>
        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="form-content form-account">
            @csrf
            <input id="email" type="email" class="txt txt-l @error('email') is-invalid @enderror"
                   placeholder="ایمیل *" value="{{old('email', $request->email)}}"
                   name="email" required autocomplete="username" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password" type="password" class="txt txt-l @error('password') is-invalid @enderror"
                   placeholder="رمز عبور جدید *"
                   name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password_confirmation" type="password" class="txt txt-l @error('password') is-invalid @enderror"
                   placeholder="تایید رمز عبور جدید *"
                   name="password_confirmation" required autocomplete="new-password">

            @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <span class="rules">رمز عبور باید حداقل 8 کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.</span>



            <br>
            <button class="btn continue-btn">بروزرسانی رمز عبور</button>
        </div>
    </form>

@endsection


