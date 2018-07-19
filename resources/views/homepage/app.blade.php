@extends('layouts.app') 

@section('css')
    <link rel="stylesheet" href="{{ asset('css/courses/show.css') }}">
@stop

@section('content')
    
    <main class="content">

        <div class="video-wrapper z-depth-4">
            <video class="video-fluid" loop controls>
                <source src="{{ asset('videos/01 Building the World.mp4') }}" type="video/mp4" />
            </video>
        </div>

        <aside class="sidebar z-depth-3">
            
            @for ($i = 0; $i < 30; $i++)
                <div>
                    <i class="fas fa-lock"></i>
                    <a href="#"> Video - {{ $i + 1}} </a> 
                    <span class="duration"> 1m 30s </span>
                </div>
            @endfor
            
        </aside>
    </main>
@stop