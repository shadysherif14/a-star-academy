@extends('layouts.admin') 

@section('title', 'Admin Dashboard') 

@section('content')


<div class="card w-75 mx-auto">

    <div class="card-header elegant-color-dark white-text">

        <h4> <i class="fas fa-chalkboard-teacher"></i> New Instuctor </h4>

    </div>

    <div class="card-body">

        <form action="/admin/instructors" method="post" class="p-3" enctype="multipart/form-data">

            @csrf

            <div class="md-form">

                <input type="text" name="name" id="name" class="form-control">

                <label for="name"> Instructor Name </label>

                <small class="text-danger font-weight-bold"> {{ $errors->first('name') }} </small>

            </div>

            <div class="md-form">

                <textarea type="text" rows="4" name="about" id="about" class="form-control md-textarea"></textarea>

                <label for="about"> About </label>

                <small class="text-danger font-weight-bold"> {{ $errors->first('about') }} </small>

            </div>

            <div class="md-form">

                <div class="file-field">
                    
                    <a class="btn-floating elegant-color-dark mt-0 float-left">
                        <i class="fas fa-user" aria-hidden="true"></i> <input type="file" name="avatar">
                    </a>

                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload an avatar">
                    </div>

                </div>

                <small class="text-danger font-weight-bold"> {{ $errors->first('avatar') }} </small>
                
            </div>

            <div class="md-form">

                <button type="submit" class="btn btn-elegant btn-sm btn-rounded"> Add </button>
            
            </div>

        </form>

    </div>

</div>
@endsection
 
@section('scripts')
    <script src="{{ asset('js/instructors/create.js') }}"></script>
@endsection


@section('css')
    <link rel="stylesheet" href="{{ asset('css/instructors/create.css') }}">
@stop
