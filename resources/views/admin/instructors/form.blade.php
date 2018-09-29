<div class="card">

    <div class="header">
        <h2> <strong> Basic </strong> Information </h2>
    </div>

    <div class="row clearfix body">
    
        <div class="col-md-4">
            @include('admin.partials.file-image', ['inputName' => 'avatar'])
        </div>
    
        <div class="col-md-8">
    
            <div class="form-group">
                <label for="name"> Name </label> @include('partials.required')
                <input type="text" name="name" id="name" class="form-control" value="{{ $instructor->name }}">
            </div>
    
            <div class="form-group">
                <label for="email"> Email </label> @include('partials.required')
                <input type="email" name="email" id="email" class="form-control" value="{{ $instructor->email }}">
            </div>
    
            <div class="row clearfix">
    
                <div class="form-group col-md-6">
                    <label for="password"> Password </label> @include('partials.required')
                    <input type="password" name="password" id="password" class="form-control">
                </div>
        
                <div class="form-group col-md-6">
                    <label for="password_confirmation"> Confirm password </label> @include('partials.required')
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>
    
            </div>
            
            <div class="form-group">
                <label for="phone"> Phone Number </label>
                <input type="number" name="phone" id="phone" class="form-control" value="{{ $instructor->phone }}">
            </div>

            <div class="form-group">
                <label for="about"> About </label>
                @include('partials.required')
                <textarea type="text" name="about" id="about" class="form-control">{{ $instructor->about }}</textarea>
            </div>
    
        </div>
    </div>

</div>

<div class="card">

    <div class="header">
        <h2><strong>Instructor</strong> Social Media Info </h2>
    </div>

    <div class="body row clearfix">

        <div class="col-lg-4 col-md-6 col-sm-10 mx-auto">
            <div class="form-group">
                <label for="facebook"> Facebook </label>
                <input type="text" class="form-control" id="facebook" 
                placeholder="Facebook" name="accounts[facebook]" value="{{ $instructor->accounts('facebook') }}">
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 col-sm-10 mx-auto">
            <div class="form-group">
                <label for="twitter"> Twitter </label>
                <input type="text" class="form-control" id="twitter" 
                placeholder="Twitter" name="accounts[twitter]" value="{{ $instructor->accounts('twitter') }}">
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-10 mx-auto">
            <div class="form-group">
                <label for="linkedin"> LinkedIN </label>
                <input type="text" class="form-control" id="linkedin" 
                placeholder="LinkedIN" name="accounts[linkedin]" value="{{ $instructor->accounts('linkedin') }}">
            </div>
        </div>

    </div>
</div>

@push('scripts')
    <script>
        let instructor = @json($instructor);
    </script>
    <script src="{{ asset('js/admin/instructors/create-edit.js') }}"></script>
    <script src="{{ asset('js/admin/levels-courses/create-edit.js') }}"></script>
@endpush