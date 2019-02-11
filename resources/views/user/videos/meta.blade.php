<div class="meta animated">

    @if(!$video->isOverview())
    <div class="one_price">
        <span class="times"> 1 </span>
        <span> <strong> {{ $video->one_price }} </strong> EGP</span>
    </div>

    <div class="max_price">
        <span class="times"> {{ $video->max_times }} </span>
        <span> <strong> {{ $video->max_price }} </strong> EGP </span>
    </div>
    @endif

    <div class="duration">
        <span class="times"> <i class="far fa-clock"></i> </span>
        <span>{{ $video->duration }}</span>
    </div>

</div>