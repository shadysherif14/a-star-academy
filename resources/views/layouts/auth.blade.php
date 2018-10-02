<!doctype html>

<html lang="{{ app()->getLocale() }}">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> A Star Academy @yield('title') </title>

    @include('includes.stylesheets') 
    
    <link rel="stylesheet" href="{{ asset('assets/css/authentication.css') }}">
    
    @stack('css')

</head>

<body class="theme-gold authentication">

    @include('partials.loader')
    
    <div class="page-header">
        <div class="page-header-image" style="background-image:url(/assets/images/login.jpg)"></div>
        <div class="container">
            <div class="col-md-12 content-center">
                <div class="card-plain">
                    @yield('form')                    
                </div>
            </div>
        </div>
    </div>

    @include('includes.scripts') 
    
    @stack('scripts')

</body>

</html>