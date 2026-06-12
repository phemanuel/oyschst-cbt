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
        <div class="row mb-3">
            <!--<div class="col-md-4">-->
            <!--    <label>Select Exam Date</label>-->
            <!--    <input type="date" id="summaryDateInput" class="form-control">-->
            <!--</div>-->
        </div>
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
        <h5 class="modal-title">
            Student Results - <span id="summaryDateLabel"></span>
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      
      <div class="modal-body">

        <!-- Controls: Print, Export, Date Picker -->
        <div class="d-flex flex-wrap align-items-end mb-3">

          <button class="btn btn-sm btn-primary mr-2 mb-2" id="printSummaryBtn">
            Print Scored Students
          </button>

          <button class="btn btn-sm btn-success mr-2 mb-2" id="exportExcelBtn">
            Export to Excel
          </button>

          <div class="form-group mb-2">
            <label for="summaryDateInput" class="mr-2"><strong>Filter by Date</strong></label>
            <input type="date" id="summaryDateInput" class="form-control d-inline-block" style="width:auto;">
          </div>

          <button class="btn btn-primary mb-2 ml-2" id="loadSummaryBtn">
            Load Results
          </button>

        </div>

        <!-- Students Table -->
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
<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

<script>
    const resultsStationUrl = "{{ route('osce.results.station', ':id') }}";
