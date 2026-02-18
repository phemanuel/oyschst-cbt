@extends('layouts.app3')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">OSCE Results</h3>
    <div class="row">
        @foreach($stations as $station)
        <div class="col-md-4 mb-3">
            <div class="card shadow station-card p-3" data-station-id="{{ $station->id }}" style="cursor:pointer;">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $station->title }}</h5>
                    <p class="card-text">{{ $station->practical_question }}</p>
                    <i class="fas fa-clipboard-list fa-2x text-primary"></i>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Students Modal -->
<div class="modal fade" id="stationStudentsModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Students who submitted</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover" id="stationStudentsTable">
            <thead class="thead-light">
                <tr>
                    <th>Student No</th>
                    <th>Name</th>
                    <th>Examiner Score</th>
                    <th>MCQ Score</th>
                    <th>Total Score</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<!-- Student Preview Modal -->
<div class="modal fade" id="studentPreviewModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Student Result Preview</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="studentPreviewContent"></div>
    </div>
  </div>
</div>
@endsection


<script src="{{ asset('student/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('student/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script>
$(document).ready(function(){

    // ---------------- Click Station Card ----------------
    $('.station-card').click(function(){
        const stationId = $(this).data('station-id');

        // Destroy previous DataTable if exists
        if ($.fn.DataTable.isDataTable('#stationStudentsTable')) {
            $('#stationStudentsTable').DataTable().destroy();
        }

        // Clear previous rows
        $('#stationStudentsTable tbody').empty();

        // Fetch students for this station
        $.get(`/osce/results/station/${stationId}`, function(data){

            if(data.length === 0){
                // Add empty row with 6 td
                $('#stationStudentsTable tbody').append(
                    `<tr>
                        <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
                    </tr>`
                );
            } else {
                data.forEach(res => {
                    const fullName = `${res.student.surname} ${res.student.first_name} ${res.student.other_name}`;
                    $('#stationStudentsTable tbody').append(`
                        <tr>
                            <td>${res.student.admission_no}</td>
                            <td>${fullName}</td>
                            <td>${res.examiner_score ?? 0}</td>
                            <td>${res.mcq_score ?? 0}</td>
                            <td>${res.total_score ?? 0}</td>
                            <td>
                                <button class="btn btn-sm btn-info preview-student-btn" 
                                        data-student-id="${res.student.id}" 
                                        data-station-id="${stationId}">
                                    Preview <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    `);
                });
            }

            // Initialize DataTable
            $('#stationStudentsTable').DataTable({
                paging: true,
                searching: true,
                info: false,
                lengthChange: false,
                pageLength: 10
            });

            // Show modal
            $('#stationStudentsModal').modal('show');
        })
        .fail(function(err){
            console.error('Error fetching students', err);
            alert('Failed to fetch students for this station.');
        });
    });

    // ---------------- Preview Student Result ----------------
    $(document).on('click', '.preview-student-btn', function(){
        const studentId = $(this).data('student-id');
        const stationId = $(this).data('station-id');

        // Fetch preview
        $.get(`/osce/results/student/${studentId}/${stationId}`, function(data){
            let html = `<h5>${data.student.surname} ${data.student.first_name} ${data.student.other_name} - ${data.student.admission_no}</h5>`;

            // Procedure Scores
            html += '<h6 class="mt-3">Procedure Scores</h6>';
            html += '<table class="table table-bordered"><thead><tr><th>Procedure</th><th>Score</th></tr></thead><tbody>';
            data.procedures.forEach((p, idx) => {
                const name = p.procedure?.name ?? `Procedure ${idx+1}`;
                html += `<tr><td>${name}</td><td>${p.score}</td></tr>`;
            });
            html += '</tbody></table>';

            // MCQ Scores
            html += '<h6 class="mt-3">MCQ Scores</h6>';
            data.mcqs.forEach((mcq, idx) => {
                html += `<p><strong>Q${idx+1}: ${mcq.question}</strong></p><ul>`;
                mcq.options.forEach(opt => {
                    const selected = data.studentAnswers[mcq.id] == opt.id ? '✔️ Selected' : '';
                    const correct = opt.is_correct ? '✅ Correct' : '';
                    html += `<li>${opt.option_text} (${opt.mark} pts) ${selected} ${correct}</li>`;
                });
                html += '</ul>';
            });

            $('#studentPreviewContent').html(html);
            $('#studentPreviewModal').modal('show');
        })
        .fail(function(err){
            console.error('Error fetching preview', err);
            alert('Failed to fetch student preview.');
        });
    });

});

</script>

