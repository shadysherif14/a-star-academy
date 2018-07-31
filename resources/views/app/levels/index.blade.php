@extends('layouts.app') 
@section('css')
<link rel="stylesheet" href="{{ asset('css/courses/show.css') }}"> 
@stop 
@section('content')

<main class="content">

    <div>
        <div class="video-wrapper z-depth-4">


            <video id="videoPlayer" class="video-fluid plyr" controls playsinline>

                    <source src="{{ asset('videos/video.mp4') }}" type="video/mp4" />
                    
                </video>

        </div>

        <section class="information">

            <div>

                <p> Course Info </p>

            </div>

            <div class="description">

                <p> Description </p>

                <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem fugit voluptates asperiores at, animi quia laborum
                    beatae esse, sit autem adipisci mollitia quasi atque. Amet minima placeat error expedita dolorem labore
                    quod, non aliquam sunt ratione deserunt doloribus architecto. Dicta, eius quibusdam! Dolore inventore
                    aperiam iusto deleniti nisi natus ipsa?
                    < </div>
        </section>

        </div>

        <aside class="sidebar z-depth-3">

            @for ($i = 0; $i
            < 30; $i++) <div>
                <i class="fas fa-lock"></i>
                <a href="#"> Video - {{ $i + 1}} </a>
                <span class="duration"> 1m 30s </span>
    </div>
    @endfor

    </aside>


</main>

@stop