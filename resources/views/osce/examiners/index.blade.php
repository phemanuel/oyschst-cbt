@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold mb-4">All Examiners</h3>

    <div id="examinerMessage" style="display:none;">
        <div class="alert"></div>
    </div>

    <button class="btn btn-success mb-3" id="addExaminerBtn">Add Examiner</button>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
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
                <td class="examiner-status">{{ ucfirst($examiner->user_status) }}</td>
                <td>
                    <button class="btn btn-sm btn-primary edit-examiner-btn"
                        data-id="{{ $examiner->id }}"
                        data-name="{{ $examiner->name }}"
                        data-email="{{ $examiner->email }}"
                        data-status="{{ $examiner->user_status }}">
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
                <td colspan="5" class="text-center text-muted">No examiners found.</td>
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
          <h5 class="modal-title">Add Examiner</h5>
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
            <label>Status</label>
            <select name="user_status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
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
          <h5 class="modal-title">Edit Examiner</h5>
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
            <label>Password (leave blank to keep unchanged)</label>
            <input type="password" id="editExaminerPassword" name="password" class="form-control">
          </div>
          <div class="form-group">
            <label>Status</label>
            <select id="editExaminerStatus" name="user_status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
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
          <h5 class="modal-title">Delete Examiner</h5>
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
            row.find('.examiner-status').text(res.examiner.user_status);

            // Update button data
            row.find('.edit-examiner-btn')
                .data('name', res.examiner.name)
                .data('email', res.examiner.email)
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
                showMessage('Error deleting examiner','danger');
            }
        });
    });

});
</script>
