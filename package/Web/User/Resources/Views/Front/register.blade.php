@extends('User::Front.master')

@section('content')
    <form action="{{route('register')}}" class="form" method="post">
        @csrf
        <a class="account-logo" href="index.html">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            <input type="text" name="name" class="txt @error('name') is-invalid @enderror" placeholder="نام و نام خانوادگی"
                    value="{{old('name')}}" required autocomplete="name" autofocus>
            @error('name')
            <spn class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
            </spn>
            @enderror

            <input type="email" name="email" class="txt @error('email') is-invalid @enderror" placeholder="ایمیل"
                    value="{{old('email')}}" required autocomplete="email" autofocus>
            @error('email')
            <spn class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
            </spn>
            @enderror

            <input type="number" name="mobile" class="txt @error('mobile') is-invalid @enderror" placeholder="شماره موبایل"
                    value="{{old('mobile')}}"  autocomplete="mobile" autofocus>
            @error('mobile')
            <spn class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
            </spn>
            @enderror


            <input type="password" name="password" class="txt @error('password') is-invalid @enderror" placeholder="رمز عبور"
                     required autocomplete="new-password" autofocus>

            <input id="password-confirm" type="password" class="txt txt-l @error('password') is-invalid @enderror"
                   placeholder="تایید رمز عبور"
                   name="password_confirmation" required autocomplete="new-password">



            <span class="rules">
                رمز عبور باید حداقل 8 کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.
            </span>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror


            <br>
            <button class="btn continue-btn">ثبت نام و ادامه</button>

        </div>
        <div class="form-footer">
            <a href="{{route('login')}}">صفحه ورود</a>
        </div>
    </form>
@endsection
