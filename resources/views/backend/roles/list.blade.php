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
          <tbody>
            @foreach($roles as $role)
            <tr>
              <td width="20%">
                <a href="{{ route('roles.show', ['role' => $role->id]) }}" title="View role">{{ $role->name }}</a>
              </td>
              <td width="40%">
                @if(isset($userCountPerRole[$role->id]))
                  Users: {{ $userCountPerRole[$role->id]->total_users }}
                @else
                  Users: 0
                @endif
              </td>
              <td width="40%">
                Created: {{ $role->created_at }}
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
