<div class="card">
    <div class="content">
        <div class="front active filppers" style="background-image: url({{ $video->poster }})">
            <div class="togglers">
                <i class="typcn typcn-arrow-right-outline animated infinite wobble"></i>
            </div>
            <div class="inner">
                <h2 class="title"> {{ $video->title }} </h2>
            </div>
        </div>
        <div class="back filppers">
            <div class="togglers">
                <i class="typcn typcn-arrow-left-outline animated infinite wobble"></i>
            </div>
            <div class="inner">

                <div class="basic">
                    <h5 class="title"> {{ $video->title }} </h5>
                </div>
                <p class="description scroller"> {{ $video->description() }} </p>
                @include('user.videos.meta', $video)
                <div class="visit">
                    <a href="{{ action('User\VideoController@show', $video) }}" class="btn"> Show Video </a>
                </div>
            </div>
        </div>
    </div>
</div>
