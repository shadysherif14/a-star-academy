@extends('layouts.main')

@section('layout_css')
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">    
@stop

@section('body') 
    @yield('content') 
@stop

