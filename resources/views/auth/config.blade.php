@extends('layouts.auth') 

@section('content')

<form action="{{ route('config.store') }}" method="post" class="z-depth-3 ajax" enctype="multipart/form-data">

    @csrf

    <div class="header">
        <h4> <i class="fas fa-user"></i> Join </h4>
    </div>

    <div class="body">


        <div class="md-form">

            <input type="text" name="name" id="name" class="form-control">

            <label for="name"> Name </label>

        </div>

        <div class="md-form">

            <input type="text" name="username" id="username" class="form-control">

            <label for="username"> Username </label>

        </div>

        <div class="md-form">

            <input type="email" name="email" id="email" class="form-control">

            <label for="email"> Email </label>

        </div>

        <div class="md-form">

            <input type="password" name="password" id="password" class="form-control">

            <label for="password"> Password </label>

        </div>

        <div class="md-form">

            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">

            <label for="password_confirmation"> Confirm Password </label>

        </div>

        <div class="md-form">

            <div class="file-field">

                <a class="">
                    <i class="fas fa-image" aria-grid="true"></i> <input type="file" name="avatar">
                </a>

                <div class="file-path-wrapper">
                    <input class="file-path disabled" type="text" placeholder="Upload an avatar" disabled readonly>
                </div>
            </div>
        </div>


        <div parent="gender" id="gender-wrapper">
            <div class="btn-group grid" data-toggle="buttons" id="gender">
                <label class="btn form-check-label">
                    <input class="form-check-input" type="radio" name="gender" value="Male"> Male
                </label>
                <label class="btn form-check-label">
                    <input class="form-check-input" type="radio" name="gender" value="Female"> Female
                </label>

            </div>
        </div>

    </div>

    <button type="submit" class="btn btn-submit"> <i class="fas fa-plus"></i> Join </button>

</form>

@stop 
@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}"> 
@stop 
@section('scripts')
    <script src="{{ asset('js/Auth/register.js') }}"></script>
@stop