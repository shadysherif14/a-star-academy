@extends('admin.layouts.table')

@section('table')

<form class="card ajax" action="{{ route('admin.videos.order') }}" method="POST" id="videos-form">

    @csrf

    @method('put')

    <table class="table table-hover m-b-0" id="table">
        <thead>
            <tr role="row">
                <th> Title </th>
                <th> Price </th>
                <th> Quiz </th>
                <th> Actions </th>
            </tr>
        </thead>

        <tbody id="videos">
            @foreach($videos as $video)

                <tr role="row" video="{{ $video->path }}">
                    <input type="hidden" name="videos[{{ $loop->iteration }}][id]" value="{{ $video->id }}">
                    <td> {{ $video->title }} </td>
                    <td> 
                        <button type="button" price={{ $video->price }} 
                                action="{{ route('admin.payables.show', ['payable' => $video]) }}" class="pay btn btn-link">   
                            Pay {{ $video->price }} L.E
                        </button>
                    </td>

                    <td>
                        <a href="{{ route('admin.quizzes.index', ['video' => $video]) }}" class="btn btn-link">
                            Quiz
                        </a>
                    </td>

                    <td> 
                        <button type="button" class="btn l-turquoise btn-icon btn-icon-mini btn-round modal-trigger">
                            <i class="zmdi zmdi-eye"></i>
                        </button>
                        @include('admin.partials.actions', ['model' => $video, 'actions' => ['delete', 'edit']]) 
                    </td>
                </tr> 
            @endforeach
        </tbody>

    </table>


    <button class="btn btn-submit" type="submit">
        <i class="fas fa-pen"> Update </i>
    </button>

</form>

<div class="modal fade" id="video-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

            <!--Body-->
            <div class="modal-body mb-0 p-0">

                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                    <iframe class="embed-responsive-item" src="" allowfullscreen></iframe>
                </div>

            </div>

        </div>

    </div>
</div>


@include('includes.payable_form')

@endsection
 
@push('scripts')
    <script src="{{ asset('js/admin/videos/index.js') }}"></script>
    <script src="{{ asset('js/admin/payables/index.js') }}"></script>
@endpush
 