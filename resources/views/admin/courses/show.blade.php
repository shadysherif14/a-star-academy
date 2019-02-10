@extends('layouts.admin') 
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

            <div class="tab-pane" id="description">
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
                        <a href="{{ $course->videosRoute('create') }}" class="btn btn-primary"> Add new sessions </a>
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

                            <a class="btn bg-blue mb-2" href="{{ action('Admin\VideoController@edit', $course->overview()) }}"> 
                                <i class="zmdi zmdi-edit"></i> Edit 
                            </a>

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
                            <video id="video" controls id="session-video" poster="{{ $course->overview()->poster }}">
                                <source class src="{{ $course->overview()->path }}" type="video/mp4">
                            </video>
                        </div>

                    @else

                    <form action="{{ $course->videosRoute('store') }}" id="form" method="POST" class="ajax" enctype="multipart/form-data">
                    
                        @csrf
                        <input type="hidden" name="duration" id="video-duration">
                        <input type="hidden" name="poster" id="video-poster">
                        <div class="body">
                
                            <div class="form-group">
                                <label for="videos-list"> Video </label>
                                <select id="videos-list" name="video" title="Video" class="form-control">
                                @foreach($videos as $video)
                                    <option value="{{ $video }}"> {{ $video }} </option>
                                @endforeach
                                </select>
                            </div>

                            <video class="d-none" id="video"></video>

                            <div class="form-group">
                                <label for="title"> Title </label>
                                <input type="text" class="form-control" name="title" placeholder="Title" 
                                value="{{ $course->name }} Course Overview">
                            </div>

                            <div class="form-group">
                                <label for="description"> Description </label>
                                <textarea name="description" class="form-control" rows="2" placeholder="Description"></textarea>
                            </div>

                            <input type="hidden" name="overview" value="1">

                            <button class="btn bg-primary"> <i class="fas fa-upload"></i> Upload </button>

                        </div>

                    </form>
                    @endif

                </div>
            </div>

            <div class="tab-pane active" id="subscriptions">
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

                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
 

@push('scripts')
    <script>let path = @json(asset("storage/{$course->videosPath}"))</script>
    <script src="{{ asset_path('js/admin/videos/create.js') }}"></script>
@endpush