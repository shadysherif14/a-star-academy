<div class="card-body">

    <div class="md-form">

        <input type="text" name="name" id="name" class="form-control" value="{{ $course->name }}">

        <label for="name"> Course Name </label>

    </div>

    <div class="md-form">

        <textarea type="text" name="description" id="description" class="form-control md-textarea">{!! $course->description !!}</textarea>

        <label for="description"> Course Description </label>

    </div>

    <div class="md-form">
    
        <div class="file-field">
    
            <a class="btn-floating elegant-color-dark mt-0 float-left">
                    <i class="fas fa-image" aria-grid="true"></i> <input type="file" name="image" />
                </a>
    
            <div class="file-path-wrapper">
                <input class="file-path" type="text" placeholder="Upload an image" />>
            </div>
        </div>
    </div>
    
    <div class="md-form" id="image-wrapper">
    
        <img src="{{ $course->image }}" alt="Course Image">
    
        <button type="button" class="btn"> Remove Image </button>
    
        <input type="hidden" name="removed">
    
    </div>

    <div class="row justify-content-between">

        <div class="md-form col-md-5 mx-0">
        
            <select name="instructor" id="instructor" class="mdb-select">
            
                @if(is_null($course->instructor_id))
                    <option value="" selected disabled> Choose Instructor </option>
                @else
                    <option value="" disabled> Choose Instructor </option>
                @endif
    
                @foreach($instructors as $instructor)
                    @if($course->instructor_id === $instructor->id)
                        <option value="{{ $instructor->id }}" selected> {{ $instructor->name }} </option>
                    @else
                        <option value="{{ $instructor->id }}"> {{ $instructor->name }} </option>                    
                    @endif
                @endforeach
            </select>
        
            <label for="instructor"> Instructor </label>
        </div>
    
        <div class="md-form col-md-5 mx-0">
    
            <select name="school" id="school" class="mdb-select">
                @if(is_null($course->school))
                    <option value="" disabled selected> Choose Course System </option>
                @else
                    <option value="" disabled> Choose Course System </option>
                @endif
                @foreach($schools as $school)
                    @if($course->school === $school)
                        <option value="{{ $school }}" selected> {{ $school }} </option>
                    @else
                        <option value="{{ $school }}"> {{ $school }} </option>                    
                    @endif
                @endforeach
            </select>
    
            <label for="school"> School System </label>
        </div>
    </div>

    @if(is_null($course->level_id))
    <div class="md-form hidden">
    @else
    <div class="md-form">
    @endif
        <select name="level" id="level" class="mdb-select">

            @if(!is_null($course->level_id))
            <option value="" disabled> Choose Level </option>

            @foreach($levels as $level)
                @if($course->level_id === $level->id)
                    <option value="{{ $level->id }}" selected> {{ $level->name }} </option>
                @else
                    <option value="{{ $level->id }}"> {{ $level->name }} </option>                    
                @endif
            @endforeach

            @endif
        </select>
        <label for="level"> Level </label>
    </div>

    <div parent="system">
        <div class="btn-group hidden" data-toggle="buttons" id="system">
            @foreach($systems as $system)
            <label class="btn btn-rounded waves-effect btn-elegant form-check-label">
                <input class="form-check-input" type="radio" name="system" value="{{ $system }}"> {{ $system }}
            </label> 
            @endforeach
        </div>
    </div>

    <div parent="sub_system">
        <div class="btn-group hidden" data-toggle="buttons" id="sub_system">
            @foreach($subSystems as $sub_system)
            <label class="btn btn-rounded waves-effect btn-elegant form-check-label">
                <input class="form-check-input" type="radio" name="sub_system" value="{{ $sub_system }}"> {{ $sub_system }}
            </label> 
            @endforeach
        </div>
    </div>
</div>