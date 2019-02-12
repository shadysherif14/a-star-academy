<!doctype html>

<html lang="{{ app()->getLocale() }}">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> A Star Academy </title>

    <link rel="shortcut icon" href="{{ asset_path('images/logo.png') }}" type="image/x-icon">
    
    @include('includes.stylesheets') @stack('css')

</head>

<body class="theme-gold">
    @include('partials.loader') @yield('body')
    @include('includes.scripts') @stack('scripts')

</body>

</html>