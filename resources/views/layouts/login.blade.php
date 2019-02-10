@extends('layouts.auth')

@section('form')

<form action="@yield('form-action')" method="POST">

    @csrf
    
    <h3> 
        <a href="{{ route('home') }}">
            Welcome to {{ config('app.name') }}
        </a> 
    </h3>

    <div class="input-group">
        <input type="text" class="form-control" name="login" placeholder="Username Or Email" value="{{ old('login') }}" />
        <span class="input-group-addon">
        <img src="{{ imageIcon('user') }}" alt="" class="icon">
    </span>

    </div>

    <div class="input-group">
        <input type="password" placeholder="Password" name="password" class="form-control" value="{{ old('password') }}" />
        <span class="input-group-addon">
            <img src="{{ imageIcon('key') }}" alt="" class="icon">
        </span>
    </div>

    <div class="checkbox">
        <input id="remember" name="remember" value="1" type="checkbox">
        <label for="remember"> Remeber Me </label>
    </div>

    <button type="submit" class="btn ">SIGN IN</button>
</form>

@yield('register')

@stop