@extends('layouts.login') 

@section('form-action', route('login')) 

{{--  @section('password-reset', route('password.request'))  --}}

@section('register')
    <p class="toggler">
        Doesn't have an account?<a href="{{ route('register') }}"> Create a new one. </a>
    </p>
@stop
