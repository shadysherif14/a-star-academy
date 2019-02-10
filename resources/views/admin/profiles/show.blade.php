@extends('admin.layouts.create') 
@section('form')

<form action="{{ route('admin.profile.update') }}" method="post" class="col-12 file-ajax" enctype="multipart/form-data">

    @csrf
    
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
                    <label for="name"> Name </label>
                    @include('partials.required')
                    <input type="text" name="name" id="name" class="form-control" value="{{ $admin->name }}">
                </div>
    
                <div class="form-group">
                    <label for="email"> Email </label>
                    @include('partials.required')
                    <input type="email" name="email" id="email" class="form-control" value="{{ $admin->email }}">
                </div>
    
                <div class="row clearfix">
    
                    <div class="form-group col-md-6">
                        <label for="password"> Password </label>
                        @include('partials.required')
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
    
                    <div class="form-group col-md-6">
                        <label for="password_confirmation"> Confirm password </label>
                        @include('partials.required')
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>
    
                </div>
    
            </div>
        </div>
    
    </div>
    
    @include('admin.partials.edit-button')

</form>


@stop