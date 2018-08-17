@extends('layouts.admin') 

@section('title', ' | Courses') 

@section('content')

@include('includes.errors')

<div class="card r-crud">

    <div class="card-header">

        <h4> <i class="fas fa-list"></i> Course Details </h4>

    </div>

    <div class="card-body">

        <div>
            <a href="/admin/{{ $course->slug }}/videos" class="btn btn-outline-elegant"> Show sessions </a>
        </div>
        <div>
            <h2> Course Name </h2>
            <p> {{ $course->name }} </p>
        </div>

        <div>
            <h2> Course Description </h2>
            <p> {!! $course->description !!} </p>
        </div>

        <div>
            <h2> School System </h2>
            <p> {{ $course->school }} </p>
            @if($course->school === 'IGCSE')
            <p> {{ $course->system }} </p>
            <p> {{ $course->sub_system }} </p>
            @endif

        </div>

        <div>
            <h2> Cover Image </h2>
            <img class="img-fluid" src="{{ $course->image }}" alt="Course Image">
        </div>

    </div>

</div>
@endsection
 
@section('scripts')
@endsection
 
@section('css')
    <link rel="stylesheet" href="{{ asset('css/courses/create.css') }}">
@endsection