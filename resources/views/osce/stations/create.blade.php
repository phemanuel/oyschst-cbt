@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0 font-weight-bold">Create New Station</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('stations.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Station Name</label>
                    <input type="text" name="title"
                        class="form-control @error('title') is-invalid @enderror"
                        placeholder="e.g. Station 1">

                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Station Title</label>
                    <input type="text" name="practical_question"
                        class="form-control @error('practical_question') is-invalid @enderror"
                        placeholder="e.g.  Vital Signs">

                    @error('practical_question')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror                    
                </div>

                <div class="form-group">
                    <label>MCQ Duration(Mins)</label>
                    <input type="text" name="duration"
                        class="form-control @error('title') is-invalid @enderror"
                        placeholder="e.g. 10">

                    @error('duration')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary">
                    Create Station
                </button>

                <a href="{{ route('stations.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>

@endsection
