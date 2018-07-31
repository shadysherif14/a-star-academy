@extends('demo')


@section('content')

<div class="wrapper h-100">
    <div class="m-auto h-100">
        <div class="h-100">
            <img src="/res/person.png" alt="" class="img-responsive float-right mt-5" style="height:90%;width:33%" data-toggle="tooltip" data-placement="left" title="Welcome to A-star academy. I'm Lisa, I'll be your guide.">
            <div class="row m-auto">
                
                <div class="row flex-column">
                    <img src="/res/logo1.png" alt="" class="img-responsive float-left mt-5 ml-5 col-md-10" id="right-door" onclick="openDoor(this)">
                </div>
                <div class="row flex-column">
                    <img src="/res/logo1.png" alt="" class="img-responsive float-left mt-5 ml-5 col-md-10" id="right-door" onclick="openDoor(this)">
                </div>
            </div>
        </div>
        <audio id="audio-player" src="res/welcome.mp3" autoplay></audio>
        <audio id="audio-2" src="res/2.mp3"></audio>
    </div>




</div>


@endsection