<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="google-site-verification" content="ZIaKitojTUkvkpAYAOZoiPqZxacFvyy5ANRBXSIPcUY" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TakeHome') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
</head>

<body>

    @include('includes.navbar-auth')

    @yield('content')

    @include('includes.footer')

    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
</body>

</html>
