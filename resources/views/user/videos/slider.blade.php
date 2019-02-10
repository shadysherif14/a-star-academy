<div class="session {{ $loop->first ? 'active' : '' }}" slide="{{ $loop->index }}"
    style="background-image: url({{ $video->poster }})">
    <div class="body">

        <h4 class="title animated jackInTheBox">
            <a href="{{ action('User\VideoController@show', $video) }}">
                {{ $video->title }} 
            </a>
        </h4>

        <p class="description animated zoomIn scroller"> {{ $video->description() }} </p>
        @include('user.videos.meta', $video)
    </div>
</div>