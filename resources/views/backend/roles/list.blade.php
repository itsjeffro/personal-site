@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Roles</div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="20%">Role name</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td width="20%">
                                    <a href="{{ route('roles.show', ['role' => $role->id]) }}" title="View role">{{ $role->name }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{ $roles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
