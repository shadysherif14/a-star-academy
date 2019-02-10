@extends('admin.layouts.table') 
@section('table')

<form class="card ajax" action="{{ route('admin.videos.order') }}" method="POST" id="videos-form">

    @csrf @method('put')

    <table class="table table-hover m-b-0" id="table">
        <thead>
            <tr role="row">
                <th> Poster </th>
                <th> Title </th>
                <th> Max Times </th>
                <th> Max Times Price </th>
                <th> 1 Time Price </th>
                <th> Quiz </th>
                <th width="200"> Actions </th>
                <th> Reorder </th>
            </tr>
        </thead>

        <tbody id="videos">
            @foreach($videos as $video)

            <tr role="row" video="{{ $video->path }}">

                <input type="hidden" name="videos[{{ $loop->iteration }}][id]" value="{{ $video->id }}">

                <td>
                    <img src="{{ $video->poster }}" alt="" width="32">
                </td>

                <td> {{ $video->title }} </td>

                <td> {{ $video->max_times }} </td>

                <td>
                    {{ $video->max_price }} EGP
                </td>

                <td>
                    {{ $video->one_price }} EGP
                </td>

                <td>

                    <button href="{{ action('Admin\QuestionController@index', $video) }}" type="button" 
                            class="btn l-amber btn-icon btn-icon-mini btn-round link">
                        <i class="fas fa-question"></i>
                    </button>
                </td>

                <td>
                    <button type="button" class="btn l-turquoise btn-icon btn-icon-mini btn-round modal-trigger">
                        <i class="zmdi zmdi-eye"></i>
                    </button>
                    @include('admin.partials.actions', ['model' => $video, 'actions' =>
                    ['delete', 'edit']])
                </td>

                <td>
                    <button type="button" class="btn l-slategray btn-icon btn-icon-mini btn-round handler">
                        <i class="fas fa-sort"></i>
                    </button>
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
<script src="{{ asset_path('js/admin/videos/index.js') }}"></script>
<script src="{{ asset_path('js/admin/payables/index.js') }}"></script>
@endpush