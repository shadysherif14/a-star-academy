@extends('layouts.admin') 
@section('title', 'Admin Dashboard') 
@section('content')


<div class="card">

    <div class="card-body">

        <a href="/admin/courses/create" class="btn btn-outline-dark m-0"> <i class="fas fa-graduation-cap"></i> New Course </a>
        <table class="table table-fixed" datatable>

            <thead class="elegant-color align-items-center text-white">
                <tr>
                    <th scope="col" class="name"> Name </th>
                    <th scope="col" class="school"> School </th>
                    <th scope="col" class="system"> System </th>
                    <th scope="col" class="sub_system"> Sub Sytem </th>
                    <th scope="col" class="actions"> Actions </th>
                </tr>
            </thead>

            <tbody>

                @foreach($courses as $course)

                <tr id="course-{{ $course->id }}" course="{{ $course->id }}" class="">

                    <td content="Name">
                        <p> {{ $course->name }} </p>
                    </td>

                    <td content="Description">
                        <p> {{ $course->description }} </p>
                    </td>

                    <td content="Shcool">
                        <p> {{ $course->school }} </p>
                    </td>

                    <td content="System">
                        <p> {{ $course->system }} </p>
                    </td>

                    <td content="Sub System">
                        <p> {{ $course->sub_system }} </p>
                    </td>

                    <td content="Image"> <img src="{{ asset('storage') }}/{{ $course->image }}" alt="Course Image"> </td>

                    <td content="Actions">
                        <a href="/admin/courses/{{ $course->slug }}" class="btn bttn-fill bttn-xs bttn-primary"><i class="fas fa-eye"></i> <span> Show </span> </a>
                        <a href="/admin/courses/{{ $course->slug }}/edit" class="btn bttn-fill bttn-xs bttn-success"><i class="fas fa-pen"></i> <span> Edit </span> </a>
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
 
@section('css')
    <link rel="stylesheet" href="{{ asset('css/courses/index.css') }}">
@endsection