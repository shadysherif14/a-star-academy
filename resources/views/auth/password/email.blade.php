@extends('layouts.auth') 

@section('form')

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <h3>
        <a href="{{ route('home') }}">
            Welcome to {{ config('app.name') }}
        </a>
    </h3>

    <!-- Forget Password Form -->
    <div id="password-reset">

        <p style="color: #ddd">Enter your e-mail address below to reset your password.</span>

        <form class="form" method="POST" action="{{ url('password/email') }}">
        
            @csrf

            <div class="input-group mb-0 mt-2">
                <input type="text" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" />
                <span class="input-group-addon">
                    <img src="{{ imageIcon('email') }}" alt="" class="icon">
                </span>
            </div>

            <button type="submit" class="btn"> SEND PASSWORD RESET LINK </button>

        </form>

        <p class="toggler">
            Remembered Password? <a href="{{ url('/login') }}" class="btn btn-link p-0" id="login-back"> Back to Login </a>
        </p>
    </div>

@stop