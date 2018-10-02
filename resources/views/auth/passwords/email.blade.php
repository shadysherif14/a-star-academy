@extends('layouts.auth') 
@section('form')

<form class="form" method="POST" action="{{ route('password.email') }}">

    @csrf
    <div class="header">
        <div class="logo-container">
            <img src="/assets/images/logo.svg" alt="">
        </div>
        <h5>Forgot Password?</h5>
        <span>Enter your e-mail address below to reset your password.</span>
    </div>
    <div class="content">
        <div class="input-group input-lg">
            <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Email">
            <span class="input-group-addon">
                <i class="zmdi zmdi-email"></i>
            </span>
        </div>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="footer text-center">
        <button type="submit" class="btn btn-primary btn-round btn-lg btn-block waves-effect waves-light">RESET</button>
    </div>
</form>

@stop