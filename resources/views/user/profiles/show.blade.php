@extends('layouts.user') 
 
@section('content')
    <div class="user">
        <section id="{{ $user->username }}" class="body wow fadeInUp">

            <div class="title">
                <h4 class="name"> {{ $user->name }} </h4>
            </div>
            <div class="image-wrapper">
                <img src="{{ $user->avatar }}" alt="user Image" class="img-resposnive">
            </div>
        </section>
    </div>

    @if($user->id === auth()->id())
    <div class="tabs-nav">

        <p target="#form" class="nav active">
            <img src="{{ imageIcon('form') }}" alt="" class="icon">
            <span> Edit Profile </span>
        </p>
        
        @if(count($user->courses()))
        <p target="#courses" class="nav">
            <img src="{{ imageIcon('books') }}" alt="" class="icon">
            <span> Courses </span>
        </p>
        @endif

        @if(count($user->activeVideos))
        <p target="#videos" class="nav">
            <img src="{{ imageIcon('video') }}" alt="" class="icon">
            <span> Sessions </span>
        </p>
        @endif

        @if(count($user->quizzes))
        <p target="#quizzes" class="nav">
            <img src="{{ imageIcon('quiz') }}" alt="" class="icon">
            <span> Quizzes </span>
        </p>
        @endif
        
    </div>

    <div class="tabs-content">

        @if(count($user->courses()))
        <div id="courses">
            @foreach($user->courses() as $course)
            @include('user.courses.list', $course)
            @endforeach
        </div>
        @endif

        @if(count($user->activeVideos))
        <div id="videos">
            @foreach($user->activeVideos as $video)
            @include('user.videos.flipper', $video)
            @endforeach
        </div>
        @endif

        @if(count($user->quizzes))
        <div id="quizzes">
            <table class="table">
                <thead>
                    <th> Course </th>
                    <th> Session </th>
                    <th> Grade </th>
                    <th> Date </th>
                </thead>
                <tbody>
                    @foreach($user->quizzes as $quiz)
                    <tr>
                        <td> <a href="{{ route('courses.show', $quiz->video->course) }}"> {{  $quiz->video->course->name  }} </a> </td>
                        <td> <a href="{{ route('videos.show', $quiz->video) }}"> {{  $quiz->video->title  }} </a> </td>
                        <td> {{ $quiz->correctQuestions()->count() }} out of {{ $quiz->questions()->count() }} </td>
                        <td> {{ $quiz->created_at }} </td>
                    </tr>
                    <tr>
                        <td> <a href="{{ route('courses.show', $quiz->video->course) }}"> {{  $quiz->video->course->name  }} </a> </td>
                        <td> <a href="{{ route('videos.show', $quiz->video) }}"> {{  $quiz->video->title  }} </a> </td>
                        <td> {{ $quiz->correctQuestions()->count() }} out of {{ $quiz->questions()->count() }} </td>
                        <td> {{ $quiz->created_at }} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <div id="form">
            <form method="POST" enctype="multipart/form-data" action="{{ route('profiles.update') }}">

                @csrf

                <div class="grid">

                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ $user->first_name }}">
                        <span class="input-group-addon">
                            <img src="{{ imageIcon('user') }}" alt="" class="icon">
                        </span>
                    </div>

                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ $user->last_name }}">
                        <span class="input-group-addon">
                            <img src="{{ imageIcon('user') }}" alt="" class="icon">
                        </span>
                    </div>

                </div>

                <div class="input-group">
                    <input type="text" class="form-control" placeholder="User Name" name="username" value="{{ $user->username }}">
                    <span class="input-group-addon">
                        <img src="{{ imageIcon('user') }}" alt="" class="icon">
                    </span>
                </div>

                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Email" name="email" value="{{ $user->email }}">
                    <span class="input-group-addon">
                        <img src="{{ imageIcon('email') }}" alt="" class="icon">
                    </span>
                </div>

                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Old Password" name="old_password">
                    <span class="input-group-addon">
                        <img src="{{ imageIcon('lock') }}" alt="" class="icon">
                    </span>
                </div>

                <div class="grid">
                    <div class="input-group">
                        <input type="password" placeholder="Password" class="form-control" name="password">
                        <span class="input-group-addon">
                            <img src="{{ imageIcon('key') }}" alt="" class="icon">
                        </span>
                    </div>

                    <div class="input-group">
                        <input type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation">
                        <span class="input-group-addon">
                            <img src="{{ imageIcon('key') }}" alt="" class="icon">
                        </span>
                    </div>

                </div>

                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="btn btn-file">
                        <span class=""> Upload a profile picture </span>
                        <input type="file" name="avatar">
                    </div>
                    <input disabled class="form-control">
                </div>

                <div parent="gender" class="my-3" id="gender">

                    <label class="label" for=""> Gender @include('partials.required') </label>

                    <div class="pretty p-jelly p-image p-plain">
                        <input type="radio" name="gender" value="Male" @if($user->gender === 'Male') checked @endif />
                        <div class="state">
                            <img src="{{ imageIcon('male') }}" alt="" class="icon">
                            <label> Male </label>
                        </div>
                    </div>

                    <div class="pretty p-jelly p-image p-plain">
                        <input type="radio" name="gender" value="Female" @if($user->gender === 'Female') checked @endif />
                        <div class="state">
                            <img src="{{ imageIcon('female') }}" alt="" class="icon">
                            <label> Female </label>
                        </div>
                    </div>

                </div>

                <div class="grid">

                    @php $accounts = ['facebook', 'twitter', 'linkedin']; @endphp

                    @foreach ($accounts as $account)
                        
                    <div class="input-group">
                        <div class="input-group-addon">
                            <img src="{{ imageIcon($account) }}" alt="" class="icon">
                        </div>
                        <input type="url" name="accounts[{{ $account }}]" class="form-control" placeholder="Account" 
                        value="{{ $user->accounts($account) }}">
                    </div>
                    @endforeach

                    <div class="input-group">
                        <div class="input-group-addon">
                            <img src="{{ imageIcon('phone') }}" alt="" class="icon">
                        </div>
                        <input type="text" name="phone" class="form-control" placeholder="Phone Number"
                        value="{{ $user->phone }}">
                    </div>

                </div>

                <button type="submit" class="btn hvr-bounce-to-top"> Update </button>

            </form>
        </div>
    @endif
    </div>
@stop 

@push('css')
    <link rel="stylesheet" href="{{ asset_path('css/user/profiles/show.css') }}">
    <link rel="stylesheet" href="{{ asset_path('assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset_path('assets/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}"></script>
    <script src="{{ asset_path('js/user/profiles/show.js') }}"></script>
@endpush