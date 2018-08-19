@extends('layouts.main')

        
@section('layout_css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@stop
                
@section('body')
    @yield('content')
@stop







