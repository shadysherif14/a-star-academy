@extends('layouts.user') 
@section('content')

<div class="header">
    <div class="body">
        {{--  <img src="{{ imageIcon('instructor') }}" alt="">  --}}
        <h1> Our Instructors </h1>
    </div>
</div>
<div id="instructors" class="wrapper">

    @foreach($instructors as $instructor)
    <div class="card wow fadeInUp">

        <div class="content">

            <div class="front active filppers" style="background-image: url({{ $instructor->avatar }})">

                <div class="togglers">
                    <i class="typcn typcn-arrow-right-outline animated infinite wobble"></i>
                </div>

                <div class="inner">
                    <h2 class="name"> {{ $instructor->name }} </h2>
                </div>
            </div>

            <div class="back filppers">

                <div class="togglers">
                    <i class="typcn typcn-arrow-left-outline animated infinite wobble"></i>
                </div>

                <div class="inner">

                    <div class="basic">
                        <h5 class="name"> {{ $instructor->name }} </h5>
                    </div>
                    <p class="about"> {{ $instructor->about }} </p>
                    <div class="meta">
                        @if($instructor->email)
                        <div class="email">
                            <img src="{{ imageIcon('email') }}" alt="email" class="icon">
                            <span> {{ $instructor->email }} </span>
                        </div>
                        @endif @if($instructor->phone)
                        <div class="phone">
                            <img src="{{ imageIcon('phone') }}" alt="phone" class="icon">
                            <span> {{ $instructor->phone }} </span>
                        </div>
                        @endif

                        <div class="courses">
                            <img src="{{ imageIcon('graduation') }}" alt="graduation" class="icon">
                            <span>{{ $instructor->coursesCount }}</strong>
                        </div>
                    </div>

                    @if ($instructor->accounts)
                    <div class="social">
                        @foreach ($instructor->accounts as $name => $link)
                        <a href="{{ $link }}" target="_blank" class="{{ $name }}">
                            <img src="{{ imageIcon($name) }}" alt="{{ $name }}" class="icon">
                        </a>
                        @endforeach
                    </div>
                    @endif
    
                    <div class="profile">
                        <a href="{{ action('User\InstructorController@show', $instructor) }}" class="btn"> Show Profile </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
    @endforeach

</div>



@stop @push('css')
<link rel="stylesheet" href="{{ asset_path('css/user/instructors/index.css') }}"> 

@endpush @push('scripts')
<script src="{{ asset_path('js/user/instructors/index.js') }}"></script>


@endpush