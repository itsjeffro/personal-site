@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Users</div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="20%">Name</th>
                                <th width="20%">Email</th>
                                <th width="20%">Roles</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td width="20%">
                                    {{ $user->name }}
                                </td>
                                <td width="20%">
                                    {{ $user->email }}
                                </td>
                                <td width="20%">
                                    {{ $user->getRoleNames()->implode(', ') }}
                                </td>
                                <td>
                                    {{ $user->created_at }}
                                </td>
                                <td>
                                    {{ $user->updated_at }}
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
