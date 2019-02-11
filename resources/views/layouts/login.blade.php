@extends('layouts.auth') 
@section('form')
<!-- LINE BREAK -->
@if ($errors->get('customMessage') && $errors->get('errorOwner'))
<!-- LINE BREAK -->
<div class="alert alert-danger text-white">
    Your account already logged in, you can either <a href="#" id="logOutAll" data-error-owner="{{$errors->get('errorOwner')[0]}}"
        class="font-underline text-white">logout all other devices and try login again</a> or ignore this message.
</div>
<!-- LINE BREAK -->
@endif
<form action="@yield('form-action')" method="POST">

    @csrf

    <h3>
        <a href="{{ route('home') }}">
            Welcome to {{ config('app.name') }}
        </a>
    </h3>

    <div class="input-group">
        <input type="text" class="form-control" name="login" placeholder="Email" value="{{ old('login') }}" />
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
@stop @push('scripts')

<script src="{{ asset_path('js/auth/login.js') }}"></script>











@endpush