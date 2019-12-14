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
                <h2>Dashboard</h2>
            </div>
        </div>
    </div>
</div>
@endsection