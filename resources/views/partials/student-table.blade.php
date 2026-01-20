<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Avatar</th>
            <th>Reg/Matric No</th>
            <th>Name</th>
            <th>Programme(1st Choice)</th>
            <th>Programme(2nd Choice)</th>
            <th>Level</th>
            <th>Phone No</th>
            <th>State</th>
            <th>Login Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($students as $key => $rs)
            <tr class="student-row"
                data-matricno="{{ strtolower($rs->admission_no) }}"
                data-department="{{ strtolower($rs->department) }}"
                data-level="{{ strtolower($rs->level) }}">
                <td>{{ $students->firstItem() + $key }}</td>
                <td><img src="{{ asset('uploads/'. $rs->picture_name . '.jpg') }}" width="50" height="50" class="img-circle"></td>
                <td>{{ $rs->admission_no }}</td>
                <td>{{ $rs->surname }} {{ $rs->first_name }} {{ $rs->other_name }}</td>
                <td>{{ $rs->department }}</td>
                <td>{{ $rs->department1 }}</td>
                <td>{{ $rs->level }}</td>
                <td>{{ $rs->phone_no }}</td>
                <td>{{ $rs->state }}</td>
                <td>
                    @if($rs->login_status == '0')
                        <span class="label label-danger">0</span>
                    @else
                        <span class="label label-success">1</span>
                    @endif
                </td>
                <td style="display: flex; gap: 5px;">
                    <a class="label label-primary custom-label" href="{{ route('student-edit.action', ['id' => $rs->id]) }}">
                        <i class="fa fa-pencil"></i> Edit
                    </a>

                    <a class="label label-danger custom-label" href="{{ route('student-delete.action', ['id' => $rs->id]) }}" onclick="return confirm('Are you sure you want to delete this student?');">
                        <i class="fa fa-trash"></i> Delete
                    </a>
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="11">No students found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Pagination links --}}
<div class="mt-2">
    {!! $students->links() !!}
</div>
