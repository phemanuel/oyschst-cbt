@extends('layouts.app')

@section('title', 'OSCE Dashboard')

@section('content')

<div class="container-fluid">

    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="font-weight-bold">OSCE Admin Dashboard</h4>
        <span class="badge badge-success p-2">
            {{ now()->format('l, d M Y') }}
        </span>
    </div>

    <!-- Statistics Cards -->
    <div class="row">

        <!-- Stations -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="text-muted">Total Stations</h5>
                    <h2 class="font-weight-bold text-primary">
                        {{$stations->count()}}
                    </h2>
                </div>
            </div>
        </div>

        <!-- Students -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="text-muted">Total Students</h5>
                    <h2 class="font-weight-bold text-success">
                        {{$students->count()}}
                    </h2>
                </div>
            </div>
        </div>

        <!-- Examiners -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="text-muted">Total Examiners</h5>
                    <h2 class="font-weight-bold text-danger">
                        {{$users->count()}}
                    </h2>
                </div>
            </div>
        </div>

    </div>

    <!-- Quick Actions -->
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-white font-weight-bold">
            Quick Actions
        </div>
        <div class="card-body">
            <a href="{{route('stations.create')}}" class="btn btn-primary mr-2 mb-2">
                Create Station
            </a>
            <a href="{{route('mcqs.index')}}" class="btn btn-success mr-2 mb-2">
                Upload MCQ Questions
            </a>
            <a href="{{route('students.index')}}" class="btn btn-warning mr-2 mb-2">
                Manage Students
            </a>
            <a href="#" class="btn btn-danger mb-2">
                View Results
            </a>
        </div>
    </div>

</div>

@endsection
