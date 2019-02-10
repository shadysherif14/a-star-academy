@extends('admin.layouts.table') 

@section('table')

<table class="table table-hover m-b-0" id="table">

    <thead>
        <th> # </th>
        <th> Name </th>
        <th> School System</th>
        <th> Actions </th>
    </thead>

    <tbody>

        @foreach($levels as $level)
            <tr>
                <th> {{ $loop->iteration }} </th>
                <td> {{ $level->name }} </td>
                <td> {{ $level->school }} </td>
                <td> 
                    @include('admin.partials.actions', ['model' => $level, 'actions' => ['edit', 'delete']]) 
                </td>
            @endforeach
            </tr>
    </tbody>
</table>

@endsection
 
@push('css')
    <link rel="stylesheet" href="{{ asset_path('css/admin/levels/index.css') }}">
@endpush