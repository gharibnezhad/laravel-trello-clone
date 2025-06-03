@extends('User::Front.master')

@section('content')

    <div class="form">
        <a class="account-logo" href="index.html">
            <img src="/img/weblogo.jpg" alt="">
        </a>
        <div class="form-content form-account">


            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success" role="alert">
                    {{ __('یک لینک تأیید جدید به آدرس ایمیلی که هنگام ثبت نام ارائه داده‌اید ارسال شده است.') }}
                </div>
            @endif

            قبل از ادامه لطفا ایمیلتان را چک کنید
            اگر ایمیلی دریافت نکرده ایددرخواست ارسال مجدد لینک بدهید.

            <form method="POST" action="{{ route('verification.send') }}" class="d-inline">
                @csrf

                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                    ارسال مجدد کد لینک تایید
                </button>
            </form>

            <a href="/" class="">بازگشت به صفحه اصلی</a>

        </div>

    </div>
@endsection
