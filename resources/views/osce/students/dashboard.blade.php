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
    @foreach($stations as $station)

        @php
            $status = $stationStatus[$station->id] ?? 'available';
            $hasMcqs = $station->mcqQuestions()->count() > 0;
        @endphp

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5>{{ $station->title }}</h5>

                    @if(!$hasMcqs)
                        <span class="badge bg-warning text-dark">No MCQs</span>

                    @elseif($status === 'completed')
                        <span class="badge bg-success">Completed</span>

                    @else
                        <button type="button"
                                class="btn btn-primary mt-2 start-mcq-btn"
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
