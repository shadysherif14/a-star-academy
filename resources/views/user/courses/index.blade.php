@extends('layouts.user')
@section('content')

<div class="header">
    <div class="body">
        <img src="{{ imageIcon('books') }}" alt="">
        <h1> Our Courses </h1>
    </div>
</div>

<section id="search" class="p-3">
    <div class="input-group my-0">
        <span class="input-group-addon">
            <i class="fas fa-search"></i>
        </span>
        <input type="text" class="form-control search" placeholder="Search by course name...">
        <button id="clear-search" class="btn hvr-bounce-to-top mx-1 my-0 waves-effect waves-black">Clear</button>
    </div>
   {{--   <div class="row">
        <div parent="school" class="my-3" id="school">

            <label class="label" for=""> School System <span class="text-danger align-middle font-20">*</span> </label>

            <div class="pretty p-jelly p-image p-plain">
                <input type="radio" name="school" value="SAT" autocomplete="off">
                <div class="state">
                    <img src="http://127.0.0.1:8000/images/icons/school.png" alt="" class="icon">
                    <label> American Diploma </label>
                </div>
            </div>

            <div class="pretty p-jelly p-image p-plain">
                <input type="radio" name="school" value="IGCSE" autocomplete="off">
                <div class="state">
                    <img src="http://127.0.0.1:8000/images/icons/school.png" alt="" class="icon">
                    <label> IGCSE </label>
                </div>
            </div>

        </div>

        <div class="holder col-md-3 form-group">
            <label for="instructor"> School </label>
            <div class="option">
                <input type="radio" name="school" id="sat">
                <span>SAT</span>
            </div>

            <div class="option">
                <input type="radio" name="school" id="igcse">
                <span>IGCSE</span>
            </div>
        </div>

        <div class="holder col-md-3 form-group">
            <label for="instructor"> System </label>
            <div class="option">
                <input type="radio" name="system" id="cambridge">
                <span>Cambridge</span>
            </div>
            <div class="option">
                <input type="radio" name="system" id="edexcel">
                <span>Edexcel</span>
            </div>
        </div>

        <div class="holder col-md-3 form-group">
            <label for="instructor"> Sub-System </label>
            <div class="option">
                <input type="radio" name="subsystem" id="ol">
                <span>OL</span>
            </div>
            <div class="option">
                <input type="radio" name="subsystem" id="al">
                <span>AL</span>
            </div>
            <div class="option">
                <input type="radio" name="subsystem" id="as">
                <span>AS</span>
            </div>
            <div class="option">
                <input type="radio" name="subsystem" id="a2">
                <span>A2</span>
            </div>
        </div>

        <div class="holder col-md-3 form-group">
            <label for="instructor"> Grade </label>
            <div class="option">
                <input type="radio" name="school" id="sat">
                <span>SAT</span>
            </div>
            <div class="option">
                <input type="radio" name="school" id="igcse">
                <span>IGCSE</span>
            </div>
        </div>
    </div>  --}}

</section>
<section id="list">
    @foreach($courses as $course)
    @include('user.courses.list', $course) @endforeach
</section>





@stop @push('css')
<link rel="stylesheet" href="{{ asset_path('css/user/courses/index.css') }}">
@endpush @push('scripts')
<script src="{{ asset_path('js/user/courses/index.js') }}"></script>





@endpush