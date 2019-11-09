@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('backend.settings.partials.submenu')
        </div>
        <div class="col-md-9">
            <h2>Change password</h2>

            <form method="POST" action="{{ route('settings.security.update') }}">
                <input type="hidden" name="_method" value="PUT">
                @csrf

                <div class="form-group">
                    <label class="label-control" for="current_password">Current password</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" id="current_password">

                    @error('current_password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="label-control" for="new_password">New password</label>
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password">

                    @error('new_password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="label-control" for="new_password_confirmation">Confirm new password</label>
                    <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" id="new_password_confirmation">

                    @error('new_password_confirmation')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button class="btn btn-sm btn-primary" type="submit" name="submit">Update password</button>
            </form>
        </div>
    </div>
</div>
@endsection
