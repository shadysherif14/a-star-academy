
@extends('layouts.instructor') 

@section('content')
<div class="card">

    <div class="header">
        <h2><strong> {{ $title }} </strong> List</h2>
    </div>
    <div class="body table-responsive">
        <table class="table table-hover m-b-0" id="table">
            <thead>
                <tr role="row">
                    <th> Name </th>
                    <th> Instructor </th>
                    <th> Level </th>
                    <th> School </th>
                    <th> System </th>
                    <th> Sub System </th>
                    <th> Actions </th>
                </tr>
            </thead>
            <tbody id="questions">
                @foreach($courses as $course)
                <tr role="row">
                    <td> {{ $course->name }} </td>
                    <td> {{ $course->instructor->name }} </td>
                    <td> {{ $course->level->name }} </td>
                    <td> {{ $course->level->school }} </td>
                    <td> {!! $course->system !!} </td>
                    <td> {!! $course->sub_system !!} </td>
                    <td>
                        <button type="button" class="btn l-turquoise btn-icon btn-icon-mini btn-round link" href="{{ route('instructor.courses.show', $course) }}">
                            <i class="zmdi zmdi-eye"></i>
                        </button>
                    </td>
                </tr>
        
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection