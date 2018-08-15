<!doctype html>

<html lang="{{ app()->getLocale() }}">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title> A Star Academy @yield('title') </title>

        @include('includes.stylesheets')
        
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

        @yield('css')
        
    </head>

    <body>
            
        @include('includes.sidebar')

        
        <main>
        
            <section class="container my-3">

                @yield('content')
            
            </section>
            
        </main>

        @include('includes.scripts')

        @yield('scripts')

    </body>

</html>


