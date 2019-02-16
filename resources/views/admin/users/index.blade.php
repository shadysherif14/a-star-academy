@extends('admin.layouts.table') 
@section('table')

<table class="table table-hover m-b-0" id="table">

    <thead>
        <th> Profile Picture </th>
        <th> Name </th>
        <th> Username </th>
        <th> Email </th>
        <th> Serial </th>
        <th> Total Subscriptions </th>
        <th> Level </th>
        <th> Phone Number </th>
        <th> Accounts </th>
        <th> Actions </th>

    </thead>

    <tbody>
        @foreach($users as $user)
         <tr class="row-{{ $user->blocked ? 'blocked' : 'unblocked' }}">
            <th> <img src="{{ $user->avatar }}" alt="" width="32"> </th>
            <td> <a href="{{ route('admin.users.show', $user) }}"> {{ $user->name }} </a> </td>
            <td> {{ $user->username }} </td>
            <td> {{ $user->email }} </td>
            <td> {{ $user->serial }} </td>
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
            <td>

                <form action="{{ route('admin.users.destroy', $user) }}" class="delete" method="POST">
                    @csrf @method('DELETE')
                    <button title="Delete User" type="submit" class="btn l-coral btn-icon btn-icon-mini btn-round" href="">
                            <i class="fas fa-trash"></i>
                        </button>
                </form>

                <form class="{{ $user->blocked ? 'unblock' : 'block' }}" action="{{ route('admin.users.toggle-block', $user) }}" method="POST">
                    @csrf @method('PUT')
                    <button title="{{ $user->blocked ? 'Unblock' : 'Block' }} User" type="submit" class="btn l-parpl btn-icon btn-icon-mini btn-round">
                            <i class="fas fa-user-alt{{ $user->blocked ? '' : '-slash' }}"></i>
                        </button>
                </form>
            </td>
            @endforeach
        </tr>
    </tbody>
</table>
@endsection
 @push('scripts')
<script src="{{ asset_path('js/admin/users/index.js') }}"></script>





@endpush