@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('jobsUpdate', $jobs->id) }}" method="post">
                @method('patch')
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Job Titile</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $jobs->name }}" name="job">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Salary</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" value="{{ $jobs->salary }}" name="salary">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection