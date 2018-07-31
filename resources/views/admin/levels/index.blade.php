@extends('layouts.admin') 
@section('title', 'Admin Dashboard') 
@section('content')


<div class="card">

    <div class="card-body">

        @if(count($levels))

        <table class="table table-fixed" datatable>

            <thead class="elegant-color align-items-center text-white">
                <tr>
                    <th scope="col" class="name"> Name </th>
                    <th scope="col" class="description"> Description </th>
                    <th scope="col" class="image"> Image </th>
                    <th scope="col" class="actions"> Actions </th>
                </tr>
            </thead>

            <tbody>

                @foreach($levels as $level)

                <tr id="level-{{ $level->id }}" level="{{ $level->id }}" class="">

                    <td>
                        <p> {{ $level->name }} </p>
                    </td>

                    <td>
                        <p> {{ $level->description }} </p>
                    </td>

                    <td> <img src="{{ asset('storage') }}/{{ $level->image }}" alt="Level Image"> </td>

                    <td>
                        <a href="/admin/levels/{{ $level->slug }}" class="blue"><i class="fas fa-eye"></i> <span> Show </span> </a>
                        <a href="/admin/levels/{{ $level->slug }}/edit" class="green"><i class="fas fa-pen"></i> <span> Edit </span> </a>
                        <a class="red delete"><i class="fas fa-trash"></i> <span> Delete </span></a>
                    </td>
                </tr>

                @endforeach
            </tbody>

        </table>
        @endif
    </div>
</div>
@endsection
 
@section('scripts')
@endsection
 
@section('css')
<link rel="stylesheet" href="{{ asset('css/levels/index.css') }}">
@endsection