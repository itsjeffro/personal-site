@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>{{ $client->name }}</h2>
            <form method="POST" action="{{ route('oauth.update', ['oauth_client' => $client->id]) }}">
                <input type="hidden" name="_method" value="PUT">
                @csrf

                <div class="form-group">
                    @if($client->user)
                        {{ $client->user->name }} owns this application.
                    @else
                         System-created application.
                    @endif
                </div>

                <hr />

                <div class="form-group">
                    <label class="label-control" for="id">Client ID</label>
                    <input type="text" readonly class="form-control-plaintext" id="id" value="{{ $client->id }}">
                </div>
                
                <div class="form-group">
                    <label class="label-control" for="secret">Client secret</label>
                    <input type="text" readonly class="form-control-plaintext" id="secret" value="{{ $client->secret }}">
                </div>

                <hr />

                <div class="form-group">
                    <label class="label-control" for="name">Application name <span class="text-danger">*</span></label>
                    <input class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $client->name }}" type="text">
                    
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="label-control" for="redirect">Authorization callback URL <span class="text-danger">*</span></label>
                    <input class="form-control @error('redirect') is-invalid @enderror" name="redirect" id="redirect" type="text" value="{{ $client->redirect }}" placeholder="http://">

                    @error('redirect')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="label-control">Application Grant Type</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="grant_type" id="passwordGrantType" value="1" checked>
                        <label class="form-check-label" for="passwordGrantType">
                            Password
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="grant_type" id="personalAccessGrantType" value="2">
                        <label class="form-check-label" for="personalAccessGrantType">
                            Personal Token
                        </label>
                    </div>
                </div>

                <button class="btn btn-primary" type="submit" name="submit">Update application</button>
            </form>
        </div>
    </div>
</div>
@endsection
