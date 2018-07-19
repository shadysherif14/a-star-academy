
@extends('layouts.app')

@section('content')
    
    @foreach ($levels as $level)
        <!-- Slider main container -->
        <div class="level">

            <!-- Additional required wrapper -->
            <div class="courses owl-theme">
                
                @foreach ($level->courses as $course)
                <a href="/courses/{{ $course->slug }}">
                    <figure class="snip0020">
                        <img src="{{ asset('images/courses') }}/{{ $course->slug }}.png" alt="{{ $course->name }}" />
                        <figcaption>
                            <div class="name">
                                <h2> 
                                    <span>{{ $course->name }}</span> 
                                </h2>
                            </div>
                            <div class="description">
                                <p> {{ $course->description }} </p>
                                <div class="curl"></div>
                            </div>
                        </figcaption>
                    </figure>
                </a>

            
                @endforeach
                
            </div>

        </div>
    @endforeach
    
@stop

