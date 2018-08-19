@extends('layouts.main')

@section('layout_css')
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">    
@stop


@section('body')

    @include('includes.sidebar')

    <main>

        @include('includes.navbar')

        <section class="container mt-3">

            @yield('content')
        
        </section>
        
    </main>
    
@stop


