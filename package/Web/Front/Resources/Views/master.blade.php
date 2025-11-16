<!DOCTYPE html>
<html lang="en">
@include('Front::layouts.head')
<body class="bg-background-light dark:bg-background-dark font-display">
<div class="relative flex min-h-screen w-full flex-col">
    @include('Front::layouts.header')
    <main class="flex-1">
        @yield('content')

    </main>
    @include('Front::layouts.footer')
</div>

</body>
</html>
