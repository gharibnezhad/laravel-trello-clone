<header class="border-b border-black/10 dark:border-white/10">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
        <div class="flex items-center gap-3">
            <svg class="h-8 w-8 text-primary" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.8261 30.5736C16.7203 29.8826 20.2244 29.4783 24 29.4783C27.7756 29.4783 31.2797 29.8826 34.1739 30.5736C36.9144 31.2278 39.9967 32.7669 41.3563 33.8352L24.8486 7.36089C24.4571 6.73303 23.5429 6.73303 23.1514 7.36089L6.64374 33.8352C8.00331 32.7669 11.0856 31.2278 13.8261 30.5736Z" fill="currentColor"></path>
            </svg>
            <a href="{{ url('/') }}" class="flex items-center gap-2">
            <h1 class="text-xl font-bold text-black dark:text-white">TaskFlow</h1>
            </a>
        </div>


        <div class="flex items-center gap-2">
            @if(!request()->routeIs('login'))
                <a href="{{ route('login') }}" class="rounded bg-primary/20 px-4 py-2 text-sm font-semibold text-primary
                 transition-colors hover:bg-primary/30 dark:bg-primary/30 dark:hover:bg-primary/40">Log in</a>

            @endif
            @if(!request()->routeIs('register'))
            <a href="{{ route('register') }}" class="rounded bg-primary px-4 py-2 text-sm font-semibold text-white
             transition-opacity hover:opacity-90">Get started</a>
            @endif
        </div>
    </div>
</header>
