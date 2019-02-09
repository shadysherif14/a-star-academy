@extends('layouts.admin') 

@section('content')

    <div class="row clearfix">

        <div class="col-lg-5 col-md-12">
            <div class="card">
                <div class="body">
                    <img src="{{ $instructor->avatar }}" alt="" class="img-fluid rounded m-b-20">
                    <h6> {{ $instructor->name }} </h6>
                    <div class="table-responsive">
                        <table class="table table-hover m-t-20">
                            <tbody>

                                @if($instructor->email)
                                <tr>
                                    <td> Email </td>
                                    <td> {{ $instructor->email }} </td>
                                </tr>
                                @endif 
                                
                                @if ($instructor->phone)
                                <tr>
                                    <td> Phone </td>
                                    <td> {{ $instructor->phone }} </td>
                                </tr>
                                @endif

                                <tr>
                                    <td> Courses </td>
                                    <td class="col-green">
                                        <strong>{{ $instructor->coursesCount }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    @if ($instructor->accounts)
                    <div class="row mb-3 social-widget justify-content-center">
                        @foreach ($instructor->accounts as $name => $link)
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

                    <div class="row justify-content-center">
                        <a class="btn bg-blue link" href="{{ $instructor->adminRoutes->edit }}">
                            <i class="zmdi zmdi-edit"></i>
                            Edit
                        </a>

                        <button class="btn bg-red delete" action="{{ $instructor->adminRoutes->destroy }}">
                            <i class="zmdi zmdi-delete"></i> 
                            Delete
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-12 col-lg-7">
            <div class="card">
                <div class="body">
                    <ul class="nav nav-tabs padding-0">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#about"> About </a>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#courses">Instructor courses</a></li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="about">
                    <div class="card">
                        <div class="header">

                            <h2 class="mb-3"> <strong> Instructor </strong> About </h2>

                        </div>
                        <div class="body">
                            <p> {{ $instructor->about }} </p>
                        </div>
                    </div>
                </div>
        
                <div class="tab-pane" id="courses">
                    <div class="card">
                        <div class="header">
                            <h2 class="mb-3"><strong>Instructor</strong> Courses</h2>
                        </div>

                        <div class="body">
                            @if (count($instructor->courses) > 0)
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover ">
                                    <thead>
                                        <tr>
                                            <th> Name </th>
                                            <th> School </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($instructor->courses as $course)
                                        <tr>
                                            <td> 
                                                <a href="{{ $course->adminRoutes->show }}"> {{ $course->name }} </a>
                                            </td>
                                            <td> {{ $course->school }} </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <p> <strong class="text-warning"> {{ $instructor->name }} </strong> has no courses yet. </p>
                            @endif
                        </div>
                    </div>
                </div>
        
            </div>
        </div>
    </div>
@stop 
