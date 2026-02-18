@extends('layouts.app2')

@section('content')
<div class="container mt-4">
    <h4>Available Stations</h4>

    <div class="row">
        @foreach($stations as $index => $station)

            @php
                $previousStation = $stations[$index - 1] ?? null;

                // Determine if station has MCQs
                $hasMcqs = $station->mcqQuestions()->count() > 0;

                // Completed if procedure + MCQ submitted
                $isCompleted = in_array($station->id, $completedStations);

                // Determine if student can access
                $canAccess = false;
                if($hasMcqs){
                    if($previousStation){
                        $prevCompleted = in_array($previousStation->id, $completedStations);
                        $currentProcedureDone = \DB::table('examiner_scores')
                            ->where('student_id', session('osce_student'))
                            ->where('station_id', $station->id)
                            ->exists();
                        $canAccess = $prevCompleted && $currentProcedureDone;
                    } else {
                        // First station
                        $canAccess = true;
                    }
                }
            @endphp

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5>{{ $station->title }}</h5>

                        @if(!$hasMcqs)
                            <span class="badge badge-warning">No MCQs</span>
                        @elseif($isCompleted)
                            <span class="badge badge-success">Completed</span>
                        @elseif(!$canAccess)
                            <span class="badge badge-danger">Locked</span>
                        @else
                            <button class="btn btn-primary mt-2 start-mcq-btn"
                                    data-station-id="{{ $station->id }}">
                                Start MCQ
                            </button>
                        @endif
                    </div>
                </div>
            </div>

        @endforeach
    </div>
</div>

<!-- No MCQ Modal -->
<div class="modal fade" id="noMcqModal" tabindex="-1" role="dialog" aria-labelledby="noMcqModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content text-center">
      <div class="modal-body">
        <h5 class="text-warning">⚠️ No MCQs Yet ⚠️</h5>
        <p>This station does not have any MCQs uploaded yet. Please check back later.</p>
        <button type="button" class="btn btn-primary mt-2" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection

<script src="{{ asset('student/js/jquery-3.6.0.min.js') }}"></script>
<script>
$(document).ready(function(){

    $('.start-mcq-btn').click(function(){
        const stationId = $(this).data('station-id');

        // Redirect to station MCQ page
        window.location.href = "/osce/student/station/" + stationId;
    });

});
</script>
