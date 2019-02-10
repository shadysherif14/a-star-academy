@extends('layouts.instructor')
@section('content')

<div class="row clearfix">

    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="body">
                <img src="{{ $course->image }}" alt="" class="img-fluid rounded m-b-20">
                <h6> {{ $course->name }} </h6>

                <div class="table-responsive">
                    <table class="table">
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
                                <td> Sessions </td>
                                <td> {{ $course->videosCount }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-12 col-lg-8">

        <div class="card">
            <div class="body">
                <ul class="nav nav-tabs p-0">

                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#description">Course Description</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#sessions"> Course Sessions </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#overview"> Course Overview </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#subscriptions"> Course Subscriptions </a>
                    </li>
                    

                </ul>
            </div>
        </div>

        <div class="tab-content">

            <div class="tab-pane active" id="description">
                <div class="card">
                    <div class="header">
                        <h2> <strong> Course </strong> Description </h2>
                    </div>
                    <div class="body">
                        <p> {{ $course->description }} </p>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="sessions">

                <div class="card">

                    <div class="header">
                        <h2> <strong> Course </strong> Sessions </h2>
                    </div>
                    
                    <div class="body">
                        @if (count($course->videos) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless">

                                <thead>
                                    <th> Title </th>
                                    <th> # of Subscription </th>
                                    <th> Total Subscription Price </th>
                                </thead>
                                <tbody>
                                    @foreach ($course->videos as $video)
                                    <tr>
                                        <td> {{ $video->title }} </td>
                                        <td> {{ $video->users()->count() }} {{ str_plural('Subscription', $video->users()->count()) }} </td>
                                        <td> {{ $video->users()->sum('price') }} EGP </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else 
                            <p> This course has no sesions yet. </p>
                        @endunless
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="overview">

                <div class="card">

                    <div class="header">
                        <h2> <strong> Course </strong> Overview </h2>
                    </div>

                    @if($course->overview())

                        <div class="body">

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td> Title </td>
                                            <td> {{ $course->overview()->title }} </td>
                                        </tr>
                            
                                        <tr>
                                            <td> Description </td>
                                            <td> {{ $course->overview()->description }} </td>
                                        </tr>
                            
                                    </tbody>
                                </table>
                            </div>

                            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                                <video controls id="session-video" poster="{{ $course->overview()->poster }}">
                                    <source class="embed-responsive-item" src="{{ $course->overview()->path }}" type="video/mp4">
                                </video>
                            </div>
                        </div>

                    @else

                    <div class="body">
                        <p>No overview sessions has been uploaded yet.</p>
                    </div>
                    @endif

                </div>
            </div>

            <div class="tab-pane" id="subscriptions">
                <div class="card">
                    <div class="header">
                        <h2><strong> Course </strong> Subscriptions </h2>
                    </div>
                    <div class="body">
                        @if(count($course->subscriptions))

                        <div class="table-responsive">
                            <table class="table table-hover table-borderless">
                               <thead>
                                   <tr>
                                       <th> Session </th>
                                       <th> User </th>
                                       <th> Type </th>
                                       <th> Date </th>
                                   </tr>
                               </thead>

                               <tbody>
                                @foreach ($course->subscriptions as $subscription)
                                    <tr>
                                        <td> {{ $subscription->video->title }} </td>
                                        <td> {{ $subscription->user->name }} </td>
                                        <td> {{ $subscription->type }} </td>
                                        <td> {{ $subscription->created_at }} </td>
                                    </tr>
                                @endforeach
                               </tbody>
                            </table>
                        </div>
                        @else
                            <p> This course has no subsriptions yet. </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
 
