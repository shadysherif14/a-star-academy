@extends('layouts.user') 
@section('content')
<div class="floating-btn" data-user="{{ auth()->user()->serial ?? ''}}" data-video="{{ $video->id ?? ''}}"> ? </div>
<div class="floating-btn-left"></div>
<div id="wrapper">
    @if($video->isAllowed)
    <div id="plyr-wrapper">
        <video controls id="player" poster="{{ $video->poster }}">
            <source src="{{ $video->path }}" type="video/mp4">
        </video> @auth
        <input type="hidden" id="user-serial" value="{{ Auth::user()->serial }}">
        <input type="hidden" id="user-name" value="{{ Auth::user()->username }}">
        <input type="hidden" id="subscription-route" value="{{ route('subscription.update.date', $video->id) }}"> @endauth
        @if(!$video->isFirstVideo())
        <a href="{{ action('User\VideoController@show', $prevVideo) }}" class="btn btn-sm prev">
            <i class="typcn typcn-arrow-left-outline"></i>
        </a> @endif @if(!$video->isLastVideo())
        <a href="{{ action('User\VideoController@show', $nextVideo) }}" class="btn btn-sm next">
            <i class="typcn typcn-arrow-right-outline"></i>
        </a> @endif
    </div>

    @else
    <div id="poster-wrapper" class="overlay-image">
        <div class="overlay"></div>
        <img class="image" src="{{ $video->poster }}" alt="">
        <div class="content">
            @if(Auth::check())
            <button class="btn hvr-bounce-to-top" data-toggle="modal" data-target="#payment-form" id="subscribe-btn">
                <i class="far fa-handshake"></i>
            Subscribe
            </button> @else
            <a class="btn hvr-bounce-to-top" href="{{ route('login') }}">
                <i class="fas fa-sign-in-alt"></i>
                Login
            </a> @endif
        </div>
    </div>
    @endif

    <div id="playlist">
        <ul class="list-group">
            @foreach($video->course->videos as $courseVideo)
            <li class="list-group-item {{ $courseVideo->id === $video->id ? 'active' : '' }}">
                <a href="{{ action('User\VideoController@show', $courseVideo) }}">
                    <i class="{{ $courseVideo->userCanWatchIcon() }}"></i>
                    <span>
                        {{ $courseVideo->title }}
                    </span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>

    <div id="video-details">
        <div class="right">
            <h6> Video Info </h6>
            <div class="table-responsive">
                <table class="table table-hover m-t-20">
                    <tbody>
                        <tr>
                            <td> <i class="zmdi zmdi-calendar"></i> Published on </td>
                            <td> {{ $video->created_at }} </td>
                        </tr>

                        <tr>
                            <td> <i class="zmdi zmdi-collection-text"></i> Title </td>
                            <td> {{ $video->title}} </td>
                        </tr>

                        <tr>
                            <td> <i class="zmdi zmdi-timer"></i> Run time </td>
                            <td> {{ $video->duration }} </td>
                        </tr>

                        <tr>
                            <td> <i class="zmdi zmdi-collection-item-1"></i> Price </td>
                            <td> {{ $video->one_price }} EGP </td>
                        </tr>

                        <tr>
                            <td> <i class="fas fa-infinity"></i> Price </td>
                            <td> {{ $video->max_price }} EGP </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
        <div class="left">
            @if($video->description)
            <div class="description">
                <h6> Video Description </h6>
                <p> {{ $video->description }} </p>
            </div>
            @endif
        </div>
    </div>

    <div class="image-bg">
    </div>

    @if($video->isAllowed && $video->questions()->count())

    <form id="quiz" action="{{ action('User\QuizController@store', $video) }}" method="POST">

        @csrf

        <h6> Are you ready to test yourself? </h6>

        <div class="grid">

            <div id="questions">
                @foreach ($video->questions as $question)
                <div class="question">
                    <p> {{ $question->body }} </p>
                    <div class="answers">
                        @foreach($question->answers as $answer)
                        <div class="pretty p-icon p-pulse p-round answer">
                            <input type="radio" name="question-{{ $question->id }}" value="{{ $answer->id }}" />
                            <div class="state p-warning-o">
                                <i class="icon zmdi zmdi-check"></i>
                                <label> {{ $answer->body }} </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
                <button type="submit" class="btn hvr-bounce-to-top" id="check-answers-btn"> Check your anwers </button>
            </div>

            <div class="controls">

                <button type="button" class="btn" id="prev-question">
                    <i class="typcn typcn-arrow-up-outline"></i>
                </button>
                <span class="divider"></span>
                <button type="button" class="btn" id="next-question">
                    <i class="typcn typcn-arrow-down-outline"></i>
                </button>

            </div>

        </div>
        <div class="progress m-b-5">
            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </form>

    <div class="image-bg">
    </div>
    @endif
</div>


@if(Auth::check() && !$video->isAllowed)
<div id="payment-form" class="modal fade">

    <div class="modal-dialog  modal-lg">

        <div class="modal-content">

            <div class="modal-body">

                <div class="image">
                </div>

                <form action="{{ action('User\VideoController@paymentKey', $video) }}" method="POST">

                    @csrf

                    <div class="content">

                        <div class="type">

                            <label for=""> Subscription Type </label>
                            <div class="pretty p-icon p-pulse">
                                <input type="radio" name="type" value="unlimited" price="{{ $video->max_price }}" />
                                <input type="radio" name="type" value="max" price="{{ $video->max_price }}" />
                                <div class="state">
                                    <i class="icon fas fa-infinity"></i>
                                    <label> {{ $video->max_times }} Times Access </label>
                                </div>
                            </div>

                            <div class="pretty p-icon p-pulse p-fill">
                                <input type="radio" name="type" value="one" price="{{ $video->one_price }}" />
                                <div class="state">
                                    <i class="icon zmdi zmdi-collection-item-1"></i>
                                    <label> 1 Time Access </label>
                                </div>
                            </div>

                            <div id="price-wrapper">
                                <i class="fas fa-money-bill-wave animated wow swing" aria-hidden="true"></i>
                                <span> Price </span>
                                <span class="font-weight-bold" id="video-price"> 0 EGP </span>
                            </div>

                        </div>

                        <div>
                            <label for="password"> Enter Your Password </label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <img src="{{ asset_path('images/payment/key.png') }}" alt="">
                                </span>
                                <input type="password" id="password" class="form-control" name="password" placeholder="Password" />
                            </div>
                        </div>

                    </div>

                    <button class="btn"> Subscribe </button>
                </form>

            </div>

        </div>

    </div>

</div>
@endif 
@stop @push('css')
<link rel="stylesheet" href="{{ asset_path('css/user/videos/show.css') }}"> 
@endpush @push('scripts')
<script>
    let questionsNumber = @json(count($video->questions));
    let paymentFolder = @json(asset_path('images/payment/'));
    let isOverview = @json($isOverview);
    let timeRemaining = @json($timeRemaining);

</script>

<script src="{{ asset_path('js/user/videos/show.js') }}"></script>
<script src="{{ asset_path('js/user/payment/index.js') }}"></script>



@endpush