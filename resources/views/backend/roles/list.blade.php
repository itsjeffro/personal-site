@extends('backend.layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-3">
      @include('backend.partials.user-role-submenu')
    </div>

    <div class="col-md-9">
      <div class="heading">
        <a href="" class="btn btn-primary btn-sm float-right">Create role</a>
        <h2>Roles</h2>
      </div>

      <div class="table-responsive">
        <table class="table table-blocks">
        <thead>
            <tr>
              <th>Role</th>
              <th>User count</th>
              <th>Created at</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($roles as $role)
            <tr>
              <td>
                <a href="{{ route('roles.show', ['role' => $role->id]) }}" title="View role">{{ $role->name }}</a>
              </td>
              <td>
                @if(isset($userCountPerRole[$role->id]))
                  {{ $userCountPerRole[$role->id]->total_users }}
                @else
                 0
                @endif
              </td>
              <td>
                {{ $role->created_at->format('d, F Y - h:i A') }}
              </td>
              <td class="text-right">
                <a href="{{ route('roles.show', ['role' => $role->id]) }}" title="View role">View</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
      {{ $roles->links() }}
  </div>
</div>
@endsection
