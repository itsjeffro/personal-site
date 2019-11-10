@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h2>Summary</h2>
            
            <div class="form-group">
               {{ $role->name }}
            </div>

            <form method="POST" action="{{ route('roles.update', ['role' => $role->id]) }}">
                <input type="hidden" name="_method" value="PUT">
                @csrf

                <div class="card mb-3">
                    <div class="card-header">
                        Permissions
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <th></th>
                                <th>Name</th>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td width="5%">
                                            <input id="{{ $permission->id }}" type="checkbox" name="permission[{{ $permission->id }}]">
                                        </td>
                                        <td>
                                            {{ $permission->name }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <button class="btn btn-primary" type="submit" name="update">Update role</button>
            </form>
        </div>
    </div>
</div>
@endsection
