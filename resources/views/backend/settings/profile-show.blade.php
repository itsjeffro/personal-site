@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('backend.settings.partials.submenu')
        </div>
        <div class="col-md-9">
            <h2>Public profile</h2>

            <form method="POST">
                <input type="hidden" name="_method" value="PUT">
                @csrf

                <div class="form-group">
                    <label class="label-control" for="name">Name</label>
                    <input type="text" class="form-control" id="name" value="{{ $user->name }}">
                </div>

                <div class="form-group">
                    <label class="label-control" for="email">Email</label>
                    <input type="text" class="form-control" id="email" value="{{ $user->email }}">
                </div>

                <div class="form-group">
                    <label class="label-control" for="role">Role</label>
                    <input type="text" readonly class="form-control-plaintext" id="role" value="{{ $roles }}">
                </div>

                <button class="btn btn-sm btn-primary" type="submit" name="submit">Update profile</button>
            </form>
        </div>
    </div>
</div>
@endsection
