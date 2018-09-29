@extends('layouts.main')

        
@push('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush
                
@section('body')
    @yield('content')
@stop







