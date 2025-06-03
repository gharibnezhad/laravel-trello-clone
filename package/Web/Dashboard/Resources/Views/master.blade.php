<!DOCTYPE html>
<html lang="en">
@include('Dashboard::layout.head')
<body>
@include('Dashboard::layout.sidebar')
<div class="content">
    @include('Dashboard::layout.header')
    @include('Dashboard::layout.breadcrumb')
    <div class="main-content">
        @yield('content')
    </div>
</div>
</body>
<script src="{{asset('panel/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('panel/js/js.js')}}"></script>
</html>
