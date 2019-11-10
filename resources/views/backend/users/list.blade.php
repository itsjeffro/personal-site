@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('backend.partials.user-role-submenu')
        </div>

        <div class="col-md-9">
            <div class="form-group">
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">Add user</a>
            </div>

            <div class="card">
                <div class="card-header">Users</div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="33%">Email</th>
                                <th>Roles</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td width="33%">
                                    <a href="{{ route('users.show', ['user' => $user->id]) }}" title="View {{ $user->email }}">{{ $user->email }}</a>
                                </td>
                                <td>
                                    {{ $user->getRoleNames()->implode(', ') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
