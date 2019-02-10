@extends('admin.layouts.table')

@section('table')

<table class="table table-hover m-b-0" id="table">
    <thead>
        <tr role="row">
            <th> Image </th>
            <th> Name </th>
            <th> No. of courses </th>
            <th> No. of sessions </th>
            <th> Actions </th>
        </tr>
    </thead>
    <tbody>
        @foreach($instructors as $instructor)
        <tr role="row">
            <td>
                <span class="list-icon">
                    <img class="rounded" src="{{ $instructor->avatar }}" alt="" width="40" height="40">
                </span>
            </td>
            <td> {{ $instructor->name }} </td>
            <td> {{ $instructor->coursesCount }} </td>
            <td> {{ $instructor->videosCount }} </td>
            <td> @include('admin.partials.actions', ['model' => $instructor]) </td>
        </tr>
    
        @endforeach
    </tbody>
</table>
@endsection
