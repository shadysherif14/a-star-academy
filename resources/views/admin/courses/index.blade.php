@extends('admin.layouts.table') 

@section('table')

<table class="table table-hover m-b-0" id="table">
    <thead>
        <tr role="row">
            <th> Name </th>
            <th> School </th>
            <th> System </th>
            <th> Sub System </th>
            <th> Level </th>
            <th> Instructor </th>
            <th> Actions </th>
        </tr>
    </thead>
    <tbody id="questions">
        @foreach($courses as $course)
        <tr role="row">
            <td> {{ $course->name }} </td>
            <td> {{ $course->school }} </td>
            <td> {!! $course->system !!} </td>
            <td> {!! $course->sub_system !!} </td>
            <td> {{ $course->level }} </td>
            <td> {{ $course->instructor }} </td>
            <td> 
                @include('admin.partials.actions', ['model' => $course]) 
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

@endsection

@push('scripts')
<script>
    let levels = @json($levels);
</script>
<script src="{{ asset('js/admin/courses/index.js') }}"></script>
@endpush 

@push('css')
<link rel="stylesheet" href="{{ asset('css/admin/courses/index.css') }}"> 
@endpush