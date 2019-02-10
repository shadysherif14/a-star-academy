<div class="meta animated">

    @if(!$video->isOverview())
    <div class="one_price">
        <img src="{{ imageIcon('one') }}" alt="one" class="icon">
        <span> <strong> {{ $video->one_price }} </strong> EGP</span>
    </div>

    <div class="max_price">
        <img src="{{ imageIcon('infinity') }}" alt="infinity" class="icon">
        <span> <strong> {{ $video->max_price }} </strong> EGP </span>
    </div>
    @endif

    <div class="duration">
        <img src="{{ imageIcon('clock') }}" alt="time" class="icon">
        <span>{{ $video->duration }}</span>
    </div>

</div>