@extends('layouts.admin') 

@section('title', '| Courses') 

@section('content')


<div class="card">

    <div class="card-header grid">
        <div> Name </div>
        <div> School </div>
        <div> System </div>
        <div> Sub Sytem </div>
        <div> Level </div>
        <div> Instructor </div>

    </div>

    <div class="card-body">

        @foreach($courses as $course)

        <div id="course-{{ $course->id }}" course="{{ $course->id }}" class="grid">

            <div>
                <p class="link"> 
                    <a href="{{ $course->adminPath() }}"> {{ $course->name }} </a>
                </p>
            </div>

            <div>
                <div>
                    <p class="content"> School </p>
                </div>
                <p> {{ $course->school }} </p>
            </div>

            <div>
                <div>
                    <p class="content"> System </p>
                </div>
                <p> {!! $course->system !!} </p>
            </div>

            <div>
                <div>
                    <p class="content"> Sub System </p>
                </div>
                <p> {!! $course->sub_system !!} </p>
            </div>

            <div>
                <div>
                    <p class="content"> Level </p>
                </div>
                <p> {{ $course->level }} </p>
            </div>

            <div>
                <div>
                    <p class="content"> Instructor </p>
                </div>
                <p> {{ $course->instructor }} </p>
            </div>

            
            <div class="actions">
                <a href="{{ $course->adminPath() }}" class="btn show">
                    <i class="fas fa-eye"></i> <span> Show </span> 
                </a>
            </div>
        </div>

        @endforeach
    </div>


</div>
@endsection
 
@section('scripts')
@endsection
 
@section('css')
    <link rel="stylesheet" href="{{ asset('css/courses/index.css') }}">
@endsection