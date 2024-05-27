@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $jobs->name }}</h5>
                    <p class="card-text">{{ $jobs->salary }}</p>
                    <a href="{{ route('jobs') }}" class="btn btn-primary">back to jobs</a>
                    <a href="{{ route('jobsEdit', $jobs->id) }}" class="btn btn-primary">Edit jobs</a>
                </div>
                <div class="card-footer text-muted">
                    2 days ago
                </div>
            </div>
        </div>
    </div>
</div>
@endsection