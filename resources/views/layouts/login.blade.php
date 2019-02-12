@extends('layouts.auth') 

@section('form')

 <!-- LINE BREAK -->
    @if ($errors->get('customMessage') && $errors->get('errorOwner'))
    <!-- LINE BREAK -->
    <div class="alert alert-danger text-white">
        Your account already logged in, you can either
        <a href="#" id="logOutAll" data-error-owner="{{ $errors->first('errorOwner') }}" class="font-underline text-white">
            logout all other devices and try login again
        </a> or ignore this message.
    </div>
    @endif 
    
    @if($errors->get('blocked'))
    <div class="alert alert-danger text-white">
        This account has been blocked if you have any inquiries about the blocking reason you can contact our customer service.
    </div>
    @endif

<h3>
    <a href="{{ route('home') }}">
        Welcome to {{ config('app.name') }}
    </a>
</h3>


<!-- LINE BREAK -->
<form action="{{ url('login') }}" method="POST">

    @csrf

    <div class="input-group mb-0 mt-2">
        <input type="text" class="form-control" name="login" placeholder="Username or Email" value="{{ old('login') }}" />
        <span class="input-group-addon">
            <img src="{{ imageIcon('user') }}" alt="" class="icon">
        </span>
    </div>

    <div class="input-group mb-0 mt-2">
        <input type="password" placeholder="Password" name="password" class="form-control" value="{{ old('password') }}" />
        <span class="input-group-addon">
            <img src="{{ imageIcon('key') }}" alt="" class="icon">
        </span>
    </div>

    <div class="text-right">
        <a href="{{ url('password/reset') }}" class="btn btn-link text-white"> Forget Password? </a>
    </div>

    <div class="checkbox">
        <input id="remember" name="remember" value="1" type="checkbox">
        <label for="remember"> Remeber Me </label>
    </div>

    <button type="submit" class="btn">SIGN IN</button>
</form>

@yield('register')


@stop 

@push('scripts')

<script src="{{ asset_path('js/auth/login.js') }}"></script>

@endpush