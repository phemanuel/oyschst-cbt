@extends('layouts.app3')

@section('content')
<style>
@media print {
    button {
        display: none !important;
    }
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="container mt-4">

    <h3 class="mb-4">OSCE Results</h3>

    {{-- ============================= --}}
    {{-- INDIVIDUAL STATION RESULTS --}}
    {{-- ============================= --}}
    <h5 class="mb-3 text-primary">Individual Station Results</h5>

    <div class="row mb-4">
        @foreach($stations as $station)
        <div class="col-md-4 mb-3">
            <div class="card shadow station-card p-3"
                 data-station-id="{{ $station->id }}"
                 data-station-title="{{ $station->title }}"
                 data-practical-question="{{ $station->practical_question }}"
                 style="cursor:pointer;">

                <div class="card-body text-center">
                    <h5 class="card-title">{{ $station->title }}</h5>
                    <p class="card-text">{{ $station->practical_question }}</p>
                    <i class="fas fa-clipboard-list fa-2x text-primary"></i>
                </div>

            </div>
        </div>
        @endforeach
    </div>

    {{-- ============================= --}}
    {{-- SUMMARY SECTION --}}
    {{-- ============================= --}}
    <h5 class="mb-3 text-success">Overall Summary</h5>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card shadow summary-card p-3 bg-dark text-white"
                 style="cursor:pointer;">

                <div class="card-body text-center">
                    <h5 class="card-title">Summary Report</h5>
                    <p class="card-text">View overall student performance</p>
                    <i class="fas fa-chart-bar fa-2x"></i>
                </div>

            </div>
        </div>
    </div>

</div>


<!-- Students Modal -->
<div class="modal fade" id="stationStudentsModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Student Results</h5>
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



    let currentStation = {}; // store selected station info

    // =========================
    // CLICK STATION CARD
    // =========================
    $('.station-card').on('click', function(){

        const stationId = $(this).data('station-id');

        currentStation = {
            id: stationId,
            title: $(this).data('station-title') ?? 'N/A',
            practicalQuestion: $(this).data('practical-question') ?? 'N/A'
        };

        // Destroy previous DataTable safely
        if ($.fn.DataTable.isDataTable('#stationStudentsTable')) {
            $('#stationStudentsTable').DataTable().clear().destroy();
        }

        $('#stationStudentsTable tbody').empty();

        $.get(`/osce/results/station/${stationId}`, function(data){

            if(data.length === 0){
                $('#stationStudentsTable tbody').append(`
                    <tr>
                        <td colspan="6" class="text-center">No students found</td>
                    </tr>
                `);
            } else {
                data.forEach(res => {

                    const fullName = `${res.student.surname ?? ''} ${res.student.first_name ?? ''} ${res.student.other_name ?? ''}`;

                    $('#stationStudentsTable tbody').append(`
                        <tr>
                            <td>${res.student.admission_no ?? '-'}</td>
                            <td>${fullName}</td>
                            <td>${res.examiner_score ?? 0}</td>
                            <td>${res.mcq_score ?? 0}</td>
                            <td>${res.total_score ?? 0}</td>
                            <td>
                                <button class="btn btn-sm btn-info preview-student-btn" 
                                    data-student-id="${res.student.id}"
                                    data-station-id="${currentStation.id}"
                                    data-station-title="${currentStation.title}"
                                    data-practical-question="${currentStation.practicalQuestion}"
                                    data-procedure-total="${res.examiner_score ?? 0}"
                                    data-mcq-total="${res.mcq_score ?? 0}"
                                    data-overall-total="${res.total_score ?? 0}">
                                    Preview <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    `);
                });
            }

            if ($.fn.DataTable.isDataTable('#stationStudentsTable')) {
                $('#stationStudentsTable').DataTable().destroy();
            }

            $('#stationStudentsTable').DataTable({
                paging: true,
                searching: true,
                info: false,
                lengthChange: false,
                pageLength: 10,
                destroy: true
            });

            $('#stationStudentsModal').modal('show');

        }).fail(function(err){
            console.error('Error fetching students', err);
            alert('Failed to fetch students for this station.');
        });

    });

    // =========================
    // PREVIEW STUDENT RESULT
    // =========================
    $(document).on('click', '.preview-student-btn', function(){

        const studentId = $(this).data('student-id');
        const stationId = $(this).data('station-id');
        const stationTitle = $(this).data('station-title') ?? 'N/A';
        const practicalQuestion = $(this).data('practical-question') ?? 'N/A';
        const procedureTotal = $(this).data('procedure-total') ?? 0;
        const mcqTotal = $(this).data('mcq-total') ?? 0;
        const overallTotal = $(this).data('overall-total') ?? 0;

        $.get(`/osce/results/student/${studentId}/${stationId}`, function(data){

            // -----------------------------
            // BUILD HTML
            // -----------------------------
            let html = `
                <div id="printableArea">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">
                            ${data.student.surname ?? ''} ${data.student.first_name ?? ''} ${data.student.other_name ?? ''} - ${data.student.admission_no ?? ''}
                        </h5>

                        <button class="btn btn-sm btn-dark" onclick="printStudentResult()">
                            <i class="fas fa-print"></i> Print
                        </button>
                    </div>

                    <!-- Station Info + Totals -->
                    <div class="mb-3 p-3 border rounded bg-light">
                        <div class="row">

                            <!-- LEFT SIDE: Station Info -->
                            <div class="col-md-8">
                                <h6 class="text-primary mb-1">
                                    <i class="fas fa-clinic-medical"></i> Station Title
                                </h6>
                                <p class="font-weight-bold mb-3">${stationTitle}</p>

                                <h6 class="text-secondary mb-1">
                                    <i class="fas fa-notes-medical"></i> Practical Question
                                </h6>
                                <p>${practicalQuestion}</p>
                            </div>

                            <!-- RIGHT SIDE: Totals -->
                            <div class="col-md-4 text-right border-left">
                                <h6>Procedure Total</h6>
                                <h4 class="text-primary font-weight-bold">${procedureTotal}</h4>

                                <h6 class="mt-3">MCQ Total</h6>
                                <h4 class="text-success font-weight-bold">${mcqTotal}</h4>

                                <hr>

                                <h6>Overall Total</h6>
                                <h3 class="text-danger font-weight-bold">${overallTotal}</h3>
                            </div>

                        </div>
                    </div>
            `;

            // -----------------------------
            // PROCEDURE TABLE
            // -----------------------------
            html += `
                <h6 class="mt-3">Procedure Scores</h6>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Procedure</th>
                            <th>Mark Obtainable</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            if(data.procedures){
                data.procedures.forEach((p, idx) => {
                    const name = p.procedure?.name ?? `Procedure ${idx+1}`;
                    html += `<tr><td>${name}</td><td>${p.procedure?.marks ?? 0}</td><td>${p.score ?? 0}</td></tr>`;
                });
            }

            html += `</tbody></table>`;

            // -----------------------------
            // MCQ DISPLAY: question + mark, then options with selected/correct
            // -----------------------------
            html += `<h6 class="mt-3">MCQ Questions</h6>`;

            if(data.mcqs){
                data.mcqs.forEach((mcq, idx) => {
                    html += `
                        <div class="mb-2">
                            <p><strong>Q${idx+1}: ${mcq.question}</strong> - <span class="text-info">Mark Obtainable: ${mcq.mark ?? 0}</span></p>
                            <ul>
                    `;
                    mcq.options.forEach(opt => {
                        const selected = data.studentAnswers?.[mcq.id] == opt.id 
                            ? '<span class="text-primary">✔ Selected</span>' 
                            : '';
                        const correct = Number(opt.is_correct) === 1
                        ? '<span class="text-success">✔ Correct</span>'
                        : '';
                        html += `<li>${opt.option_text} ${selected} ${correct}</li>`;
                    });
                    html += `</ul></div>`;
                });
            }

            html += `</div>`; // close printableArea

            $('#studentPreviewContent').html(html);
            $('#studentPreviewModal').modal('show');

        }).fail(function(err){
            console.error('Error fetching preview', err);
            alert('Failed to fetch student preview.');
        });

    });

});

// =========================
// PRINT FUNCTION
// =========================
function printStudentResult(){
    const content = document.getElementById('printableArea').innerHTML;
    const printWindow = window.open('', '', 'width=900,height=700');

    printWindow.document.write(`
        <html>
        <head>
            <title>Student Result</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body>${content}</body>
        </html>
    `);

    printWindow.document.close();
    printWindow.print();
}
</script>

<script>
$(document).ready(function(){

    $(document).on('click', '.summary-card', function(){

        console.log('Summary clicked');

        if ($.fn.DataTable.isDataTable('#stationStudentsTable')) {
            $('#stationStudentsTable').DataTable().clear().destroy();
        }

        $('#stationStudentsTable thead tr').empty();
        $('#stationStudentsTable tbody').empty();

        $.get(`/osce/results/summary`, function(data){

            // ----------------------------
            // BUILD TABLE HEADER
            // ----------------------------
            let headerRow = `<th>Student</th>`;

            // Add one column per station
            data.stations.forEach(st => {
                headerRow += `<th>${st.title}</th>`;
            });

            // Add overall + action ONCE
            headerRow += `<th>Overall</th><th>Action</th>`;

            $('#stationStudentsTable thead tr').append(headerRow);

            // ----------------------------
            // BUILD TABLE BODY
            // ----------------------------
            data.students.forEach(res => {

                let row = `
                    <tr>
                        <td>
                            ${res.student.surname ?? ''} 
                            ${res.student.first_name ?? ''}<br>
                            <small>${res.student.admission_no ?? ''}</small>
                        </td>
                `;

                res.stations.forEach(st => {

                    if(st.completed){
                        row += `
                            <td>
                                <small>
                                    Proc: ${st.examiner_score}<br>
                                    MCQ: ${st.mcq_score}<br>
                                    <strong>Total: ${st.total_score}</strong>
                                </small>
                            </td>
                        `;
                    } else {
                        row += `
                            <td class="text-danger">
                                <small>Not Completed</small>
                            </td>
                        `;
                    }

                });

                row += `
                    <td>
                        <strong class="text-primary">
                            ${res.overall_total}
                        </strong>
                    </td>
                    <td>
                        ${
                            res.overall_total > 0
                            ? `<button class="btn btn-sm btn-dark preview-full-btn"
                                data-student-id="${res.student.id}">
                                Preview
                            </button>`
                            : `<span class="text-muted">—</span>`
                        }
                    </td>
                </tr>
                `;

                $('#stationStudentsTable tbody').append(row);
            });

            $('#stationStudentsTable').DataTable({
                paging: true,
                searching: true,
                info: false,
                lengthChange: false,
                pageLength: 10,
                scrollX: true
            });

            $('#stationStudentsModal').modal('show');

        }).fail(function(){
            alert('Failed to load summary.');
        });

    });

});
</script>
<script>
$(document).on('click', '.preview-full-btn', function(){

    const studentId = $(this).data('student-id');

    $.get(`/osce/results/student-full/${studentId}`, function(data){

        let overallProcedure = 0;
        let overallMcq = 0;

        let stationSummaries = [];

        // ===============================
        // FIRST LOOP → CALCULATE EVERYTHING
        // ===============================
        data.stations.forEach(st => {

            let stationProcedureTotal = 0;
            let stationProcedureMax = 0;
            let stationMcqTotal = 0;
            let stationMcqMax = 0;

            // Procedure totals
            st.procedures.forEach(p => {
                stationProcedureTotal += Number(p.score);
                stationProcedureMax += Number(p.marks);
            });

            // MCQ totals
            st.mcqs.forEach(q => {
                stationMcqMax += Number(q.mark);

                q.options.forEach(opt => {
                    if(opt.is_selected && opt.is_correct == 1){
                        stationMcqTotal += Number(q.mark);
                    }
                });
            });

            const stationTotal = stationProcedureTotal + stationMcqTotal;

            overallProcedure += stationProcedureTotal;
            overallMcq += stationMcqTotal;

            stationSummaries.push({
                title: st.station_title,
                procedure: stationProcedureTotal,
                procedureMax: stationProcedureMax,
                mcq: stationMcqTotal,
                mcqMax: stationMcqMax,
                total: stationTotal
            });
        });

        const overallTotal = overallProcedure + overallMcq;

        // ===============================
        // BUILD HTML
        // ===============================
        let html = `
        <div id="printFullReport">

            <!-- HEADER + PRINT -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="mb-0">
                        ${data.student.surname} ${data.student.first_name}
                    </h4>
                    <small>Admission No: ${data.student.admission_no}</small>
                </div>

                <button class="btn btn-dark btn-sm" onclick="printFullReport()">
                    <i class="fas fa-print"></i> Print
                </button>
            </div>

            <hr>

            <!-- OVERALL SUMMARY BOARD -->
            <div class="p-3 mb-4 rounded shadow border bg-light">

                <h5 class="text-center mb-3 text-uppercase text-primary">
                    Overall Performance Summary
                </h5>

                <div class="table-responsive">
                    <table class="table table-bordered table-sm text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>Station</th>
                                <th>Procedure</th>
                                <th>MCQ</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
        `;

        // ===============================
        // STATION SUMMARY ROWS
        // ===============================
        stationSummaries.forEach(s => {
            html += `
                <tr>
                    <td><strong>${s.title}</strong></td>
                    <td class="text-primary font-weight-bold">
                        ${s.procedure}/${s.procedureMax}
                    </td>
                    <td class="text-success font-weight-bold">
                        ${s.mcq}/${s.mcqMax}
                    </td>
                    <td class="text-danger font-weight-bold">
                        ${s.total}
                    </td>
                </tr>
            `;
        });

        // OVERALL ROW
        html += `
                <tr class="bg-dark text-white font-weight-bold">
                    <td>OVERALL</td>
                    <td>${overallProcedure}</td>
                    <td>${overallMcq}</td>
                    <td>${overallTotal}</td>
                </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        `;

        // ===============================
        // DETAILED STATION BREAKDOWN
        // ===============================
        data.stations.forEach((st, index) => {

            html += `
                <div class="p-3 mb-4 rounded shadow-sm border">

                    <h5 class="text-primary">
                        ${st.station_title}
                    </h5>
            `;

            // Procedures Table
            html += `
                <h6 class="mt-3">Procedures</h6>
                <table class="table table-bordered table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Procedure</th>
                            <th>Mark Obtainable</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            st.procedures.forEach(p => {
                html += `
                    <tr>
                        <td>${p.name}</td>
                        <td>${p.marks}</td>
                        <td class="font-weight-bold">${p.score}</td>
                    </tr>
                `;
            });

            html += `</tbody></table>`;

            // MCQs
            html += `<h6 class="mt-3">MCQs</h6>`;

            st.mcqs.forEach((q, idx) => {

                html += `
                    <div class="mb-2">
                        <p>
                            <strong>Q${idx+1}: ${q.question}</strong>
                            <span class="text-info">(Mark Obtainable: ${q.mark})</span>
                        </p>
                        <ul>
                `;

                q.options.forEach(opt => {

                    const selected = opt.is_selected 
                        ? '<span class="text-primary font-weight-bold">✔ Selected</span>' 
                        : '';

                    const correct = opt.is_correct == 1
                        ? '<span class="text-success font-weight-bold">✔ Correct</span>' 
                        : '';

                    html += `<li>${opt.text} ${selected} ${correct}</li>`;
                });

                html += `</ul></div>`;
            });

            html += `</div>`;
        });

        html += `</div>`;

        $('#studentPreviewContent').html(html);
        $('#studentPreviewModal').modal('show');

    });

});
</script>


<script>
    function printFullReport(){
    const content = document.getElementById('printFullReport').innerHTML;
    const win = window.open('', '', 'width=900,height=700');

    win.document.write(`
        <html>
        <head>
            <title>Full OSCE Report</title>
            <link rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body>${content}</body>
        </html>
    `);

    win.document.close();
    win.print();
}

</script>


<!-- <script>
function printStudentResult() {
    let printContents = document.getElementById('printableArea').innerHTML;
    let originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;

    location.reload(); // reload to restore modal properly
}
</script> -->