</script>
<script>
$(document).ready(function(){



    let currentStation = {};

// =========================
// INIT DATA TABLE (once only)
// =========================
const stationTable = $('#stationStudentsTable').DataTable({
    paging: true,
    searching: true,
    info: false,
    lengthChange: false,
    pageLength: 10,
    destroy: true,
    columns: [
        { data: 'admission_no' },
        { data: 'full_name' },
        { data: 'examiner_score' },
        { data: 'mcq_score' },
        { data: 'total_score' },
        { data: 'action' }
    ],
    language: {
        emptyTable: "No students found"
    }
});


// =========================
// CLICK STATION CARD
// =========================
$('.station-card').on('click', function () {

    const stationId = $(this).data('station-id');

    currentStation = {
        id: stationId,
        title: $(this).data('station-title') ?? 'N/A',
        practicalQuestion: $(this).data('practical-question') ?? 'N/A'
    };

    $.get(resultsStationUrl.replace(':id', stationId), function (data) {

        // clear existing rows safely
        stationTable.clear();

        if (data && data.length > 0) {

            const formatted = data.map(res => {

                const fullName = `${res.student?.surname ?? ''} ${res.student?.first_name ?? ''} ${res.student?.other_name ?? ''}`.trim();

                return {
                    admission_no: res.student?.admission_no ?? '-',
                    full_name: fullName || '-',
                    examiner_score: res.examiner_score ?? 0,
                    mcq_score: res.mcq_score ?? 0,
                    total_score: res.total_score ?? 0,
                    action: `
                        <button class="btn btn-sm btn-info preview-student-btn"
                            data-student-id="${res.student?.id}"
                            data-station-id="${currentStation.id}"
                            data-station-title="${currentStation.title}"
                            data-practical-question="${currentStation.practicalQuestion}"
                            data-procedure-total="${res.examiner_score ?? 0}"
                            data-mcq-total="${res.mcq_score ?? 0}"
                            data-overall-total="${res.total_score ?? 0}">
                            Preview <i class="fas fa-eye"></i>
                        </button>
                    `
                };
            });

            stationTable.rows.add(formatted);
        }

        stationTable.draw();

        $('#stationStudentsModal').modal('show');

    }).fail(function (err) {
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

            let url = "{{ route('osce.results.student.preview', ['student' => ':student', 'station' => ':station']) }}"
        .replace(':student', studentId)
        .replace(':station', stationId);
    
    $.get(url, function(data) {

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

<!--Summary result data-->
<script>
$(function () {

    let summaryData = null; // stores currently loaded data

    // =====================================
    // OPEN SUMMARY MODAL
    // =====================================
    $(document).on('click', '.summary-card', function () {

        $('#summaryDateInput').val('');
        $('#summaryDateLabel').text('');

        if ($.fn.DataTable.isDataTable('#stationStudentsTable')) {
            $('#stationStudentsTable').DataTable().clear().destroy();
        }

        $('#stationStudentsTable thead tr').empty();
        $('#stationStudentsTable tbody').empty();

        // Load all results by default
        $.get("{{ route('osce.results.student.summary') }}")
    .done(function (data) {
                summaryData = data;

                buildTableHeader(data.stations);
                buildTableBody(data.students);

                $('#stationStudentsTable').DataTable({
                    paging: true,
                    searching: true,
                    info: false,
                    lengthChange: false,
                    pageLength: 10,
                    scrollX: true
                });

                $('#stationStudentsModal').modal('show');
            })
            .fail(function () {
                alert('Failed to load summary.');
            });

    });


    // =====================================
    // LOAD RESULTS FOR SELECTED DATE
    // =====================================
    $(document).on('click', '#loadSummaryBtn', function () {

        let selectedDate = $('#summaryDateInput').val();

        if (!selectedDate) {
            alert('Please select exam date');
            return;
        }

        $('#summaryDateLabel').text(selectedDate);

        if ($.fn.DataTable.isDataTable('#stationStudentsTable')) {
            $('#stationStudentsTable').DataTable().clear().destroy();
        }

        $('#stationStudentsTable thead tr').empty();
        $('#stationStudentsTable tbody').empty();

        // Get summary filtered by selected date
$.get("{{ route('osce.results.student.summary') }}", { date: selectedDate })
    .done(function (data) {
                summaryData = data;

                buildTableHeader(data.stations);
                buildTableBody(data.students);

                $('#stationStudentsTable').DataTable({
                    paging: true,
                    searching: true,
                    info: false,
                    lengthChange: false,
                    pageLength: 10,
                    scrollX: true
                });

            })
            .fail(function () {
                alert('Failed to load summary for selected date.');
            });

    });


    // =====================================
    // BUILD TABLE HEADER
    // =====================================
    function buildTableHeader(stations) {
    let headerRow = `
        <th>Student Name</th>
        <th>Department</th>
    `;

    stations.forEach(st => {
        headerRow += `<th title="${st.title}">${st.title}</th>`;
    });

    headerRow += `<th>Overall</th><th>Action</th>`;

    $('#stationStudentsTable thead tr').html(headerRow);
}


    // =====================================
    // BUILD TABLE BODY
    // =====================================
    function buildTableBody(students) {
    $('#stationStudentsTable tbody').empty();

    students.forEach(res => {

        let row = `
            <tr>
                <td>
                    ${res.student.surname ?? ''} ${res.student.first_name ?? ''}<br>
                    <small>${res.student.admission_no ?? ''}</small>
                </td>
                <td>${res.student.department ?? '—'}</td>
        `;

        res.stations.forEach(st => {

            if (st.completed) {

                row += `
                    <td>
                        <div><strong>Procedure:</strong> ${st.examiner_score}</div>
                        <div><strong>MCQ:</strong> ${st.mcq_score}</div>
                        <div><strong>Total:</strong> ${st.total_score}</div>
                    </td>
                `;

            } else {
                row += `<td class="text-danger"><small>Not Completed</small></td>`;
            }
        });

        row += `
            <td><strong class="text-primary">${res.overall_total}</strong></td>
            <td>
                ${
                    res.overall_total > 0
                        ? `<button class="btn btn-sm btn-dark preview-full-btn" data-student-id="${res.student.id}">Preview</button>`
                        : `<span class="text-muted">—</span>`
                }
            </td>
        </tr>
        `;

        $('#stationStudentsTable tbody').append(row);
    });
}


   // =====================================
// EXPORT TO EXCEL
// =====================================
$(document).on('click', '#exportExcelBtn', function () {

    if (!summaryData) {
        alert('No data available.');
        return;
    }

    let excelData = [];

    // =========================
    // HEADER
    // =========================
    let headerRow = ['Student Name', 'Department'];

    summaryData.stations.forEach(st => {
        headerRow.push(`${st.title} (Proc)`);
        headerRow.push(`${st.title} (MCQ)`);
        headerRow.push(`${st.title} (Total)`);
    });

    headerRow.push('Overall');

    excelData.push(headerRow);

    // =========================
    // BODY
    // =========================
    summaryData.students.forEach(res => {

        let row = [];

        row.push(`${res.student.surname ?? ''} ${res.student.first_name ?? ''} (${res.student.admission_no ?? ''})`);
        row.push(res.student.department ?? '—');

        res.stations.forEach(st => {

            if (st.completed) {
                row.push(st.examiner_score);
                row.push(st.mcq_score);
                row.push(st.total_score);
            } else {
                row.push(0, 0, 0);
            }
        });

        row.push(res.overall_total);

        excelData.push(row);
    });

    const ws = XLSX.utils.aoa_to_sheet(excelData);
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "OSCE Summary");

    let selectedDate = $('#summaryDateInput').val();
    let fileDate = selectedDate ? selectedDate.replace(/-/g, '') : 'AllDates';

    XLSX.writeFile(wb, `OSCE_Summary_${fileDate}.xlsx`);
});

    // =====================================
    // PRINT SUMMARY
    // =====================================
    // =====================================
// PRINT SUMMARY (REFINED)
// =====================================
$(document).on('click', '#printSummaryBtn', function () {

    if (!summaryData) {
        alert('No data available to print.');
        return;
    }

    let printHtml = `
        <table border="1" cellspacing="0" cellpadding="5" width="100%">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Department</th>
    `;

    // =========================
    // HEADER (Station Names)
    // =========================
    summaryData.stations.forEach(st => {
        printHtml += `
            <th>
                ${st.title}<br>
                <small>Proc / MCQ / Total</small>
            </th>
        `;
    });

    printHtml += `<th>Overall</th></tr></thead><tbody>`;

    // =========================
    // BODY
    // =========================
    summaryData.students.forEach(res => {

        const hasScore = res.stations.some(st => st.completed);
        if (!hasScore) return;

        printHtml += `
            <tr>
                <td>
                    ${res.student.surname ?? ''} ${res.student.first_name ?? ''}<br>
                    <small>${res.student.admission_no ?? ''}</small>
                </td>
                <td>${res.student.department ?? '—'}</td>
        `;

        // =========================
        // STATION CELLS
        // =========================
        res.stations.forEach(st => {

            if (st.completed) {
                printHtml += `
                    <td>
                        ${st.examiner_score} /
                        ${st.mcq_score} /
                        ${st.total_score}
                    </td>
                `;
            } else {
                printHtml += `<td>—</td>`;
            }
        });

        printHtml += `
            <td><strong>${res.overall_total}</strong></td>
        </tr>
        `;
    });

    printHtml += `</tbody></table>`;

    openPrintWindow(printHtml);
});


// =====================================
// PRINT WINDOW (UNCHANGED BUT CLEAN)
// =====================================
function openPrintWindow(content) {
    const win = window.open('', '', 'width=1200,height=700');

    win.document.write(`
        <html>
            <head>
                <title>OSCE Summary Report</title>
                <style>
                    body {
                        font-family: Arial;
                        padding: 20px;
                    }

                    table {
                        border-collapse: collapse;
                        width: 100%;
                    }

                    th {
                        background: #f2f2f2;
                    }

                    th, td {
                        padding: 6px;
                        text-align: center;
                        font-size: 13px;
                    }

                    h3 {
                        text-align: center;
                        margin-bottom: 20px;
                    }
                </style>
            </head>
            <body>
                <h3>OSCE Summary Report</h3>
                ${content}
            </body>
        </html>
    `);

    win.document.close();
    win.focus();
    win.print();
}

});

</script>



<script>
$(document).on('click', '.preview-full-btn', function(){

    const studentId = $(this).data('student-id');

   $.get(
    "{{ route('osce.results.student.full', ':student') }}"
        .replace(':student', studentId),
    function(data){

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


