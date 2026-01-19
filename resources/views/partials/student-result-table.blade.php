<table class="table table-hover">
    <tr>
        <th>ID</th>
        <th>Avatar</th>
        <th>Reg/Matric No</th>
        <th>Name</th>
        <th>Programme</th>
        <th>Level</th>
        <th>Exam Type</th>
        <th>No of Qst</th>
        <th>Score</th>
        <th>Exam Status</th>
        <th>Actions</th>
    </tr>
    @if ($student->count() > 0)
        @foreach ($student as $key => $rs)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>
                @if($rs->picture_name)
                    <img src="{{ asset('uploads/' . $rs->picture_name . '.jpg') }}" width="50" height="50" class="img-circle">
                @endif
            </td>
            <td>{{ $rs->studentno }}</td>
            <td>{{ $rs->studentname }}</td>
            <td>{{ $rs->department }}</td>
            <td>{{ $rs->level }}</td>
            <td>{{ $rs->exam_type }}</td>
            <td>{{ $rs->noofquestion }}</td>                    
            <td>{{ $rs->correct }}</td>   
            <td>{{ $rs->examstatus == 1 ? 'Not Completed' : 'Completed' }}</td>                 
            <td>
                <a class="label label-primary" href="{{ route('exam-sheet-page1', ['examViewType' => $examViewType , 'id' => $rs->id]) }}" target="_blank">Exam Sheet</a>  
                <a class="label label-success" href="{{ route('student-result', ['id' => $rs->id]) }}" target="_blank">Print Result</a>                   
            </td>
        </tr>
        @endforeach
    @else
        <tr>
            <td colspan="11">Results not available.</td>
        </tr>
    @endif
</table>

{{ $student->links() }}
