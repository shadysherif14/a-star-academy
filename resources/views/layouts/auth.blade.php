<!doctype html>

<html lang="{{ app()->getLocale() }}">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> A Star Academy </title>
    @include('includes.stylesheets') @stack('css')

    <link rel="stylesheet" href="{{ asset_path('css/auth/index.css') }}">

</head>

<body class="">

    <div class="content">
        <div class="w-75 mx-auto wrapper">
            @yield('form')
        </div>
    </div>

    <div class="image"></div>
    @include('includes.scripts') @stack('scripts')

</body>

</html>