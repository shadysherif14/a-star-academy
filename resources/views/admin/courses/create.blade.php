@extends('layouts.admin') 

@section('title', 'Admin Dashboard') 

@section('content')


<div class="card w-75 mx-auto">

    <div class="card-header elegant-color-dark white-text">

        <h4> <i class="fas fa-graduation-cap"></i> New Course </h4>

    </div>

    <div class="card-body">

        <form action="/admin/courses" method="post" class="p-3" enctype="multipart/form-data">

            @csrf

            <div class="md-form">

                <input type="text" name="name" id="name" class="form-control">

                <label for="name"> Course Name </label>

                <small class="text-danger d-block font-weight-bold"> {{ $errors->first('name') }} </small>

            </div>

            <div class="md-form">

                <textarea type="text" rows="4" name="description" id="description" class="form-control md-textarea"></textarea>

                <label for="description"> Course Description </label>

                <small class="text-danger d-block font-weight-bold"> {{ $errors->first('description') }} </small>

            </div>

            <div class="md-form">

                <div class="file-field">
                    
                    <a class="btn-floating elegant-color-dark mt-0 float-left">
                        <i class="fas fa-image" aria-hidden="true"></i> <input type="file" name="image">
                    </a>

                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload an image">
                    </div>

                </div>

                <small class="text-danger d-block font-weight-bold"> {{ $errors->first('image') }} </small>
                
            </div>


            <div class="btn-group" data-toggle="buttons" id="school">
                @foreach($schools as $school)
                <label class="btn btn-rounded waves-effect btn-elegant form-check-label" style="width: 200px;">
                    <input class="form-check-input" type="radio" name="school" value="{{ $school }}"> {{ $school }}
                </label>
                @endforeach
            </div>
            <small class="text-danger d-block font-weight-bold"> {{ $errors->first('school') }} </small>    

            
            <div class="btn-group hidden" data-toggle="buttons" id="system">
                @foreach($systems as $system)
                <label class="btn btn-rounded waves-effect btn-elegant form-check-label" style="width: 200px;">
                    <input class="form-check-input" type="radio" name="system" value="{{ $system }}"> {{ $system }}
                </label>
                @endforeach
            </div>
            <small class="text-danger d-block font-weight-bold"> {{ $errors->first('system') }} </small>    


            
            <div class="btn-group hidden" data-toggle="buttons" id="sub_system">

                @foreach($subSystems as $subSystem)
                <label class="btn btn-rounded waves-effect btn-elegant form-check-label" style="width: 100px;">
                    <input class="form-check-input" type="radio" name="sub_system" value="{{ $subSystem }}"> {{ $subSystem }}
                </label>
                @endforeach
            </div>
            <small class="text-danger d-block font-weight-bold"> {{ $errors->first('sub_system') }} </small>    


            <div class="md-form">
                <button type="submit" class="btn btn-elegant btn-sm btn-rounded"> Add </button>
            </div>

        </form>

    </div>

</div>
@endsection
 
@section('scripts')
    <script src="{{ asset('js/courses/create.js') }}"></script>
@endsection


@section('css')
    <link rel="stylesheet" href="{{ asset('css/courses/create.css') }}">
@stop
