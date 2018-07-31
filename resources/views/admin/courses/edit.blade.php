@extends('layouts.admin') 
@section('title', 'Admin Dashboard') 
@section('content')


<div class="card w-75 mx-auto">

    <div class="card-header elegant-color-dark white-text">

        <h4> <i class="fas fa-graduation-cap"></i> New Course </h4>

    </div>

    <div class="card-body">

        <form action="/admin/courses/{{ $course->slug }}" method="post" class="p-3" enctype="multipart/form-data">

            @csrf

            @method('put')

            <div class="md-form">

                <input type="text" name="name" id="name" class="form-control" value="{{ $course->name }}">

                <label for="name"> Course Name </label>

                <small class="text-danger d-block font-weight-bold"> {{ $errors->first('name') }} </small>

            </div>

            <div class="md-form">

                <textarea type="text" rows="4" name="description" id="description" class="form-control md-textarea">{{ $course->description }}</textarea>

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

            <div class="md-form">
            
                <h2> Current Image </h2>
            
                <img src="{{ asset('storage') }}/{{ $course->image }}" alt="Course Image" id="course-img">
            
                <div>
                    <button class="btn red darken-3"> Remove Image </button>
                </div>
            
            </div>



            <div class="btn-group" data-toggle="buttons" id="school">
                @foreach($schools as $school)
                    @if($course->school === $school)
                        <label class="btn btn-rounded waves-effect btn-elegant form-check-label active" style="width: 200px;">
                        <input class="form-check-input" type="radio" checked name="school" value="{{ $school }}"> {{ $school }}
                    @else
                        <label class="btn btn-rounded waves-effect btn-elegant form-check-label" style="width: 200px;">
                        <input class="form-check-input" type="radio" name="school" value="{{ $school }}"> {{ $school }}  
                    @endif
                </label> 
                @endforeach
            </div>
            <small class="text-danger d-block font-weight-bold"> {{ $errors->first('school') }} </small>


            @if($course->school === "IGCSE")
            <div class="btn-group" data-toggle="buttons" id="system">
            @else
            <div class="btn-group hidden" data-toggle="buttons" id="system">
            @endif
                @foreach($systems as $system)
                    @if($course->system === $system)
                    <label class="btn btn-rounded waves-effect btn-elegant form-check-label active" style="width: 200px;">
                    <input class="form-check-input" type="radio" name="system" checked value="{{ $system }}"> {{ $system }}
                    @else
                    <label class="btn btn-rounded waves-effect btn-elegant form-check-label" style="width: 200px;">
                    <input class="form-check-input" type="radio" name="system" value="{{ $system }}"> {{ $system }}
                    @endif
                </label> 
                @endforeach
            </div>
            <small class="text-danger d-block font-weight-bold"> {{ $errors->first('system') }} </small>


            @if($course->school === "IGCSE")
            <div class="btn-group hidden" data-toggle="buttons" id="sub_system">
            @else
            <div class="btn-group hidden" data-toggle="buttons" id="sub_system">
            @endif
                @foreach($subSystems as $sub_system)
                @if($course->sub_system === $sub_system)
                    <label class="btn btn-rounded waves-effect btn-elegant form-check-label active" style="width: 100px;">
                    <input class="form-check-input" type="radio" name="sub_system" checked value="{{ $sub_system }}"> {{ $sub_system }}
                    @else
                    <label class="btn btn-rounded waves-effect btn-elegant form-check-label" style="width: 100px;">
                    <input class="form-check-input" type="radio" name="sub_system" value="{{ $sub_system }}"> {{ $sub_system }}
                    @endif
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