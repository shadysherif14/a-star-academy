@extends('layouts.login') 

@section('register')
<p class="toggler">
    Doesn't have an account?<a href="{{ route('register') }}"> Create a new one. </a>
</p>

@stop