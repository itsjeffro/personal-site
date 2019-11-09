@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h2>Summary</h2>
            
            <div class="form-group">
               {{ $role->name }}
            </div>

            <div class="card">
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
        </div>
    </div>
</div>
@endsection
