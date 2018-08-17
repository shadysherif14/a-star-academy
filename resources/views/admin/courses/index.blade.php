@extends('layouts.admin') 
@section('title', ' | Courses') 
@section('content')

<div class="row mb-1">
    <a class="btn create col" href="{{ route('admin.courses.create') }}">
        <i class="fas fa-plus"></i> Add Course
    </a>
    <button class="btn filter col" data-toggle="modal" data-target="#filter-modal">
        <i class="fas fa-filter"></i> Filter
    </button>
</div>

@php
    if(count($courses) === 0) 
        $hidden = 'd-none';
    else   
        $hidden = '';
@endphp

@includeWhen( count($courses) == 0, 'includes.no_records', ['record' => 'course'])

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
                    <a type="button" class="btn btn-floating show" href="{{ route('admin.courses.show', ['course' => $course]) }}">
                        <i class="fas fa-eye"> </i>
                    </a>
                    <a type="button" class="btn btn-floating edit" href="{{ route('admin.courses.edit', ['course' => $course]) }}">
                        <i class="fas fa-pen"> </i>
                    </a>
                    <button type="button" class="btn btn-floating delete" action="{{ route('admin.courses.destroy', ['course' => $course]) }}">
                        <i class="fas fa-trash"> </i>
                    </button>
                </div>
            </div>

        </div>

        @endforeach
    </div>

</div>

<form class="modal ajax animated bounceIn" id="filter-modal" method="get" tabindex="-1" action="{{ route('admin.courses.index') }}">

    <div class="modal-dialog modal-md">

        <div class="modal-content">
            <div class="modal-body">

                <div>
                    <select hidden_name="school" id="school-filter" class="mdb-select colorful-select dropdown-dark">
                        <option value="" selected="selected"> All Schools </option>
                        <option value="ig"> IGCSE </option>
                        <option value="ad"> American Diploma </option>
                    </select>
                </div>
                <div>
                    <select hidden_name="system" id="system-filter" class="mdb-select colorful-select dropdown-dark">
                        <option value="" selected="selected"> Both Systems </option>
                        <option value="cambridge"> Cambridge </option>
                        <option value="edexcel"> Edexcel </option>
                    </select>
                </div>
                <div>
                    <select hidden_name="sub_system" id="sub_system-filter" class="mdb-select colorful-select dropdown-dark">
                        <option value="" selected="selected"> All Sub Sytems </option>
                        <option value="A2"> A2 </option>
                        <option value="AS"> AS </option>
                        <option value="AL"> AL </option>
                        <option value="OL"> OL </option>
                    </select>
                </div>
                <div>
                    <select hidden_name="level" id="level-filter" class="mdb-select colorful-select dropdown-dark">
                        <option value="" selected="selected"> All Levels </option>
                        @foreach($levels as $level)
                            <option value="{{ $level->slug }}"> {{ $level->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select hidden_name="instructor" id="instructor-filter" class="mdb-select colorful-select dropdown-dark">
                        <option value="" selected="selected"> All Instructors </option>
                        @foreach($instructors as $instructor)
                            <option value="{{ $instructor->slug }}"> {{ $instructor->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button class="btn btn-submit"> 
                <i class="fas fa-filter"></i> Filter 
            </button>
        </div>
    </div>
</form>

@endsection
 
@section('scripts')
    <script src="{{ asset('js/admin/courses/index.js') }}"></script>
@endsection
 

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/courses/index.css') }}"> 
@stop