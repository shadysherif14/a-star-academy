@extends('layouts.app') 
@section('content')

<div class="wrapper w-100">
    <span id="mute" class="z-depth-5"><img src="res/mute.png" alt="" style="width:24px;height:24px"></span>
    <div id="igcse" class="upper w-100">
        <span class="igCloseBtn" style="display:none;">X</span>
        <div class="holder1 text-center" style="display:none;">
            {{-- <form action="/ig/courses" method="POST" id="igForm">
                @csrf --}}
                <div class="btn-group mb-5" data-toggle="buttons">

                    @foreach($igGrades as $grade)

                        <label class="btn btn-black">
                            <input type="radio" name="grade" value="{{$grade->slug}}" autocomplete="off">{{$grade->name}}
                        </label>

                    @endforeach
        
                </div>
                <div class="text-center">
                    <button id="igSubmitBtn" class="btn btn-black" type="button">Explore Courses</button>
                </div>
            {{-- </form> --}}
        </div>
    </div>

    <div id="american" class="lower w-100">
        <span class="americanCloseBtn" style="display:none;">X</span>
        <div class="holder2 text-center" style="display:none;">
            {{-- <form action="/sat/courses" method="POST" id="satForm">
            @csrf --}}
                <div class="btn-group mb-5" data-toggle="buttons">
                @foreach($satCourses as $course)
                    <label class="btn btn-gold">
                        <input type="radio" name="course" value="{{$course->slug}}" autocomplete="off"> {{$course->name}}
                    </label>

                @endforeach
                        
        
                </div>
                <div class="text-center">
                    <button id="americanSubmitbtn" class="btn btn-gold" type="button">Explore Sessions</button>
                </div>
            {{-- </form> --}}
        </div>
        
    </div>
    
        <img id="guide" src="/res/guide.svg" alt="" class="img-responsive guide" style="height:100%;width:33%;display:none;" data-toggle="tooltip"
        data-placement="bottom" title="Welcome to A-star academy. I'm Lisa, I'll be your guide."> 
    
    <audio id="audio-player" src="res/audio/welcome.mp3"></audio>
    <audio id="audio-2" src="res/audio/2.mp3"></audio>

    <div class="fixed-action-btn" style="bottom: 15px; right: 15px;">
        
            <a class="btn-floating btn-lg">
                <i class="fas fa-cog"></i>
            </a>
        
            <ul class="list-unstyled" class="auth">
                <li title="Signup" id="signupBtn">
                    <a href="{{ route('register') }}" class="btn-floating green">
                        <i class="fas fa-user-plus"></i>
                    </a>
                    
                </li>
                <li title="Login" id="loginBtn">
                    <a class="btn-floating blue" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
                </li>
            </ul>
        </div>
</div>

@endsection
 
@push('scripts')
    <script type="text/javascript" src="/js/main.js"></script>
@endpush