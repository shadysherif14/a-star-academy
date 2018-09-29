@extends('layouts.admin') 
@section('content')

<div class="row clearfix">

    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="body">
                <img src="{{ $course->image }}" alt="" class="img-fluid rounded m-b-20">
                <h6> {{ $course->name }} </h6>

                <div class="table-responsive">
                    <table class="table table-hover m-t-20">
                        <tbody>
                            <tr>
                                <td> School </td>
                                <td> {{ $course->school }} </td>
                            </tr>

                            @if ($course->system)
                            <tr>
                                <td> System </td>
                                <td> {{ $course->system }} </td>
                            </tr>
                            @endif

                            @if ($course->sub_system)
                            <tr>
                                <td> Sub System </td>
                                <td> {{ $course->sub_system }} </td>
                            </tr>
                            @endif

                            <tr>
                                <td> Level </td>
                                <td> {{ $course->level->name }} </td>
                            </tr>
                            <tr>
                                <td>Instructor</td>
                                <td> <a href="{{ $course->instructor->adminRoutes->show }}"> {{ $course->instructor->name }} </a></td>
                            </tr>

                            <tr>
                                <td>Sessions</td>
                                <td>
                                    <a href="{{ $course->videosRoute() }}"> {{ $course->videosCount }} </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div>
                    <a class="btn bg-blue link" href="{{ $course->adminRoutes->edit }}">
                        <i class="zmdi zmdi-edit"></i> Edit
                    </a>
                    
                    <button class="btn bg-red delete" action="{{ $course->adminRoutes->destroy }}">
                        <i class="zmdi zmdi-delete"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-lg-8">
        <div class="card">
            <div class="body">
                <ul class="nav nav-tabs padding-0">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#description">Course Description</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sessions">Course Sessions</a></li>
                </ul>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="description">
                <div class="card">
                    <div class="body">
                        <h6>Course Description</h6>
                        <p> {{ $course->description }} </p>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="sessions">
                <div class="card">
                    <div class="body">
                        <h6>Course sessions</h6>
                        @if (count($course->videos) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($course->videos as $video)
                                    <tr>
                                        <td> {{ $video->title }} </td>
                                        <td> {{ $video->price }} </td>
                                        <td> @include('admin.partials.actions', ['model' => $video, 'actions' => ['edit', 'delete']]) </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else 
                            <p> This course has no sesions yet. </p>
                        @endunless
                        <a href="{{ $course->videosRoute('create') }}" class="btn btn-primary"> Add new sessions </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
 
@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/shared/cru.css') }}">
@endsection