<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('images/vrms-logo.png')}}" rel="shortcut icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('vendor/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/css/style.css')}}">
</head>
<body>
<div id="global-loader">
    <div class="whirly-loader"> </div>
</div>
<div class="main-wrapper">
    @if(auth()->user()->is_admin == '1')
        @include('layouts.v2.header-area')
        @include('layouts.v2.sidebar-area')
    @else
        @include('layouts.v3.header-area')
        @include('layouts.v3.sidebar-area')
    @endif
    <main class="py-4">
        <div class="page-wrapper">
            @yield('content')
        </div>
    </main>
</div>

<script src="{{asset('vendor/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('vendor/js/feather.min.js')}}"></script>
<script src="{{asset('vendor/js/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('vendor/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/plugins/apexchart/apexcharts.min.js')}}"></script>
<script src="{{asset('vendor/plugins/apexchart/chart-data.js')}}"></script>
<script src="{{asset('vendor/js/script.js')}}"></script>
</body>
</html>
