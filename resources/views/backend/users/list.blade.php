@extends('backend.layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="heading">
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Add user</a>
        <h2>Users &amp; Roles</h2>
      </div>
    </div>

    <div class="col-md-3">
        @include('backend.partials.user-role-submenu')
    </div>

    <div class="col-md-9">
      <div class="table-responsive">
        <table class="table table-blocks">
          <tbody>
            @foreach($users as $user)
            <tr>
              <td width="33%">
                  <a href="{{ route('users.show', ['user' => $user->id]) }}" title="View {{ $user->email }}">{{ $user->email }}</a>
              </td>
              <td>
                  Role: {{ $user->getRoleNames()->implode(', ') }}
              </td>
              <td>
                  Created: {{ $user->created_at->format('Y-m-d H:i:s') }}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
      {{ $users->links() }}
  </div>
</div>
@endsection
