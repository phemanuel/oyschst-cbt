@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold mb-4">All Admin/Examiners</h3>

    <div id="examinerMessage" style="display:none;">
        <div class="alert"></div>
    </div>

    <button class="btn btn-success mb-3" id="addExaminerBtn">Add Admin/Examiner</button>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Assigned Station</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($examiners as $examiner)
<tr id="examiner-{{ $examiner->id }}">
    <td>{{ $loop->iteration }}</td>
    <td class="examiner-name">{{ $examiner->name }}</td>
    <td class="examiner-email">{{ $examiner->email }}</td>
    <td class="examiner-user-type">{{ $examiner->user_type }}</td>
    <td class="examiner-station">
    {{ $examiner->station->title ?? 'Not Assigned' }}
    </td>
    <td class="examiner-status">{{ ucfirst($examiner->user_status) }}</td>
    <td>

        {{-- Show Assign ONLY if user_type is examiner --}}
        @if($examiner->user_type === 'examiner')
            <button class="btn btn-sm btn-success assign-examiner-btn"
                data-id="{{ $examiner->id }}"
                data-name="{{ $examiner->name }}"
                data-email="{{ $examiner->email }}"
                data-station-id="{{ $examiner->station_id }}">
                Assign
            </button>
        @endif

        <button class="btn btn-sm btn-primary edit-examiner-btn"
            data-id="{{ $examiner->id }}"
            data-name="{{ $examiner->name }}"
            data-email="{{ $examiner->email }}"
            data-status="{{ $examiner->user_status }}"
            data-user-type="{{ $examiner->user_type }}">
            Edit
        </button>

        <button class="btn btn-sm btn-danger delete-examiner-btn"
            data-id="{{ $examiner->id }}">
            Delete
        </button>

    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="text-center text-muted">
        No admin/examiners found.
    </td>
