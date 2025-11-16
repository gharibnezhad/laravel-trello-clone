@extends('Front::master')

@section('content')

    <div class="flex items-center justify-center min-h-screen px-4 py-12 bg-background-light dark:bg-background-dark">
        <div class="w-full max-w-md bg-white dark:bg-[#1b2735] rounded-2xl shadow-lg p-8">
            <div class="flex flex-col items-center gap-4 mb-6">
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <h1 class="text-xl font-bold text-black dark:text-white">TaskFlow</h1>
                </a>
                <p class="text-gray-600 dark:text-gray-300 text-sm">Sign in to your account</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6" dir="rtl">
                @csrf

                <div>
                    <label for="login" class="text-sm font-medium text-black dark:text-white/80">
                        ایمیل یا شماره موبایل
                    </label>
                    <input
                        id="login"
                        name="login"
                        type="text"
                        value="{{ old('login') }}"
                        required
                        autofocus
                        placeholder="ایمیل یا شماره موبایل خود را وارد کنید"
                        class="mt-1 block w-full px-3 py-2 bg-background-light dark:bg-background-dark border border-gray-300
                         dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 text-right focus:outline-none
                         focus:ring-primary focus:border-primary sm:text-sm
                    @error('login') border-red-500 @enderror"
                    >
                    @error('login')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="text-sm font-medium text-black dark:text-white/80">رمز عبور</label>

                    </div>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        placeholder="رمز عبور خود را وارد کنید"
                        class="mt-1 block w-full px-3 py-2 bg-background-light dark:bg-background-dark border
                        border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 text-right
                        focus:outline-none focus:ring-primary focus:border-primary sm:text-sm
                    @error('password') border-red-500 @enderror">
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">فراموشی رمز عبور؟</a>
                </div>


                <div class="flex items-center justify-between">
                    <label class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                        <input
                            type="checkbox"
                            name="remember"
                            class="h-4 w-4 text-primary border-gray-300 rounded focus:ring-primary"
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <span class="ml-2">مرا به خاطر بسپار</span>
                    </label>
                </div>


                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm
                            text-sm font-bold text-white bg-primary hover:opacity-90 focus:outline-none focus:ring-2
                            focus:ring-offset-2 focus:ring-primary">
                        ورود
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm text-gray-600 dark:text-gray-300">
                حساب کاربری ندارید؟
                <a href="{{ route('register') }}" class="text-primary font-semibold hover:underline">ثبت‌نام کنید</a>
            </div>
        </div>
    </div>

@endsection
