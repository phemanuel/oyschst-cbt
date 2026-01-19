<table class="table table-hover">
    <tr>
        <th>ID</th>
        <th>Academic Session</th>
        <th>Programme</th>
        <th>Course</th>
        <th>Level</th>
        <th>Semester</th>
        <th>Exam Mode</th>
        <th>Exam Type</th>
        <th>Exam Date</th>
        <th>No of Questions</th>
        <th>Duration</th>
        <th>Status</th>
        <th>Created On</th>
        <th colspan="2">Actions</th>
    </tr>
    @if ($questionSetting->count() > 0)
        @foreach ($questionSetting as $key => $rs)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $rs->session1 }}</td>
                <td>{{ $rs->department }}</td>
                <td>{{ $rs->course }}</td>
                <td>{{ $rs->level }}</td>
                <td>{{ $rs->semester }}</td>
                <td>{{ $rs->exam_mode }}</td>
                <td>{{ $rs->exam_type }}</td>
                <td>{{ $rs->exam_date }}</td>
                <td>{{ $rs->no_of_qst }}</td>
                <td>{{ $rs->duration }}</td>
                <td>{{ $rs->exam_status }}</td>
                <td>{{ $rs->created_at }}</td>
                <td><a class="label label-success" href="{{ route('report-objective-view', ['id' => $rs->id]) }}">Check Result</a></td>
                <td><a class="label label-info" href="{{ route('report-objective-csv', ['id' => $rs->id]) }}">Export CSV</a></td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="14">Questions not available.</td>
        </tr>
    @endif
</table>