</tr>
@endforelse
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addExaminerModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="addExaminerForm">
        <div class="modal-header">
          <h5 class="modal-title">Add Admin/Examiner</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Role</label>
            <select name="user_type" class="form-control">
              <option value="admin">Admin</option>
              <option value="examiner">Examiner</option>
            </select>
          </div>
          <div class="form-group">
            <label>Status</label>
            <select name="user_status" class="form-control">
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editExaminerModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editExaminerForm">
        <div class="modal-header">
          <h5 class="modal-title">Edit Admin/Examiner</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          @csrf
          <input type="hidden" id="editExaminerId">
          <div class="form-group">
            <label>Name</label>
            <input type="text" id="editExaminerName" name="name" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" id="editExaminerEmail" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Email</label>
           <select name="user_type"  id="editExaminerUserType" class="form-control">
              <option value="admin">Admin</option>
              <option value="examiner">Examiner</option>
            </select>
          </div>
          <div class="form-group">
            <label>Password (leave blank to keep unchanged)</label>
            <input type="password" id="editExaminerPassword" name="password" class="form-control">
          </div>
          <div class="form-group">
            <label>Status</label>
            <select id="editExaminerStatus" name="user_status" class="form-control">
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteExaminerModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="deleteExaminerForm">
        @csrf
        @method('DELETE')
        <div class="modal-header">
          <h5 class="modal-title">Delete Admin/Examiner</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this examiner?
          <input type="hidden" id="deleteExaminerId">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Yes, Delete</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="assignStationModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Assign Examiner to Station</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                <form id="assignStationForm">
                    @csrf
                    <input type="hidden" id="assign_user_id">

                    <div class="mb-2">
                        <label>Name</label>
                        <input type="text" id="assign_name" class="form-control" readonly>
                    </div>

                    <div class="mb-2">
                        <label>Email</label>
                        <input type="text" id="assign_email" class="form-control" readonly>
                    </div>

                    <div class="mb-2">
                        <label>Select Station</label>
                        <select id="assign_station_id" class="form-control">
                            <option value="">-- Select Station --</option>
                            @foreach($stations as $station)
                                <option value="{{ $station->id }}">
                                    {{ $station->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveAssignBtn">
                    Save Assignment
                </button>
            </div>

        </div>
    </div>
</div>

@endsection
<script src="{{ asset('student/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('student/js/bootstrap.bundle.min.js') }}"></script>
<script>
$(document).ready(function(){

    function showMessage(message, type='success'){
        let msg = $('#examinerMessage');
        let alert = msg.find('.alert');
        alert.attr('class','alert alert-' + type).text(message);
        msg.show();
        setTimeout(()=> msg.hide(), 4000);
    }

    // ---------------- ADD ----------------
    $('#addExaminerBtn').click(function(){
        $('#addExaminerForm')[0].reset();
        $('#addExaminerModal').modal('show');
    });

    $('#addExaminerForm').submit(function(e){
        e.preventDefault();
        $.post("{{ route('examiners.store') }}", $(this).serialize())
        .done(function(res){
            $('#addExaminerModal').modal('hide');
            showMessage(res.success);

            // Append new row to table
            let examiner = res.examiner;
            $('table tbody').append(`
                <tr id="examiner-${examiner.id}">
                    <td>${$('table tbody tr').length + 1}</td>
                    <td class="examiner-name">${examiner.name}</td>
                    <td class="examiner-email">${examiner.email}</td>
                    <td class="examiner-user-type">${examiner.user_type}</td>
                    <td class="examiner-status">${examiner.user_status}</td>
                    <td>
                        <button class="btn btn-sm btn-primary edit-examiner-btn"
                            data-id="${examiner.id}" data-name="${examiner.name}" data-email="${examiner.email}" data-status="${examiner.user_status}">
                            Edit
                        </button>
                        <button class="btn btn-sm btn-danger delete-examiner-btn"
                            data-id="${examiner.id}">Delete</button>
                    </td>
                </tr>
            `);
        })
        .fail(function(err){
            let e = err.responseJSON.errors;
            showMessage(Object.values(e).map(v=>v.join(', ')).join(' | '),'danger');
        });
    });

    // ---------------- EDIT ----------------
    $(document).on('click', '.edit-examiner-btn', function(){
        let btn = $(this);
        $('#editExaminerId').val(btn.data('id'));
        $('#editExaminerName').val(btn.data('name'));
        $('#editExaminerEmail').val(btn.data('email'));
        $('#editExaminerUserType').val(btn.data('user-type'));
        $('#editExaminerStatus').val(btn.data('status'));
        $('#editExaminerPassword').val('');
        $('#editExaminerModal').modal('show');
    });

    $('#editExaminerForm').submit(function(e){
        e.preventDefault();
        let id = $('#editExaminerId').val();
        $.post(`/osce/examiners/${id}`, $(this).serialize())
        .done(function(res){
            $('#editExaminerModal').modal('hide');
            showMessage(res.success);

            let row = $('#examiner-' + id);
            row.find('.examiner-name').text(res.examiner.name);
            row.find('.examiner-email').text(res.examiner.email);
            row.find('.examiner-user-type').text(res.examiner.user_type);
            row.find('.examiner-status').text(res.examiner.user_status);

            // Update button data
            row.find('.edit-examiner-btn')
                .data('name', res.examiner.name)
                .data('email', res.examiner.email)
                .data('user-type', res.examiner.user_type)
                .data('status', res.examiner.user_status);
        })
        .fail(function(err){
            let e = err.responseJSON.errors;
            showMessage(Object.values(e).map(v=>v.join(', ')).join(' | '),'danger');
        });
    });

    // ---------------- DELETE ----------------
    $(document).on('click', '.delete-examiner-btn', function(){
        $('#deleteExaminerId').val($(this).data('id'));
        $('#deleteExaminerModal').modal('show');
    });

    $('#deleteExaminerForm').submit(function(e){
        e.preventDefault();
        let id = $('#deleteExaminerId').val();
        $.ajax({
            url: `/osce/examiners/${id}`,
            type: 'DELETE',
            data: $(this).serialize(),
            success: function(res){
                $('#deleteExaminerModal').modal('hide');
                showMessage(res.success);
                $('#examiner-' + id).remove();
            },
            error: function(err){
                showMessage('Error deleting admin/examiner','danger');
            }
        });
    });

});
</script>

<script>

$(document).on('click', '.assign-examiner-btn', function(){

    const id = $(this).data('id');
    const name = $(this).data('name');
    const email = $(this).data('email');
    const stationId = $(this).data('station-id');

    $('#assign_user_id').val(id);
    $('#assign_name').val(name);
    $('#assign_email').val(email);

    // Reset dropdown
    $('#assign_station_id').val('');

    // Preselect if already assigned
    if(stationId){
        $('#assign_station_id').val(stationId);
    }

    $('#assignStationModal').modal('show');
});


// SAVE ASSIGNMENT
$(document).on('click', '#saveAssignBtn', function(){

    const userId = $('#assign_user_id').val();
    const stationId = $('#assign_station_id').val();

    $.ajax({
        url: `/osce/examiner/assign-station/${userId}`,
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            station_id: stationId
        },
        success: function(response){

            $('#assignStationModal').modal('hide');

            // Update button data attribute for future reassign
            $(`#examiner-${userId} .assign-examiner-btn`)
                .data('station-id', stationId);

            alert('Station assigned successfully');
            location.reload();
        },
        error: function(){
            alert('Assignment failed');
        }
    });

});

</script>

