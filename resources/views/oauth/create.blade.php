@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Register a new OAuth application</h2>
            <form method="POST" action="{{ route('oauth.store') }}">
                @csrf

                <div class="form-group">
                    <label class="label-control" for="name">Application name <span class="text-danger">*</span></label>
                    <input class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" type="text">
                    
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="label-control">Authorization callback URL <span class="text-danger">*</span></label>
                    <input class="form-control @error('redirect') is-invalid @enderror" name="redirect" type="text" value="{{ old('redirect') }}" placeholder="http://">

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
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="grant_type" id="clientCredentialsGrantType" value="3">
                        <label class="form-check-label" for="clientCredentialsGrantType">
                            Client Credentials
                        </label>
                    </div>
                </div>

                <button class="btn btn-sm btn-primary" type="submit" name="submit">Register application</button>
            </form>
        </div>
    </div>
</div>
@endsection
