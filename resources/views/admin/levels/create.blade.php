@extends('layouts.admin') 

@section('title', 'Admin Dashboard') 

@section('content')


<div class="card w-75 mx-auto">

    <div class="card-header elegant-color-dark white-text">

        <h4> <i class="fas fa-list"></i> New Level </h4>

    </div>

    <div class="card-body">

        <form action="/admin/levels" method="post" class="p-3" enctype="multipart/form-data">

            @csrf

            <div class="md-form">

                <input type="text" name="name" id="name" class="form-control">

                <label for="name"> Level Name </label>

                <small class="text-danger font-weight-bold"> {{ $errors->first('name') }} </small>

            </div>

            <div class="md-form">

                <textarea type="text" rows="4" name="description" id="description" class="form-control md-textarea"></textarea>

                <label for="description"> Level Description </label>

                <small class="text-danger font-weight-bold"> {{ $errors->first('description') }} </small>

            </div>


            <div class="md-form">

                <div class="file-field">
                    
                    <a class="btn-floating elegant-color-dark mt-0 float-left">
                        <i class="fas fa-image" aria-hidden="true"></i> <input type="file" name="image">
                    </a>

                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload an image">
                    </div>

                </div>

                <small class="text-danger font-weight-bold"> {{ $errors->first('image') }} </small>
                
            </div>

            <button type="submit" class="btn btn-elegant btn-sm btn-rounded"> Add </button>

        </form>

    </div>

</div>
@endsection
 
@section('scripts')
@endsection