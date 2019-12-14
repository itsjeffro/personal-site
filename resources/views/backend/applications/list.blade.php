@extends('backend.layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @if (session('status'))
      <div classs="form-group">
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      </div>
      @endif

      <div class="heading">
        <a href="{{ route('oauth.create') }}" class="btn btn-primary btn-sm float-right">New Application</a>
        <h2>Applications</h2>
      </div>

      <div class="table-responsive">
        <table class="table table-blocks">
          <tbody>
            @foreach($clients as $client)
            <tr>
              <td width="30%">
                <a href="{{ route('oauth.show', ['oauth_client' => $client->id]) }}">{{$client->name}}</a>
              </td>
              <td width="20%">{{$client->id}}</td>
              <td>{{$client->grant_type_name}}</td>
              <td class="text-right">
                <a href="{{ route('oauth.show', ['oauth_client' => $client->id]) }}" title="View">View</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection