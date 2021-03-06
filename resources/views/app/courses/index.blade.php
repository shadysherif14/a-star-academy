@extends('layouts.app') 
@section('content') 

<!-- Header -->

@php
    $img = asset_path('images/header.jpeg');
@endphp
<header>
    <img class="img-fluid" src="{{ $img }}" alt="" srcset="">
</header>

<!-- Courses -->
@php

    $courses = array('Astronomy', 'Biology', 'Chemistry', 'English', 'Geography', 'History', 'Math', 'Physics', 'Literature');

@endphp

<div class="courses">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title"> {{ count($courses) }} courses found </div>
            </div>
        </div>

        <div class="row courses_row">

            @foreach($courses as $course)
            <!-- course -->
            <div class="col-xl-4 col-md-6 course_col">
                <div class="course">
                    <div class="course_image">
                        <img src="{{ asset_path('images/courses') }}/{{ strtolower($course) }}.png" alt="">
                    </div>
                    <a href="#" > 
                    <div class="course_body text-center">
                        <div class="course_name"> {{ $course }} </div>
                        <div class="course_title">
                        </div>
                        <div class="course_price"> 1200 L.E </div>
                    </div>
                    </a>
                    <div class="course_footer d-flex flex-md-row align-items-center justify-content-center">
                        <div>
                            <span>650 Ftsq</span>
                        </div>
                        <div>
                            <span>3 Bedrooms</span>
                        </div>
                        <div>
                            <span>3 Bathrooms</span>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach

        </div>
        
        <div class="row">
            <div class="col">
                <div class="pagination">
                    <ul>
                        <li class="active"><a href="#">01.</a></li>
                        <li><a href="#">02.</a></li>
                        <li><a href="#">03.</a></li>
                        <li><a href="#">04.</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

    
@stop

@push('css')
    <link rel="stylesheet" href="{{ asset_path('css/user/courses/index.css') }}">
@enspush
