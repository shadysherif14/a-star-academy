@extends('admin.layouts.create') 
@section('form')

<form action="{{ $course->videosRoute('store') }}" id="form" method="POST" class="ajax" enctype="multipart/form-data">

    @csrf

    <div class="card">

        <div class="header">
            <h2> <strong> <i class="fas fa-video"></i> New </strong> Sessions </h2>
        </div>

        <div class="body">

            <div class="fileinput fileinput-new" data-provides="fileinput">
                <span class="btn btn-primary btn-file">
                <span class=""> Select sessions </span>
                <input type="file" id="files" multiple accept="video/*"> </span>
            </div>


            <div class="price">
                <label>
                    <i class="fas fa-money-bill"></i>
                    <span> Global price </span>
                </label>
                <div class="row">
                    
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                            <i class="fas fa-infinity"></i>
                        </span>
                        <input type="text" id="unlimited-price" class="form-control price" placeholder="Unlimted acces">
                    </div>

                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                            <i class="zmdi zmdi-collection-item-1"></i>
                        </span>
                        <input type="text" id="one-price" class="form-control price" placeholder="One time access">
                    </div>

                </div>
                <small class="form-text">
                    If you left any videos price blank, its price will be set according to these global prices.
                </small>
                
            </div>

        </div>
    </div>

    <div id="videos" class="row clearfix"></div>

    <button type="submit" class="btn btn-primary w-50 mx-auto d-none"> 
        <i class="zmdi zmdi-upload"></i> Upload all session at once 
    </button>

</form>

<video class="d-none" id="video"></video>

@stop 

@push('scripts')
    <script src="{{ secure_asset('assets/plugins/waitMe/waitMe.js') }}"></script>
    <script src="{{ secure_asset('js/admin/videos/create-edit.js') }}"></script>
    <script src="{{ secure_asset('js/admin/videos/create.js') }}"></script>
@endpush