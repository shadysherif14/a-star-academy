<div class="card-body">

    <div class="md-form">

        <input type="text" name="name" id="name" class="form-control" value="{{ $level->name }}">

        <label for="name"> Level Name </label>

    </div>

    <div class="md-form">

        <textarea type="text" rows="8" name="description" id="description" class="form-control md-textarea">{{ $level->description }}</textarea>

        <label for="description"> Level Description </label>

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