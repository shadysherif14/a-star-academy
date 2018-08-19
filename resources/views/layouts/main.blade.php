<!doctype html>

<html lang="{{ app()->getLocale() }}">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title> A Star Academy @yield('title') </title>

        @include('includes.stylesheets')
        
        @yield('layout_css')

        @yield('css')
        
    </head>

    <body>
            
        @yield('body')

        @include('includes.scripts')
                
        @yield('layout_scripts')

        @yield('scripts')

    </body>

</html>


