@extends('layouts.app')

@section('content')
<div class="parent w-100 h-100">

    <img id="guide" src="/res/teacher.svg" alt="" class="img-responsive guide" style="height:100%;width:33%;display:none;" data-toggle="tooltip" data-placement="bottom" title="Hi again. Now you have to choose your grade to explore courses.">
    <audio id="audio-3" src="{{ asset_path('res/audio/3.mp3')}}"></audio>
    <audio id="audio-4" src="{{ asset_path('res/audio/4.mp3')}}"></audio>
    <nav id="grades">
        <ul>
            
            <li>
                <a href="#grade7" data-item="0" >
                    <img src="{{ asset_path('res/grades/7.svg')}}" alt="">
                    <span>Grade 7</span>
                </a>
            </li>

            <li>
                <a href="#grade8" data-item="1" >
                        <img src="{{ asset_path('res/grades/8.svg')}}" alt="">
                    <span>Grade 8</span>
                </a>
            </li>

            <li>
                <a href="#grade9" data-item="2" >
                        <img src="{{ asset_path('res/grades/9.svg')}}" alt="">
                    <span>Grade 9</span>
                </a>
            </li>

            <li>
                <a href="#grade10" data-item="3" >
                        <img src="{{ asset_path('res/grades/10.svg')}}" alt="">
                    <span>Grade 10</span>
                </a>
            </li>

            <li>
                <a href="#grade11" data-item="4" >
                        <img src="{{ asset_path('res/grades/11.svg')}}" alt="">
                    <span>Grade 11</span>
                </a>
            </li>

            <li>
                <a href="#grade12" data-item="5" >
                    <img src="{{ asset_path('res/grades/12.svg')}}" alt="">
                    <span>Grade 12</span>
                </a>
            </li>

            <li>
                <a href="#" id="centerGrade" data-item="6"></a>
            </li>
        </ul>
    </nav>

</div>
    <div id="system" class="w-100 h-100" style="z-index:999;color:#fff; display:none;">
        <form action="" method="POST" class="w-100 h-100">

            <div class="m-auto w-50 text-center" style="padding-top:6rem!important;">

                <label>School system</label><br/>
                <div class="btn-group" data-toggle="buttons">
            
                    <label class="btn btn-gold">
                        <input type="radio" name="system" id="cam" autocomplete="off"> Cambridge
                    </label>

                    <label class="btn btn-gold">
                        <input type="radio" name="system" id="edex" autocomplete="off"> Edexcel
                    </label>

                </div>
            </div>

            <div class="m-auto w-50 text-center pt-5">

                <label>System level</label><br/>
                <div class="btn-group mb-4" data-toggle="buttons">
            
                    <label class="btn btn-gold">
                        <input type="radio" name="sub" id="ol" autocomplete="off"> OL
                    </label>
    
                    <label class="btn btn-gold">
                        <input type="radio" name="sub" id="al" autocomplete="off"> AL
                    </label>
                    <label class="btn btn-gold">
                        <input type="radio" name="sub" id="a2" autocomplete="off"> A2
                    </label>
                    <label class="btn btn-gold">
                        <input type="radio" name="sub" id="as" autocomplete="off"> AS
                    </label>
                    
                </div>
                <button class="btn btn-gold" type="submit">Explore Courses</button>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="/js/grades.js"></script>
@endsection