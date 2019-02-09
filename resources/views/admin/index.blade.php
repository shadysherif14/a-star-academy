@extends('layouts.admin') 
@section('content')

<div class="row clearfix">

    <div class="col-lg-4 col-md-6">
        <div class="card top_counter">
            <div class="body">
                <div class="icon xl-slategray">
                    <i class="zmdi zmdi-account-o"></i>
                </div>
                <a class="content" href="{{ adminStaticRoute('User') }}">
                    <div class="text"> Students </div>
                    <h5 class="number count-to" data-from="0" data-to="{{ $students }}" data-speed="4000" data-fresh-interval="700">
                        {{ $students }}
                    </h5>
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="card top_counter">
            <div class="body">
                <div class="icon xl-slategray">
                    <i class="zmdi zmdi-account-circle"></i>
                </div>
                <a class="content" href="{{ adminStaticRoute('Instructor') }}">
                    <div class="text"> Instructors </div>
                    <h5 class="number count-to" data-from="0" data-to="{{ $instructors }}" data-speed="4000" data-fresh-interval="700">
                        {{ $instructors }}
                    </h5>
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="card top_counter">
            <div class="body">
                <div class="icon xl-slategray"><i class="zmdi zmdi-graduation-cap"></i> </div>
                <a class="content" href="{{ adminStaticRoute('Course') }}">
                    <div class="text">Courses</div>
                    <h5 class="number count-to" data-from="0" data-to="{{ $coursesCount }}" data-speed="4000" data-fresh-interval="700">
                        {{ $coursesCount }}
                    </h5>
                </a>
            </div>
        </div>
    </div>

</div>


@if(count($courses))

<div class="card">
    
    <div class="header">
        <h2> Courses <strong> Subscriptions </strong></h2>
    </div>

</div>

<div class="row clearfix">
    @foreach($courses as $course)
    <div class="col-md-4">
        <div class="card">

            <div class="header">
                <h2><strong> <a href="{{ $course->adminRoutes->show }}"> {{ $course->name }} </a> </strong></h2>
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
                                <td> {{ $course->subscriptions_count }} {{ str_plural('Subscription', $course->subscriptions_count) }} </td>
                            </tr>

                            <tr>
                                <td> <i class="fas fa-chalkboard-teacher"></i> Instructor </td>
                                <td> {{ $course->Instructor->name }}  </td>
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


@stop @push('scripts') {{--
<script src="{{ asset_path('js/admin/homepage/index.js') }}"></script> --}} 
@endpush