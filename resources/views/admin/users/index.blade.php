@extends('admin.layouts.table') 

@section('table')

<table class="table table-hover m-b-0" id="table">

    <thead>
        <th> Profile Picture </th>
        <th> Name </th>
        <th> Email </th>
        <th> Total Subscriptions </th>
        <th> Level </th>
        <th> Phone Number </th>
        <th> Accounts </th>

    </thead>

    <tbody>

        @foreach($users as $user)
            <tr>
                <th> <img src="{{ $user->avatar }}" alt="" width="32"> </th>
                <td> <a href="{{ route('admin.users.show', $user) }}"> {{ $user->name }} </a>  </td>
                <td> {{ $user->email }} </td>
                <td> {{ $user->totalSubscriptions() }} EGP </td>
                <td> {{ $user->level->nameAndSchool }} </td>
                <td> {{ $user->phone }} </td>
                <td>
                    @if ($user->accounts)
                    <div class="row social-widget">
                        @foreach ($user->accounts as $name => $link)
                        <div class="{{ $name }}-widget">
                            <div class="icon mx-2">
                                <a href="{{ $link }}" target="_blank">
                                    <i class="zmdi zmdi-{{ $name }} display-1"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </td>
            @endforeach
            </tr>
    </tbody>
</table>

@endsection
 