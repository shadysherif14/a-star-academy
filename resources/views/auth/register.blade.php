@extends('layouts.auth') 

@section('content')

<form main_action="{{ route('register') }}" method="post" class="z-depth-3 ajax" enctype="multipart/form-data" id="register">

    @csrf

    <div class="body">

        <div id="basic-info" action="{{ route('config.basic') }}" class="">

            <div class="content">

                <div class="md-form">

                    <input type="text" name="name" class="form-control">

                    <label for="name"> Name </label>

                </div>

                <div class="md-form">

                    <input type="text" name="username" class="form-control">

                    <label for="username"> Username </label>

                </div>

                <div class="md-form">

                    <input type="email" name="email" class="form-control">

                    <label for="email"> Email </label>

                </div>

                <div class="md-form">

                    <input type="password" name="password" class="form-control">

                    <label for="password"> Password </label>

                </div>

                <div class="md-form">

                    <input type="password" name="password_confirmation" class="form-control">

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

                <div parent="gender" class="btn-group-wrapper">
                    <div class="btn-group grid" data-toggle="buttons" id="gender">
                        <label class="btn form-check-label">
                        <input class="form-check-input" type="radio" name="gender" value="Male"> Male
                    </label>
                        <label class="btn form-check-label">
                        <input class="form-check-input" type="radio" name="gender" value="Female"> Female
                    </label>

                    </div>
                </div>

                <div parent="school" class="btn-group-wrapper">
                    <div class="btn-group grid" data-toggle="buttons" id="school">
                        <label class="btn form-check-label">
                            <input class="form-check-input" type="radio" name="school" value="American Diploma"> American Diploma
                        </label>
                        <label class="btn form-check-label">
                            <input class="form-check-input" type="radio" name="school" value="IGCSE"> IGCSE
                        </label>
                    </div>
                </div>

                <div parent="level" class="btn-group-wrapper hidden">
                    <div class="btn-group grid" data-toggle="buttons" id="level">
                        <label class="btn form-check-label">
                            <input class="form-check-input" type="radio" name="level" value="8th Grade"> 8th Grade 
                        </label>
                        <label class="btn form-check-label">
                            <input class="form-check-input" type="radio" name="level" value="9th Grade"> 9th Grade
                        </label>
                        <label class="btn form-check-label">
                            <input class="form-check-input" type="radio" name="level" value="IG"> IG
                        </label>
                    </div>
                </div>

            </div>

            <button type="button" id="basic-info-btn" class="btn btn-submit"> <i class="fas fa-angle-right"></i> Next </button>
        </div>

        <div id="courses-info" class="hidden">

    
        </div>
    </div>


</form>

<div class="modal animated bounceIn" id="error-modal">
    <div class="modal-dialog modal-dialog-centered modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">

                <p class="heading lead"> Error </p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="white-text">&times;</span>
            </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-times fa-4x mb-3 animated rotateIn text-danger"></i>
                    <p id="error-msg"></p>
                </div>
            </div>

        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Central Modal Medium Danger-->

@stop 
@push('css')
    {{--  <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">   --}}
@endpush 

@push('scripts')
    <script src="{{ asset('js/Auth/register.js') }}"></script>
@endpush