<a href="{{ action('User\VideoController@show', $video) }}" class="wow">
    <div class="video-single">
        <div class="image">
            <img class="img-raised" src="{{ $video->poster }}" alt="">
        </div>
        <div class="body">
            <h4 class="title">
                {{ $video->title }}
            </h4>
        </div>
        @include('user.videos.meta', $video)
    </div>
</a>