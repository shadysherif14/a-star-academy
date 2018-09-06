<div class="card-body">

    <div class="md-form">

        <input type="text" name="name" id="name" class="form-control" value="{{ $instructor->name }}">

        <label for="name"> Instructor Name </label>

    </div>

    <div class="md-form">

        <textarea type="text" name="about" id="about" class="form-control md-textarea">{!! $instructor->about !!}</textarea>

        <label for="description"> Instructor About </label>

    </div>

    <div class="md-form">

        <div class="file-field">

            <a class="btn-floating elegant-color-dark mt-0 float-left">
                <i class="fas fa-user" aria-grid="true"></i> <input type="file" name="avatar" />
            </a>

            <div class="file-path-wrapper">
                <input class="file-path" type="text" placeholder="Upload an avatar" />>
            </div>
        </div>
    </div>

    <div class="md-form" id="image-wrapper">
    
        <img src="{{ $instructor->avatar }}" alt="Avatar">
    
        <button type="button" class="btn"> Remove Image </button>
    
        <input type="hidden" name="removed">
    
    </div>

</div>