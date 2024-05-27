@extends('layouts.app')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger col-md-8 offset-md-3">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 justify-content-center">
                <a href="{{ route('jobsCreate') }}" class="btn btn-primary btn-lg">create a new job</a>
            </div>
        </div>
        @foreach ($jobs as $job)
            <div class="row justify-content-center mt-4">
                <div class="col-md-8">
                    <div class="card text-center">
                        <div class="card-header">
                            Featured
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $job->name }}</h5>
                            <p class="card-text">{{ $job->salary }}</p>
                            <div class="row">
                                <div class="col"><a href="{{ route('jobsView', $job->id) }}" class="btn btn-primary">View job</a></div>
                                <div class="col"><a href="{{ route('jobsEdit', $job->id) }}" class="btn btn-warning">Edit jobs</a></div>
                                <div class="col">
                                    <form id="jobsDestroy-form" action="{{ route('jobsDestroy', $job->id) }}" method="POST" class="">
                                        @csrf
                                            <button class="btn btn-danger">{{ __('Delete') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            {{ $job->created_at }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
