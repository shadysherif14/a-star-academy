@extends('layouts.instructor') 
@section('content')

<div class="row clearfix">
  
    <div class="col-lg-4 col-md-6">
        <div class="card top_counter">
            <div class="body">
                <div class="icon xl-slategray">
                    <i class="zmdi zmdi-graduation-cap"></i> 
                </div>
                <a class="content" href="{{ route('instructor.courses.index') }}">
                    <div class="text">Courses</div>
                    <h5 class="number count-to" data-from="0" data-to="{{ $instructor->courses()->count() }}" 
                        data-speed="4000" data-fresh-interval="700">
                        {{ $instructor->courses()->count() }}
                    </h5>
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="card top_counter">
            <div class="body">
                <div class="icon xl-slategray">
                    <i class="fas fa-play"></i>
                </div>
                <div class="content">
                    <div class="text"> Sessions </div>
                    <h5 class="number count-to" data-from="0" data-to="{{ $instructor->videos()->count() }}" data-speed="4000" data-fresh-interval="700">
                        {{ $instructor->videos()->count() }}
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="card top_counter">
            <div class="body">
                <div class="icon xl-slategray">
                    <i class="fas fa-handshake"></i>
                </div>
                <a class="content" href="{{ route('instructor.subscriptions') }}">
                    <div class="text"> Total Subscriptions </div>
                    <h5 class="number count-to" data-from="0" data-to="{{ $instructor->totalSubscriptions }}" data-speed="4000" data-fresh-interval="700">
                        {{ $instructor->totalSubscriptions }}
                    </h5>
                </a>
            </div>
        </div>
    </div>

</div>

@if(count($instructor->courses))

<div class="card">

    <div class="header">
        <h2> Courses <strong> Subscriptions </strong></h2>
    </div>

</div>

<div class="row clearfix">
    @foreach($instructor->courses as $course)
    <div class="col-md-4">
        <div class="card">

            <div class="header">
                <h2><strong> <a href="{{ route('instructor.courses.show', $course) }}"> {{ $course->name }} </a> </strong></h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td> <i class="zmdi zmdi-balance"></i> Income </td>
                                <td> {{ $course->totalSubscriptions }} EGP </td>
                            </tr>

                            <tr>
                                <td> <i class="zmdi zmdi-balance"></i> # of Subscriptions </td>
                                <td> 
                                    {{ $course->subscriptions_count }} 
                                    {{ str_plural('Subscription', $course->subscriptions_count) }} 
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endif

@stop 