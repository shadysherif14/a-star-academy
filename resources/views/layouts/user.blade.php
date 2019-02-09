@extends('layouts.main') 
@section('body')
    @include('user.includes.navbar')

<div class="main-content">
    @yield('content')
</div>
    @include('partials.footer') 
@stop @push('css')
<link rel="stylesheet" href="{{ asset_path('css/user/main.css') }}"> 
@endpush @push('scripts')
<script src="{{ asset_path('js/user/home.js') }}"></script>

@endpush