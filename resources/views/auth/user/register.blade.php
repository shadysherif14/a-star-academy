@extends('layouts.auth') 

@section('form')

<form method="POST" enctype="multipart/form-data">

    @csrf

    <h3> 
        <a href="{{ route('home') }}">
            Welcome to {{ config('app.name') }}
        </a> 
    </h3>
    <div class="step-1 steps" action="{{ route('register.validate') }}">
        
        <ul class="errors"></ul>
        <div class="grid">

            <div class="input-group">
                <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ old('first_name') }}">
                <span class="input-group-addon">
                    <img src="{{ imageIcon('user') }}" alt="" class="icon">
                </span>
            </div>

            <div class="input-group">
                <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}">
                <span class="input-group-addon">
                    <img src="{{ imageIcon('user') }}" alt="" class="icon">
                </span>
            </div>

        </div>

        <div class="input-group">
            <input type="text" class="form-control" placeholder="User Name" name="username" value="{{ old('username') }}">
            <span class="input-group-addon">
                <img src="{{ imageIcon('user') }}" alt="" class="icon">
            </span>
        </div>

        <div class="input-group">
            <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
            <span class="input-group-addon">
                <img src="{{ imageIcon('email') }}" alt="" class="icon">
            </span>
        </div>

        <div class="grid">
            <div class="input-group">
                <input type="password" placeholder="Password" class="form-control" name="password" value="{{ old('password') }}">
                <span class="input-group-addon">
                    <img src="{{ imageIcon('key') }}" alt="" class="icon">
                </span>
            </div>

            <div class="input-group">
                <input type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
                <span class="input-group-addon">
                    <img src="{{ imageIcon('key') }}" alt="" class="icon">
                </span>
            </div>
        </div>

        <button type="button" class="controls btn hvr-bounce-to-top">Next</button>

    </div>

    <div class="step-2 steps" action="{{ route('register') }}">

        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="btn btn-file">
                <span class=""> Upload a profile picture </span>
                <input type="file" name="avatar">
            </div>
            <input disabled class="form-control">
        </div>

        <div parent="gender" class="my-3" id="gender">

            <label class="label" for=""> Gender @include('partials.required') </label>

            <div class="pretty p-jelly p-image p-plain">
                <input type="radio" name="gender" value="Male" />
                <div class="state">
                    <img src="{{ imageIcon('male') }}" alt="" class="icon">
                    <label> Male </label>
                </div>
            </div>

            <div class="pretty p-jelly p-image p-plain">
                <input type="radio" name="gender" value="Female" />
                <div class="state">
                    <img src="{{ imageIcon('female') }}" alt="" class="icon">
                    <label> Female </label>
                </div>
            </div>

        </div>

        <div parent="school" class="my-3" id="school">

            <label class="label" for=""> School System @include('partials.required') </label>

            <div class="pretty p-jelly p-image p-plain">
                <input type="radio" name="school" value="SAT" />
                <div class="state">
                    <img src="{{ imageIcon('school') }}" alt="" class="icon">
                    <label> American Diploma </label>
                </div>
            </div>

            <div class="pretty p-jelly p-image p-plain">
                <input type="radio" name="school" value="IGCSE" />
                <div class="state">
                    <img src="{{ imageIcon('school') }}" alt="" class="icon">
                    <label> IGCSE </label>
                </div>
            </div>

        </div>

        <div parent="level" class="form-group" style="display: none;" id="level" image={{ imageIcon( 'level') }}></div>

        <div class="grid">

            <div class="input-group">
                <div class="input-group-addon">
                    <img src="{{ imageIcon('facebook') }}" alt="" class="icon">
                </div>
                <input type="url" name="accounts[facebook]" class="form-control" placeholder="Facebook Account">
            </div>

            <div class="input-group">
                <div class="input-group-addon">
                    <img src="{{ imageIcon('twitter') }}" alt="" class="icon">
                </div>
                <input type="url" name="accounts[twitter]" class="form-control" placeholder="Twitter Account">
            </div>

            <div class="input-group">
                <div class="input-group-addon">
                    <img src="{{ imageIcon('linkedin') }}" alt="" class="icon">
                </div>
                <input type="url" name="accounts[linkedin]" class="form-control" placeholder="LinkedIN Account">
            </div>

            <div class="input-group">
                <div class="input-group-addon">
                    <img src="{{ imageIcon('phone') }}" alt="" class="icon">
                </div>
                <input type="text" name="phone" class="form-control" placeholder="Phone Number">
            </div>

        </div>

        <i class="controls animated typcn typcn-arrow-left-outline"></i>

        <button type="submit" class="btn">JOIN US</button>

    </div>

</form>

@stop 

@push('scripts')
<script>
    let levels = @json($levels);
</script>
<script src="{{ asset_path('assets/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}"></script>
<script src="{{ asset_path('js/auth/register.js') }}"></script>

@endpush @push('css')
<link rel="stylesheet" href="{{ asset_path('assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}">
@endpush