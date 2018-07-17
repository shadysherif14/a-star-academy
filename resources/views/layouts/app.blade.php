<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        

        <title> Assessment </title>

        @include('includes.stylesheets')

        @yield('css')
        
    </head>

    <body>
            
        
        @include('includes.navbar')

        @yield('content')

        @include('includes.scripts')

        <!-- CSTF Token -->
        <script>
            function CSRFToken() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }
        </script>

        @yield('scripts')

    </body>
</html>


