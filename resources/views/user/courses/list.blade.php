<section id="{{ $course->slug }}" class="single wow fadeInUp" data-search="{{ $course->name }}" data-school="{{$course->school}}"
    data-system="{{$course->system}}" data-subsystem="{{$course->sub_system}}" data-grade="{{$course->level->name}}">
    @auth
    <img src="{{ imageIcon($course->liked ? 'red-heart' : 'white-heart') }}" alt="" class="icon like" action="{{ route('like.courses', $course) }}">    @endauth
    <div class="details">
        <div class="title">
            <h3 class="name"> {{ $course->name }} </h3>
        </div>
        <section class="tags">
            <a class="filter" href="{{ route('courses.index', ['school' => $course->school]) }}">
                <span class="tag">{{ $course->school }}</span>
            </a> @if($course->level->name != 'General')
            <a class="filter" href="{{ route('courses.index', ['level' => $course->level->name]) }}">
                <span class="tag">{{ $course->level->name }}</span> 
            </a> @endif @if($course->system && $course->system != 'General')
            <a class="filter" href="{{ route('courses.index', ['system' => $course->system]) }}">            
                <span class="tag">{{ $course->system }}</span> 
            </a> @endif @if($course->sub_system && $course->sub_system != 'General')
            <a class="filter" href="{{ route('courses.index', ['sub_system' => $course->sub_system]) }}">            
                <span class="tag">{{ $course->sub_system }}</span> 
            </a> @endif
        </section>
        <div class="instructor">
            <img class="img-raised" src="{{ $course->instructor->avatar }}" alt="Instructor Avatar">
            <h5 class="name">
                <a href="{{ action('User\InstructorController@show', $course->instructor) }}"> {{ $course->instructor->name }} </a>
            </h5>
        </div>
        <p class="description"> {{ $course->description }} </p>
        <p class="meta"> <img src="{{ imageIcon('video') }}" alt="" class="icon"> {{ $course->videosCount }} </p>

        <div class="buttons-wrapper">
            <div class="buttons">
                <a class="btn" href="{{ action('User\CourseController@show', $course) }}"> Show Course </a> @if($course->overview())
                <a class="btn" href="{{ action('User\VideoController@show', $course->overview()) }}"> Watch Free Preview </a>                @endif
            </div>
        </div>
    </div>
    <div class="image-wrapper">
        <img src="{{ $course->image }}" alt="Course Image" class="img-resposnive">
    </div>
</section>