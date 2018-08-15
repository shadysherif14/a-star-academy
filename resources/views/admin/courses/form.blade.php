<div class="card-body">
    <div class="md-form">

        <input type="text" name="name" id="name" class="form-control" value="{{ $course->name }}">

        <label for="name"> Course Name </label>

    </div>

    <div class="md-form">

        <textarea type="text" rows="4" name="description" id="description" class="form-control md-textarea">{!! $course->description !!}</textarea>

        <label for="description"> Course Description </label>

    </div>

    <div class="md-form">

        <div class="file-field">

            <a class="btn-floating elegant-color-dark mt-0 float-left">
                <i class="fas fa-image" aria-grid="true"></i> <input type="file" name="image">
            </a>

            <div class="file-path-wrapper">
                <input class="file-path" type="text" placeholder="Upload an image">
            </div>
        </div>
    </div>


    <div class="md-form" id="image-wrapper">

        @php
            $hidden = $course->id == null ? 'hidden' : '';
            $src = $course->id == null ? '' : $course->image; 
        @endphp
        <img src="{{ $src }}" alt="Course Image" class="{{ $hidden }}">

        <button type="button" class="btn {{ $hidden }}"> Remove Image </button>

    </div>

    <div parent="school">
        <div class="btn-group grid" data-toggle="buttons" id="school">
            @foreach($schools as $school)
                @php
                    if($course->school === $school) {
                        $active = 'active';
                        $checked = true;
                    }
                    else {
                        $active = '';
                        $checked = false;
                    }
                @endphp
                <label class="btn btn-rounded waves-effect btn-elegant form-check-label {{ $active }}">
                <input class="form-check-input" type="radio" checked="{{ $checked }}" name="school" value="{{ $school }}"> {{ $school }}
            </label> 
            @endforeach
        </div>
    </div>


    @php
        if($course->school === "IGCSE")
            $grid = 'grid';
        else
            $grid = 'hidden';
    @endphp

    <div parent="system">    
        <div class="btn-group {{ $grid }}" data-toggle="buttons" id="system">
            @foreach($systems as $system)
                @php
                    if($course->system === $system) {
                        $active = 'active';
                        $checked = true;
                    }
                    else {
                        $active = '';
                        $checked = false;
                    }
                @endphp

                <label class="btn btn-rounded waves-effect btn-elegant form-check-label {{ $active }}">
                <input class="form-check-input" type="radio" name="system" checked={{ $checked }} value="{{ $system }}"> {{ $system }}
            </label> 
            @endforeach
        </div>
    </div>

    <div parent="sub_system">
        <div class="btn-group {{ $grid }}" data-toggle="buttons" id="sub_system">
            @foreach($subSystems as $sub_system)
                @php
                    if($course->sub_system === $sub_system) {
                        $active = 'active';
                        $checked = true;
                    }
                    else {
                        $active = '';
                        $checked = false;
                    }
                @endphp
            <label class="btn btn-rounded waves-effect btn-elegant form-check-label {{ $active }}">
                <input class="form-check-input" type="radio" name="sub_system" checked={{ $checked }} value="{{ $sub_system }}"> {{ $sub_system }}
            </label> 
            @endforeach
        </div>
    </div>
</div>