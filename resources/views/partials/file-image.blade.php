<div class="fileinput fileinput-new" data-provides="fileinput">

    @isset($label)
        <label class="" for=""> {{ $label }} </label>    
    @endisset
    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 320px; max-height: 320px;"> </div>
    <div>
        <span class="btn btn-primary btn-file">
            <span class="fileinput-new"> Choose an Image </span>
        <span class="fileinput-exists"> Change </span>
        <input type="file" name="{{ $inputName }}"> </span>
        <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
    </div>
</div>