@extends('layouts.app')

@section('content')
<span id="mute" class=""><img src="res/mute.png" alt="" style="width:24px;height:24px"></span>
<div id="igcse" class="upper w-100" onclick="chooseSchool(this);"></div>
<div id="american" class="lower w-100" onclick="chooseSchool(this);"></div>

<img id="guide" src="/res/teacher.svg" alt="" class="img-responsive guide" style="height:100%;width:33%;display:none;" data-toggle="tooltip" data-placement="bottom" title="Welcome to A-star academy. I'm Lisa, I'll be your guide.">

<audio id="audio-player" src="res/audio/welcome.mp3"></audio>
<audio id="audio-2" src="res/audio/2.mp3"></audio>

@endsection

@section('scripts')
<script type="text/javascript" src="/js/main.js"></script>

@endsection