@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('backend.settings.partials.submenu')
        </div>
        <div class="col-md-9">
            <h2>Delete account</h2>
        </div>
    </div>
</div>
@endsection
