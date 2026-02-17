@extends('layouts.app2')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
@endif
<div class="container mt-4">
    <h4>Available Stations</h4>

    <div class="row">
        @foreach($stations as $index => $station)

            @php
                $previousStation = $stations[$index - 1] ?? null;

                $isLocked = false;

                if ($previousStation) {
                    $isLocked = !in_array($previousStation->id, $completedStations);
                }

                $isCompleted = in_array($station->id, $completedStations);
            @endphp

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5>{{ $station->title }}</h5>

                        @if($isCompleted)
                            <span class="badge badge-success">Completed</span>
                        @elseif($isLocked)
                            <span class="badge badge-danger">Locked</span>
                        @else
                            <a href="{{ route('student.station', $station->id) }}"
                               class="btn btn-primary mt-2">
                                Start MCQ
                            </a>
                        @endif
                    </div>
                </div>
            </div>

        @endforeach
    </div>
</div>

@endsection
