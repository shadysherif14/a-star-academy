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
                    <th> Course </th>
                    <th> Video </th>
                    <th> User </th>
                    <th> Type </th>
                    <th> Price </th>
                    <th> Date </th>
                </tr>
            </thead>
            <tbody>
                @if(count($subscriptions))
                @foreach($subscriptions as $sub)
                <tr role="row">
                    <td> {{ $sub->video->course->name }} </td>
                    <td> {{ $sub->video->title }} </td>
                    <td> {{ $sub->user->name }} </td>
                    <td> {{ $sub->type }} </td>
                    <td> {{ $sub->price }} </td>
                    <td> {{  $sub->created_at }} </td>
                </tr>
                @endforeach 
                @else
                <tr class="text-center">
                    <td colspan="6"> No Subscriptions Yet</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>
@endsection