@extends('Front::master')

@section('content')
    <div class="flex flex-1 items-center justify-center py-12 bg-background-light dark:bg-background-dark">
        <div class="w-full max-w-md space-y-8 px-4">

            <div class="text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">ایجاد حساب کاربری</h2>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    به جامعه‌ی تسک ‌مستر بپیوندید و پروژه‌هات رو راحت‌تر مدیریت کن.
                </p>
            </div>

            <div class="bg-white dark:bg-[#1b2735] rounded-lg p-8 border border-gray-200 dark:border-gray-700/50">
                <form method="POST" action="{{ route('register') }}" class="space-y-6" dir="rtl">
                    @csrf


                    <div>
                        <label for="name" class="sr-only">نام و نام خانوادگی</label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            required
                            autocomplete="name"
                            placeholder="نام و نام خانوادگی"
                            class="form-input block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-gray-100
                            dark:bg-gray-800/50 focus:border-primary focus:ring-primary h-12 px-4 text-sm text-right
                            dark:text-white placeholder-gray-400 dark:placeholder-gray-500
                        @error('name') border-red-500 @enderror">
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label for="email" class="sr-only">ایمیل</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            placeholder="ایمیل"
                            class="form-input block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-gray-100
                            dark:bg-gray-800/50 focus:border-primary focus:ring-primary h-12 px-4 text-sm text-right
                            dark:text-white placeholder-gray-400 dark:placeholder-gray-500
                        @error('email') border-red-500 @enderror">
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label for="mobile" class="sr-only">شماره موبایل</label>
                        <input
                            id="mobile"
                            name="mobile"
                            type="number"
                            value="{{ old('mobile') }}"
                            autocomplete="tel"
                            placeholder="شماره موبایل"
                            class="form-input block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-gray-100
                            dark:bg-gray-800/50 focus:border-primary focus:ring-primary h-12 px-4 text-sm text-right
                            dark:text-white placeholder-gray-400 dark:placeholder-gray-500
                        @error('mobile') border-red-500 @enderror">
                        @error('mobile')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label for="password" class="sr-only">رمز عبور</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="new-password"
                            placeholder="رمز عبور"
                            class="form-input block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-gray-100
                            dark:bg-gray-800/50 focus:border-primary focus:ring-primary h-12 px-4 text-sm text-right
                            dark:text-white placeholder-gray-400 dark:placeholder-gray-500
                        @error('password') border-red-500 @enderror"
                        >
                        @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label for="password_confirmation" class="sr-only">تایید رمز عبور</label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            autocomplete="new-password"
                            placeholder="تایید رمز عبور"
                            class="form-input block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-gray-100
                            dark:bg-gray-800/50 focus:border-primary focus:ring-primary h-12 px-4 text-sm text-right
                            dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
                        >
                    </div>


                    <p class="text-xs text-gray-500 dark:text-gray-400 leading-5">
                        رمز عبور باید حداقل ۸ کاراکتر و شامل حروف بزرگ، کوچک، اعداد و کاراکترهای خاص مانند @#$% باشد.
                    </p>


                    <div>
                        <button type="submit"
                                class="flex w-full justify-center rounded-lg bg-primary px-4 py-3 text-sm font-semibold
                                text-white shadow-sm hover:bg-primary/90 focus-visible:outline focus-visible:outline-2
                                focus-visible:outline-offset-2 focus-visible:outline-primary">
                            ثبت‌ نام و ادامه
                        </button>
                    </div>
                </form>
            </div>


            <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
                قبلاً حساب دارید؟
                <a href="{{ route('login') }}" class="font-medium text-primary hover:underline">وارد شوید</a>
            </p>
        </div>
    </div>@endsection
