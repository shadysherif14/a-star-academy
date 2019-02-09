@extends('layouts.main')

        
@push('css')
    <link rel="stylesheet" href="{{ asset_path('css/style.css') }}">
@endpush
                
@section('body')
    @yield('content')
@stop







