@extends('layouts.app1')
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

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="font-weight-bold">OSCE Examiner Dashboard</h4>
        <span class="badge badge-success p-2">
            {{ now()->format('l, d M Y') }}
        </span>
    </div>

    <div class="row">
    @foreach($stations as $station)

        @if($station->id == auth()->user()->station_id)

            <div class="col-md-4 mb-4">
                <div class="card station-card shadow-sm cursor-pointer" 
                    data-station-id="{{ $station->id }}" 
                    data-station-title="{{ $station->title }}" 
                    data-practical-question="{{ $station->practical_question }}">

                    <div class="card-body text-center">

                        <h5 class="card-title font-weight-bold">
                            {{ $station->title }}
                        </h5>

                        <p class="card-text">
                            {{ Str::limit($station->practical_question, 80) }}
                        </p>

                        <div class="d-flex flex-wrap justify-content-around mt-3 mb-2 gap-2">
                            <span class="badge badge-primary">
                                Procedures: {{ $station->procedures->count() }}
                            </span>                           

                            <span class="badge badge-info">
                                Total Procedure Marks: {{ $station->procedures->sum('marks') }}
                            </span>

                            <span class="badge badge-success">
                                MCQs: {{ $station->mcqQuestions->count() }}
                            </span>

                            <span class="badge badge-info">
                                Total MCQ Marks: {{ $station->mcqQuestions->sum('mark') }}
                            </span>
                        </div>

                        <!-- Graded students list -->
                        <div class="graded-students mt-3">
                            <h6 class="text-dark font-weight-bold border-bottom pb-1">
                                Graded Students
                            </h6>

                            @php
                                $gradedStudents = $station->stationResults()->with('student')->get();
                            @endphp

                            @if($gradedStudents->isEmpty())
                                <p class="text-muted">
                                    <em>No student graded yet</em>
                                </p>
                            @else
                                <div style="max-height: 250px; overflow-y: auto;">
                                    <table class="table table-sm table-hover mb-0">
                                        <thead class="thead-light sticky-top bg-white" style="z-index: 10;">
                                            <tr>
                                                <th>#</th>
                                                <th>Student</th>
                                                <th>MCQ Score</th>
                                                <th>Procedure Score</th>
                                                <th>Total Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($gradedStudents as $index => $result)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        {{ $result->student->first_name ?? '' }}
                                                        {{ $result->student->surname ?? '' }}
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info">
                                                            {{ $result->mcq_score ?? 0 }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-warning">
                                                            {{ $result->examiner_score ?? 0 }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-success">
                                                            {{ $result->total_score ?? 0 }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

        @endif

    @endforeach
</div>



</div>

{{-- Students Modal --}}
<!-- Students Modal -->
<div class="modal fade" id="studentsModal" tabindex="-1" role="dialog" aria-labelledby="studentsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable custom-modal-width" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalStationTitle">Station Students</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="studentSearch" class="form-control mb-3" placeholder="Search by admission, first name, surname or department">

        <div class="table-responsive">
          <table class="table table-hover" id="studentsTable">
            <thead class="thead-light">
              <tr>
                <th>#</th>
                <th>Picture</th>
                <th>Admission No</th>
                <th>Student Name</th>
                <!-- <th>Surname</th> -->
                <th>Department</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- Populated dynamically -->
            </tbody>
          </table>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


{{-- Procedures Modal --}}
<div class="modal fade" id="proceduresModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Procedures for <span id="modalStudentName"></span></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <ul id="proceduresList" class="list-group"></ul>
      </div>
    </div>
  </div>
</div>
@push('styles')
<style>
.station-card {
    transition: transform 0.2s, box-shadow 0.2s;
}
.station-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    background: #f8f9fa;
    cursor: pointer;
}
.student-row:hover {
    background-color: #f1f1f1;
    cursor: pointer;
}
</style>
@endpush
@endsection
<script src="{{ asset('student/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('student/js/bootstrap.bundle.min.js') }}"></script>
<script>
$(document).ready(function() {

    // Click on station card
    $(document).on('click', '.station-card', function() {

        let stationId = $(this).data('station-id');
        let stationTitle = $(this).data('station-title');
        let practicalQuestion = $(this).data('practical-question');

        // Combine both into a single display
        let displayText = stationTitle;
        if (practicalQuestion && practicalQuestion.trim() !== '') {
            displayText += ' – ' + practicalQuestion;
        }

        // Set combined text in modal
        $('#modalStationTitle').text(displayText);

        // Store stationId in modal (important for search)
        $('#studentsModal').data('station-id', stationId);

        // Fetch students (initial load)
        fetchStudents(stationId);

        // Show modal
        $('#studentsModal').modal('show');
    });


    // Search students in modal
    $(document).on('input', '#studentSearch', function() {

        let stationId = $('#studentsModal').data('station-id'); // get saved id
        let q = $(this).val();

        fetchStudents(stationId, q);
    });


    // =========================
    // FETCH STUDENTS FUNCTION
    // =========================
    function fetchStudents(stationId, search = '') {

        $.get(`/osce/examiner/station/${stationId}/students`, { q: search }, function(res) {

            let tbody = $('#studentsTable tbody');
            tbody.empty();

            res.students.forEach((stu, i) => {

                let picture = stu.picture_name 
                    ? `<img src="/uploads/${stu.picture_name}.jpg" class="rounded-circle" width="40">`
                    : `<img src="/uploads/blank.jpg" class="rounded-circle" width="40">`;

                let fullName = [stu.first_name, stu.surname, stu.other_name]
                    .filter(Boolean)
                    .join(' ');

                let btnClass = stu.hasResult ? 'btn-warning' : 'btn-success';
                let btnText  = stu.hasResult ? 'Review' : 'Start Procedure';

                // ✅ USE stationId passed into function
                tbody.append(`
                    <tr class="student-row" data-student-id="${stu.id}" data-station-id="${stationId}">
                        <td>${i+1}</td>
                        <td>${picture}</td>
                        <td>${stu.admission_no}</td>
                        <td>${fullName}</td>
                        <td>${stu.department}</td>
                        <td>
                            <a href="/osce/examiner/station/${stationId}/students/${stu.id}"                   
                               class="btn ${btnClass} btn-sm">
                                ${btnText}
                            </a>
                        </td>
                    </tr>
                `);

            });

        });

    }

});
</script>
