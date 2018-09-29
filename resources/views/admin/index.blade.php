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
                    <h5 class="number count-to" data-from="0" data-to="{{ $courses }}" data-speed="4000" data-fresh-interval="700">
                        {{ $courses }}
                    </h5>
            </div>
        </div>
    </div>
</div>

</div>

@stop