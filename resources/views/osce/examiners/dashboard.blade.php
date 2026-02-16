@extends('layouts.app1')
@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="font-weight-bold">OSCE Examiner Dashboard</h4>
        <span class="badge badge-success p-2">
            {{ now()->format('l, d M Y') }}
        </span>
    </div>

    <div class="row">
        @foreach($stations as $station)
        <div class="col-md-4 mb-4">
            <div class="card station-card shadow-sm cursor-pointer" 
                 data-station-id="{{ $station->id }}" 
                 data-station-title="{{ $station->title }}">
                <div class="card-body text-center">
                    <h5 class="card-title font-weight-bold">{{ $station->title }}</h5>
                    <p class="card-text">{{ Str::limit($station->practical_question, 80) }}</p>
                    <div class="d-flex justify-content-around mt-3">
                        <span class="badge badge-primary">Procedures: {{ $station->procedures->count() }}</span>
                        <span class="badge badge-success">MCQs: {{ $station->mcqQuestions->count() }}</span>
                        <span class="badge badge-info">Total Marks: {{ $station->procedures->sum('marks') + $station->mcqQuestions->sum('mark') }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Students Modal --}}
<!-- Students Modal -->
<div class="modal fade" id="studentsModal" tabindex="-1" role="dialog" aria-labelledby="studentsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document"> <!-- modal-lg makes it bigger -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalStationTitle">Station Name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="studentSearch" class="form-control mb-3" placeholder="Search by Admission No, First or Last Name">

        <div class="table-responsive">
          <table class="table table-hover" id="studentsTable">
            <thead class="thead-light">
              <tr>
                <th>#</th>
                <th>Picture</th>
                <th>Admission No</th>
                <th>First Name</th>
                <th>Surname</th>
                <th>Department</th>
                <th>Action</th> <!-- Start Procedure button -->
              </tr>
            </thead>
            <tbody>
              <!-- Populated via JS -->
            </tbody>
          </table>
        </div>
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

    $(document).on('click', '.station-card', function() {
        let stationId = $(this).data('station-id');
        let stationTitle = $(this).data('station-title');

        $('#modalStationTitle').text(stationTitle);

        // Fetch all students
        $.get('/osce/examiner/station/' + stationId + '/students', function(res) {
            let tbody = $('#studentsTable tbody');
            tbody.empty();

            res.students.forEach((stu, i) => {
                let picture = stu.picture_name 
                ? `<img src="/uploads/${stu.picture_name}.jpg" class="rounded-circle" width="40">` 
                : `<img src="/uploads/blank.jpg" class="rounded-circle" width="40">`;

                tbody.append(`
                    <tr class="student-row" data-student-id="${stu.id}" data-station-id="${stationId}">
                        <td>${i+1}</td>
                        <td>${picture}</td>
                        <td class="stu-adm">${stu.admission_no}</td>
                        <td class="stu-first">${stu.first_name}</td>
                        <td class="stu-last">${stu.surname}</td>
                        <td>${stu.department}</td>
                        <td>
                            <button class="btn btn-success btn-sm start-procedure-btn" 
                                data-student-id="${stu.id}" 
                                data-station-id="${stationId}">
                                Start Procedure
                            </button>
                        </td>
                    </tr>
                `);
            });

            $('#studentsModal').modal('show');

            // Search by admission, first name, last name
            $('#studentSearch').off('keyup').on('keyup', function() {
                let val = $(this).val().toLowerCase();
                $('#studentsTable tbody tr').filter(function() {
                    let adm = $(this).find('.stu-adm').text().toLowerCase();
                    let first = $(this).find('.stu-first').text().toLowerCase();
                    let last = $(this).find('.stu-last').text().toLowerCase();
                    $(this).toggle(adm.includes(val) || first.includes(val) || last.includes(val));
                });
            });
        });
    });

    // Start Procedure button click
    $(document).on('click', '.start-procedure-btn', function() {
        let studentId = $(this).data('student-id');
        let stationId = $(this).data('station-id');

        // You can open another modal here with the procedures
        console.log('Start Procedure:', { studentId, stationId });

        // Example: redirect to procedure page
        // window.location.href = `/osce/examiner/station/${stationId}/student/${studentId}/procedures`;
    });

});

</script>