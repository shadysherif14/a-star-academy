<div class="card-body">

    <div class="md-form">

        <input type="text" name="name" id="name" class="form-control" value="{{ $level->name }}">

        <label for="name"> Level Name </label>

    </div>


    <div class="md-form">

        <textarea type="text" name="description" id="description" class="form-control md-textarea">{{ $level->description }}</textarea>

        <label for="description"> Level Description </label>

    </div>

    <div class="md-form">
        <select name="school" id="school" class="mdb-select">
            @if(is_null($level->school))
                <option value="" disabled selected> Choose Level System </option>
            @else
                <option value="" disabled> Choose Level System </option>
            @endif
            @foreach($schools as $school)
                @if($level->school === $school)
                    <option value="{{ $school }}" selected> {{ $school }} </option>
                @else
                    <option value="{{ $school }}"> {{ $school }} </option>                    
                @endif
            @endforeach
        </select>
        <label for="school"> School System </label>
    </div>

    <div class="md-form input-group">

        <input type="text" name="" id="new_school" class="form-control" value="">

        <label for="new_school"> New School System </label>

        <div class="input-group-append">
            <button class="btn btn-dark btn-sm waves-effect" style="margin: 0px !important;" id="add-school-btn" type="button"> Add </button>
        </div>

    </div>
    
    <div class="md-form">

        <div class="file-field">

            <a class="btn-floating elegant-color-dark mt-0 float-left">
                <i class="fas fa-image" aria-hidden="true"></i> <input type="file" name="image">
            </a>

            <div class="file-path-wrapper">
                <input class="file-path" type="text" placeholder="Upload an image">
            </div>

        </div>
    </div>

    
    <div class="md-form" id="image-wrapper">

        @php
            $hidden = $level->id == null ? 'hidden' : '';
            $src = $level->id == null ? '' : $level->image; 
        @endphp
        <img src="{{ $src }}" alt="Course Image" class="{{ $hidden }}">

        <button type="button" class="btn {{ $hidden }}"> Remove Image </button>

    </div>
</div>