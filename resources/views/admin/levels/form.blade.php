<div class="header">

    <h2> <strong><i class="fas fa-list"></i> Level</strong> Information </h2>

</div>

<div class="body row clearfix">

    <div class="col-md-4">
        @include('admin.partials.file-image', ['inputName' => 'image'])
    </div>

    <div class="col-md-8">

        <div class="form-group">

            <label for="name"> Level Name </label>

            <input type="text" name="name" id="name" class="form-control" value="{{ $level->name }}">

        </div>

        <div class="form-group">

            <label for="name"> School System </label>
            
            <select name="school" id="school" class="custom-select">
            @foreach($schools as $school)
                @if($level->school === $school)
                    <option value="{{ $school }}" selected> {{ $school }} </option>
                @else
                    <option value="{{ $school }}"> {{ $school }} </option>                    
                @endif
            @endforeach
        </select>

        </div>


        <div class="form-group">

            <label for="new_school"> New School System </label>

            <div class="d-flex">

                <input type="text" name="" id="new_school" class="form-control" value="">

                <button class="btn btn-primary" id="add-school-btn" type="button" style="margin: 0px; border-radius: 0px; width: 120px;">
                    Add
                </button>

            </div>

        </div>
    </div>

</div>

@push('scripts')
<script>
    let level = @json($level);

</script>
<script src="{{ asset_path('js/admin/levels/create-edit.js') }}"></script>
<script src="{{ asset_path('js/admin/levels-courses/create-edit.js') }}"></script>

@endpush