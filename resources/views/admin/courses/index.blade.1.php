@extends('layouts.admin') 
@section('title', ' | Courses') 
@section('content')


@php
    if(count($courses) === 0) 
        $hidden = 'd-none';
    else   
        $hidden = '';
@endphp

@includeWhen( count($courses) == 0, 'includes.no_records', ['record' => 'course'])

<form id="filter-form" action="{{ route('admin.courses.index') }}" method="GET">

    <div class="row">

        <div class="col">
            <select id="school-filter" class="mdb-select mb-0">
                <option value="" selected="selected"> All Schools </option>
                @foreach($schools as $school)
                    <option value="{{ $school }}"> {{ $school }} </option>
                @endforeach
            </select>
        </div>

        <div class="col">
            <select id="system-filter" class="mdb-select mb-0">
                <option value="" selected="selected"> All Systems </option>
                @foreach($systems as $system)
                    <option value="{{ $system }}"> {{ $system }} </option>
                @endforeach
            </select>
        </div>

        <div class="col">
            <select id="sub_system-filter" class="mdb-select mb-0">
                <option value="" selected="selected"> All Sub Sytems </option>
                @foreach($subSystems as $subsystem)
                    <option value="{{ $subsystem }}"> {{ $subsystem }} </option>
                @endforeach
            </select>
        </div>

        <div class="col">
            <select id="level-filter" class="mdb-select mb-0">
                <option value="" selected="selected"> All Levels </option>
                @foreach($levels as $level)
                    <option value="{{ $level->id }}"> {{ $level->name }} </option>
                @endforeach
            </select>
        </div>

        <div class="col">
            <select id="instructor-filter" class="mdb-select mb-0">
                <option value="" selected="selected"> All Instructors </option>
                @foreach($instructors as $instructor)
                    <option value="{{ $instructor->id }}"> {{ $instructor->name }} </option>
                @endforeach
            </select>
        </div>
    </div>

    <button class="btn btn-submit btn-block mt-0 mb-2" id="filter"> 
        <i class="fas fa-filter"></i> Filter 
    </button>

</form>

<a class="btn create" href="{{ route('admin.courses.create') }}">
    <i class="fas fa-plus"></i> Add Course
</a>

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

        <div id="course-{{ $course->id }}" course="{{ $course->id }}" class="grid course">

            <div>
                <p class="link">
                    <a href="{{ route('admin.courses.show', ['courses' => $course]) }}"> {{ $course->name }} </a>
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

            <div>
                <div>
                    <p class="content"> Actions </p>
                </div>
                <div class="actions">
                    <a type="button" class="btn show" href="{{ route('admin.courses.show', ['course' => $course]) }}">
                        <i class="fas fa-eye"> </i>
                    </a>
                    <a type="button" class="btn edit" href="{{ route('admin.courses.edit', ['course' => $course]) }}">
                        <i class="fas fa-pen"> </i>
                    </a>
                    <button type="button" class="btn delete" action="{{ route('admin.courses.destroy', ['course' => $course]) }}">
                        <i class="fas fa-trash"> </i>
                    </button>
                </div>
            </div>

        </div>

        @endforeach
    </div>

</div>

@endsection
 
@section('scripts')

    <script> let levels = @json($levels) </script>

    <script src="{{ asset('js/admin/courses/index.js') }}"></script>

@endsection
 

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/courses/index.css') }}"> 
@stop