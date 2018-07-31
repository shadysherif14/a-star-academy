@extends('layouts.admin') 
@section('title', 'Admin Dashboard') 
@section('content')


<a href="/admin/instructors/create" class="btn btn-outline-dark m-0"> <i class="fas fa-"></i> New Instructor </a>
<div class="card">

    <div class="card-body">

        <table class="table table-fixed" datatable>

            <thead class="elegant-color align-items-center text-white">
                <tr>
                    <th scope="col" class=""> Name </th>
                    <th scope="col" class=""> Avatar </th>
                    <th scope="col" class=""> About </th>
                    <th scope="col" class="actions" style="width: 300px;"> Actions </th>
                </tr>
            </thead>

            <tbody>

                @foreach($instructors as $instructor)

                <tr id="instructor-{{ $instructor->id }}" instructor="{{ $instructor->id }}" class="">

                    <td content="Name">
                        <p> {{ $instructor->name }} </p>
                    </td>

                    <td content="">
                         <img src="{{ $instructor->avatar }}" alt="">
                    </td>

                    <td content="">
                        <p> {{ $instructor->about }} </p>
                    </td>

            
                    <td content="Actions text-white">
                        <a href="/admin/instructors/{{ $instructor->slug }}" class="btn bttn-fill bttn-xs bttn-primary"><i class="fas fa-eye"></i> <span> Show </span> </a>
                        <a href="/admin/instructors/{{ $instructor->slug }}/edit" class="btn bttn-fill bttn-xs bttn-success"><i class="fas fa-pen"></i> <span> Edit </span> </a>
                        <a class="btn bttn-fill bttn-xs bttn-danger delete"><i class="fas fa-trash"></i> <span> Delete </span></a>
                    </td>
                </tr>

                @endforeach
            </tbody>

        </table>

    </div>
</div>
@endsection
 
@section('scripts')
@endsection
 
@section('css') {{--
<link rel="stylesheet" href="{{ asset('css/instructors/index.css') }}"> --}}
@endsection