@extends('layouts.app')

@section('title', 'OSCE Dashboard')

@section('content')
  <!-- Statistics Cards -->
    <style>
    .dashboard-card {
        border-radius: 15px;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px auto;
        font-size: 24px;
        color: #fff;
    }

    .station-bg {
        background: linear-gradient(135deg, #4e73df, #224abe);
    }

    .student-bg {
        background: linear-gradient(135deg, #1cc88a, #13855c);
    }

    .examiner-bg {
        background: linear-gradient(135deg, #e74a3b, #b02a20);
    }

    .dashboard-title {
        font-size: 14px;
        letter-spacing: 1px;
        text-transform: uppercase;
        font-weight: 600;
        color: #6c757d;
    }

    .dashboard-number {
        font-size: 38px;
        font-weight: 700;
        margin-top: 10px;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="container-fluid">

    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="font-weight-bold">OSCE Admin Dashboard</h4>
        <span class="badge badge-success p-2">
            {{ now()->format('l, d M Y') }}
        </span>
    </div>

  

    <div class="row">

        <!-- Stations -->
        <div class="col-md-4 mb-4">
            <div class="card dashboard-card shadow-sm border-0">
                <div class="card-body text-center">
                    
                    <div class="card-icon station-bg">
                        <i class="fas fa-hospital-symbol"></i>
                    </div>

                    <div class="dashboard-title">Total Stations</div>

                    <div class="dashboard-number text-primary">
                        {{$stations->count()}}
                    </div>

                </div>
            </div>
        </div>

        <!-- Students -->
        <div class="col-md-4 mb-4">
            <div class="card dashboard-card shadow-sm border-0">
                <div class="card-body text-center">

                    <div class="card-icon student-bg">
                        <i class="fas fa-user-graduate"></i>
                    </div>

                    <div class="dashboard-title">Total Students</div>

                    <div class="dashboard-number text-success">
                        {{$students->count()}}
                    </div>

                </div>
            </div>
        </div>

        <!-- Examiners -->
        <div class="col-md-4 mb-4">
            <div class="card dashboard-card shadow-sm border-0">
                <div class="card-body text-center">

                    <div class="card-icon examiner-bg">
                        <i class="fas fa-user-tie"></i>
                    </div>

                    <div class="dashboard-title">Total Examiners</div>

                    <div class="dashboard-number text-danger">
                        {{$users->count()}}
                    </div>

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
                <i class="fas fa-plus-circle"></i> Create Station
            </a>

            <a href="{{route('mcqs.index')}}" class="btn btn-success mr-2 mb-2">
                <i class="fas fa-question-circle"></i> Upload MCQ Questions
            </a>

            <a href="{{route('students.index')}}" class="btn btn-warning mr-2 mb-2">
                <i class="fas fa-user-graduate"></i> Manage Students
            </a>

            <a href="{{route('examiners.index')}}" class="btn btn-info mr-2 mb-2">
                <i class="fas fa-user-tie"></i> Manage Examiners
            </a>

            <a href="{{route('procedures.index')}}" class="btn btn-secondary mr-2 mb-2">
                <i class="fas fa-file-medical"></i> Upload Procedure
            </a>

            <a href="{{route('osce.results')}}" class="btn btn-danger mb-2">
                <i class="fas fa-chart-bar"></i> View Results
            </a>

        </div>
    </div>


</div>

@endsection
