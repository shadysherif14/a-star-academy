@extends('layouts.auth') 
@section('form')


<form class="form" action="{{ route('login') }}" method="POST">

    @csrf
    
    <div class="header">
        <div class="logo-container">
            <img src="./assets/images/logo.svg" alt="" />
        </div>
        <h5>Log in</h5>
    </div>

    <div class="content">

        <div class="input-group input-lg">
            <input type="text" class="form-control" name="username" placeholder="Enter User Name" />
            <span class="input-group-addon">
                <i class="zmdi zmdi-account-circle"></i>
            </span>
        </div>

        <div class="input-group input-lg">
            <input type="password" placeholder="Password" name="password" class="form-control" />
            <span class="input-group-addon">
                <i class="zmdi zmdi-lock"></i>
            </span>
        </div>

    </div>
    <div class="footer text-center">
        <button type="submit" class="btn btn-primary btn-round btn-lg btn-block ">SIGN IN</button>
        <h5>
            <a href="./forgot-password.html" class="link">Forgot Password?</a>
        </h5>
    </div>
</form>

@stop

@push('css') 

@endpush 

@push('scripts')

@endpush