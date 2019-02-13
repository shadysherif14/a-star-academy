@extends('layouts.auth') 
@section('form')
<h3>
    <a href="{{ route('home') }}">
            Welcome to {{ config('app.name') }}
        </a>
</h3>

<form class="form" method="POST" action="{{ url('password/reset') }}">

    @csrf
    <input type="hidden" name="token" value="{{$token}}">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
        <span class="input-group-addon">
                <img src="{{ imageIcon('email') }}" alt="" class="icon">
            </span>
    </div>

    <div class="grid">
        <div class="input-group">
            <input type="password" placeholder="New Password" class="form-control" name="password" value="{{ old('password') }}">
            <span class="input-group-addon">
                    <img src="{{ imageIcon('key') }}" alt="" class="icon">
                </span>
        </div>

        <div class="input-group">
            <input type="password" placeholder="Confirm New Password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
            <span class="input-group-addon">
                    <img src="{{ imageIcon('key') }}" alt="" class="icon">
                </span>
        </div>
    </div>

    <button type="submit" class="btn"> RESET PASSWORD </button>

</form>








@stop