@extends('layouts.admin') 
@section('title', 'Admin Dashboard') 
@section('content')

@include('includes.errors')

<div class="card w-75 mx-auto">

    <div class="card-header elegant-color-dark white-text">

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
            @if(is_null($course->description))
            <p> No description </p>
            @else
            <p> {{ $course->description }} </p>
            @endif
        </div>

        <div>
            <h2> School System </h2>
            <p> {{ $course->school }} </p>
            <p> {{ $course->sytem }} </p>
            <p> {{ $course->sub_system }} </p>

        </div>

        <div>
            <h2> Cover Image </h2>
            <img class="img-fluid" src="{{ asset('storage') }}/{{ $course->image }}" alt="Course Image">
        </div>

    </div>

</div>
@endsection
 
@section('scripts')
@endsection
 
@section('css')
<link rel="stylesheet" href="{{ asset('css/courses/show.css') }}">
@endsection