@extends('layouts.admin') 

@section('title', ' | Courses') 

@section('content')


<div class="card">

    <table class="table table-bordered b4-table table-hover body" id="table" role="grid" aria-describedby="table_info">
        <thead >
            <tr role="row">
                <th> Name </th>
                <th> School </th>
                <th> System </th>
                <th> Sub System </th>
                <th> Level </th>
                <th> Instructor </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($courses as $course)
            <tr role="row">
                <td> {{ $course->name }} </td>
                <td> {{ $course->school }} </td>
                <td> {!! $course->system !!} </td>
                <td> {!! $course->sub_system !!} </td>
                <td> {{ $course->level }} </td>
                <td> {{ $course->instructor }} </td>
                <td>
                    <a href="{{ route('admin.courses.show', ['course' => $course]) }}">
                        <i class="zmdi zmdi-eye"> </i>
                    </a>
                    <a href="{{ route('admin.courses.edit', ['course' => $course]) }}">
                        <i class="zmdi zmdi-edit"> </i>
                    </a>
                    
                    <i class="zmdi zmdi-delete delete" action="{{ route('admin.courses.destroy', ['course' => $course]) }}"> </i>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
               
</div>


@endsection
 
@section('scripts')

    <script> let levels = @json($levels) </script>

    <script src="{{ asset('js/admin/courses/index.js') }}"></script>

@endsection
 

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/courses/index.css') }}"> 
@stop