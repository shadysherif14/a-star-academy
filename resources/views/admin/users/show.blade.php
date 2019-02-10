@extends('layouts.admin') 
@section('content')

<div class="row clearfix">

    <div class="col-lg-5 col-md-12">
        <div class="card">
            <div class="body">
                <img src="{{ $user->avatar }}" alt="" class="img-fluid rounded m-b-20">
                <h6> {{ $user->name }} </h6>
                <div class="table-responsive">
                    <table class="table table-hover m-t-20">
                        <tbody>

                            <tr>
                                <td> Level </td>
                                <td> {{ $user->level->nameAndSchool }} </td>
                            </tr>

                            @if($user->email)
                            <tr>
                                <td> Email </td>
                                <td> {{ $user->email }} </td>
                            </tr>
                            @endif 
                            @if ($user->phone)
                            <tr>
                                <td> Phone </td>
                                <td> {{ $user->phone }} </td>
                            </tr>
                            @endif

                            <tr>
                                <td> Subscription </td>
                                <td class="col-green">
                                    <strong>{{ $user->videos()->count() }} Subscriptions</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                @if ($user->accounts)
                <div class="row mb-3 social-widget justify-content-center">
                    @foreach ($user->accounts as $name => $link)
                    <div class="hover-zoom-effect {{ $name }}-widget">
                        <div class="icon mx-2">
                            <a href="{{ $link }}" target="_blank">
                                <i class="zmdi zmdi-{{ $name }} display-1"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

            </div>
        </div>

    </div>

    <div class="col-md-12 col-lg-7">
    
        <div class="active" id="subscriptions">
            <div class="card">
                <div class="header">
                    <h2><strong> Student </strong> Subscriptions </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover table-borderless">
                            <thead>
                                <tr>
                                    <th> Session </th>
                                    <th> Course </th>
                                    <th> Price </th>
                                    <th> Date </th>
                                </tr>
                            </thead>

                            <tbody>
                                @if($user->videos()->count())
                                @foreach ($user->videos as $video)
                                <tr>
                                    <td> {{ $video->title }} </td>
                                    <td> {{ $video->course->name }} </td>
                                    <td> {{ $video->pivot->price }} EGP </td>
                                    <td> {{ \Carbon\Carbon::parse($video->pivot->created_at)->toFormattedDateString() }} </td>
                                </tr>
                                @endforeach
                                @else 
                                <tr>
                                    <td colspan="4"> {{ $user->name }} has no subsriptions yet. </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</div>

@stop