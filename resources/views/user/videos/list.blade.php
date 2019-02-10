<li class="video-single list-group-item">

    <div class="number">
        <div class="circle">
            <span> {{ $loop->iteration }} </span>
        </div>
    </div>
    <div class="details">
        <h5 class="title">

            <i class="fas {{ $video->userCanWatchIcon() }} mr-2"></i>

            <a href="{{ action('User\VideoController@show', $video) }}">
                {{ $video->title }}
            </a>

        </h5>

        <div class="description">
            <p> {{ $video->description }} </p>
        </div>
        @include('user.videos.meta', $video)
    </div>
</li>