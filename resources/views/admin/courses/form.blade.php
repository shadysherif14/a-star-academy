<div class="card">
    <div class="header">
        <h2> <strong>Course</strong> Informaion</h2>
    </div>
    
    <div class="row claerfix body">
    
        <div class="col-md-4">
            @include('admin.partials.file-image', ['inputName' => 'image'])
        </div>
    
        <div class="col-md-8">
    
            <div class="form-group">
                <label for="name"> Course Name </label>
                <input type="text" name="name" id="name" placeholder="Course Name" class="form-control" value="{{ $course->name }}" />
            </div>
    
            <div class="form-group">
                <label for="description"> Course Description </label>
                <textarea type="text" name="description" id="description" 
                class="form-control" placeholder"Course Description">{{ $course->description }}</textarea>
            </div>
    
    
            <div class="form-group">
                <label for="instructor"> Instructor </label>
                <select name="instructor" title="Instructor" id="instructor" class="form-control">
                @foreach($instructors as $instructor)
                    <option value="{{ $instructor->id }}" 
                        {{ $course->instructor_id === $instructor->id ? 'selected' : '' }} > 
                        {{ $instructor->name }} 
                    </option>
                @endforeach
                </select>
            </div>
    
            <div class="form-group">
                <label for="school"> School System </label>
                <select name="school" id="school" class="form-control" title="School System">
                @foreach($schools as $school)
                    <option value="{{ $school }}"
                        {{ $course->school === $school ? 'selected' : '' }} >
                        {{ $school }} 
                    </option>
                @endforeach
                </select>
    
            </div>
    
            <div class="form-group hidden">
                <label for="level"> Level </label>
                <select name="level" id="level" class="form-control" title="Choose Level"></select>
            </div>
    
    
            <div parent="system" id="system" class="form-group hidden">
                <label for=""> Course System </label>
                <div class="radio">
                    @foreach($systems as $system)
                    <input type="radio" name="system" id="radio-{{ $system }}" value="{{ $system }}" />
                    <label for="radio-{{ $system }}"> {{ $system }} </label> 
                    @endforeach
                </div>
            </div>
    
            <div parent="sub_system" id="sub_system" class="form-group hidden">
                <label for=""> Course Subsystem </label>
                <div class="radio">
                    @foreach($subSystems as $subsystem)
                    <input type="radio" name="sub_system" id="radio-{{ $subsystem }}" value="{{ $subsystem }}" />
                    <label for="radio-{{ $subsystem }}" class="mr-3"> {{ $subsystem }} </label>
                    @endforeach
                </div>
            </div>
        </div>
    
    </div>
</div>

@push('scripts')
<script>
    let course = @json($course);
    let levels = @json($levels);
</script>
<script src="{{ asset('js/admin/courses/create-edit.js') }}"></script>
<script src="{{ asset('js/admin/levels-courses/create-edit.js') }}"></script>
@endpush