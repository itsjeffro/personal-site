@extends('layouts.app')

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

            <div class="form-group">
                <a href="{{ route('oauth.create') }}" class="btn btn-primary btn-sm">New OAuth App</a>
            </div>

            <div class="card">
                <div class="card-header">OAuth</div>

                @if($clients->count() === 0)
                <div class="card-body text-center">
                    <a href="{{ route('oauth.create') }}" class="btn btn-link">Get started by adding a client</a>
                </div>
                @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="30%">Name</th>
                                <th width="20%">Client ID</th>
                                <th>Type</th>
                                <th></th>
                            </tr>
                            </tr>
                        </thead>

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
                @endif
            </div>
        </div>
    </div>
</div>
@endsection