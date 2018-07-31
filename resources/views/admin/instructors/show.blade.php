@extends('layouts.app') 


@section('css')
    <link rel="stylesheet" href="{{ asset('corses/show.css') }}">
@stop

@section('content')
    
    <main class="content">

        <div class="video-wrapper">
            
        </div>

        <aside class="sidebar">
            
            @for ($i = 0; $i < 30; $i++)
                <a href="#"> Video - {{ $i }} </a> 
            @endfor
            
        </aside>
    </main>
@stop