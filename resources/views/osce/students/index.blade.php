@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="mb-4">All Students</h3>

    <div id="studentMessage" style="display:none;">
        <div class="alert"></div>
    </div>

    <div class="mb-3 d-flex justify-content-between">
        <button class="btn btn-success" id="addStudentBtn">Add Student</button>
        <input type="text" id="studentSearch" class="form-control w-25" placeholder="Search by Admission No or Department">
    </div>

    <table class="table table-hover" id="studentTable">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Admission No</th>
                <th>Name</th>
                <!-- <th>Email</th> -->
                <th>Phone</th>
                <th>Department</th>
                <!-- <th>Status</th> -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $index => $student)
            <tr id="student-{{ $student->id }}">
                <td>{{ $index+1 }}</td>
                <td class="student-adm">{{ $student->admission_no }}</td>
                <td class="student-name">{{ $student->first_name }} {{ $student->surname }}</td>
                
                <td class="student-phone">{{ $student->phone_no ?? '' }}</td>
                <td class="student-department">{{ $student->department ?? '' }}</td>
                <!-- <td class="student-status">{{ $student->login_status ? 'Active' : 'Inactive' }}</td> -->
                <td>
                    <button class="btn btn-primary btn-sm edit-student-btn"
                        data-id="{{ $student->id }}"
                        data-admission="{{ $student->admission_no }}"
                        data-first_name="{{ $student->first_name }}"
                        data-surname="{{ $student->surname }}"                        
                        data-phone="{{ $student->phone_no ?? '' }}"
                        data-department="{{ $student->department ?? '' }}"
                        data-login_status="{{ $student->login_status }}"
                        data-department="{{ $student->department ?? '' }}">
                        Edit
                    </button>
                    <button class="btn btn-danger btn-sm delete-student-btn"
                        data-id="{{ $student->id }}">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

<!-- Add Student Modal -->
<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="addStudentForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <div class="form-group">
            <label>Admission No</label>
            <input type="text" name="admission_no" class="form-control" required>
          </div>
          <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Surname</label>
            <input type="text" name="surname" class="form-control" required>
          </div>
          <!-- <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
          </div> -->
          <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone_no" class="form-control">
          </div>
          <div class="form-group">
            <label>Department</label>
            <select name="department" class="form-control" required>
                <option value="">Select Department</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->department }}">{{ $dept->department }}</option>
                @endforeach
            </select>
        </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Add Student</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Edit Student Modal -->
<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="editStudentForm">
      @csrf
      @method('PUT')
      <input type="hidden" id="editStudentId" name="id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <div class="form-group">
            <label>Admission No</label>
            <input type="text" id="editAdmission" name="admission_no" class="form-control" required>
          </div>
          <div class="form-group">
            <label>First Name</label>
            <input type="text" id="editFirstName" name="first_name" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Surname</label>
            <input type="text" id="editSurname" name="surname" class="form-control" required>
          </div>
          <!-- <div class="form-group">
            <label>Email</label>
            <input type="email" id="editEmail" name="email" class="form-control">
          </div> -->
          <div class="form-group">
            <label>Phone</label>
            <input type="text" id="editPhone" name="phone_no" class="form-control">
          </div>
          <div class="form-group">
                <label>Department</label>
                <select id="editDepartment" name="department" class="form-control" required>
                    <option value="">Select Department</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->department }}">{{ $dept->department }}</option>
                    @endforeach
                </select>
            </div>
          <div class="form-group">
            <label>Password (leave blank to keep unchanged)</label>
            <input type="password" id="editPassword" name="password" class="form-control">
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update Student</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Delete Student Modal -->
<div class="modal fade" id="deleteStudentModal" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
<form id="deleteStudentForm" method="POST">
@csrf
@method('DELETE')
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Delete Student</h5>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<p>Are you sure you want to delete this student?</p>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-danger">Delete</button>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
</div>
</div>
</form>
</div>
</div>


<script src="{{ asset('student/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('student/js/bootstrap.bundle.min.js') }}"></script>
<script>
$(document).ready(function(){

    var studentMessage = $('#studentMessage');
    var studentAlert = studentMessage.find('.alert');

    function showMessage(message, type='success'){
        studentAlert.attr('class','alert alert-'+type).text(message);
        studentMessage.show();
        setTimeout(()=> studentMessage.hide(), 4000);
    }

    function renderStudentRow(student, index){
        return `
        <tr id="student-${student.id}">
            <td>${index}</td>
            <td class="student-adm">${student.admission_no}</td>
            <td class="student-name">${student.first_name} ${student.surname}</td>
            
            <td class="student-phone">${student.phone_no ?? ''}</td>
            <td class="student-status">${student.login_status ? 'Active' : 'Inactive'}</td>
            <td>
                <button class="btn btn-primary btn-sm edit-student-btn"
                    data-id="${student.id}"
                    data-admission="${student.admission_no}"
                    data-first_name="${student.first_name}"
                    data-surname="${student.surname}"
                    data-department="${student.department}"
                    data-phone="${student.phone_no ?? ''}"
                    data-login_status="${student.login_status}">
                    Edit
                </button>
                <button class="btn btn-danger btn-sm delete-student-btn"
                    data-id="${student.id}">
                    Delete
                </button>
            </td>
        </tr>`;
    }

    // Add Student
    $('#addStudentBtn').click(function(){
        $('#addStudentForm')[0].reset();
        $('#addStudentModal').modal('show');
    });

    $('#addStudentForm').submit(function(e){
        e.preventDefault();
        $.post("{{ route('students.store') }}", $(this).serialize(), function(res){
            $('#addStudentModal').modal('hide');
            showMessage(res.success);
            let rowCount = $('#studentTable tbody tr').length + 1;
            $('#studentTable tbody').append(renderStudentRow(res.student, rowCount));
        }).fail(function(err){
            showMessage(Object.values(err.responseJSON.errors).map(v=>v.join(',')).join(' | '), 'danger');
        });
    });

        // ---------------- Edit Student ----------------
        $(document).on('click', '.edit-student-btn', function() {
        let student = $(this).data();

        $('#editStudentId').val(student.id);
        $('#editAdmission').val(student.admission);
        $('#editFirstName').val(student.first_name);
        $('#editSurname').val(student.surname);
        $('#editDepartment').val(student.department);
        $('#editPhone').val(student.phone);
        $('#editPassword').val(''); // force new password

        // Make sure the department exists in the select
        if(student.department) {
            $('#editDepartment').val(student.department);
        } else {
            $('#editDepartment').val('');
        }

        $('#editStudentModal').modal('show');
    });

    // ---------------- Submit Edit Student ----------------
    $('#editStudentForm').submit(function(e) {
        e.preventDefault();
        let id = $('#editStudentId').val();
        let formData = $(this).serialize();

        $.ajax({
            url: '/osce/students/' + id,
            method: 'PUT',
            data: formData,
            success: function(res) {
                $('#editStudentModal').modal('hide');
                showMessage('Student updated successfully!', 'success');

                // Update table row dynamically
                let row = $('#student-' + res.student.id);
                row.replaceWith(renderStudentRow(res.student, row.index() + 1));
            },
            error: function(err) {
                let messages = [];
                if (err.responseJSON && err.responseJSON.errors) {
                    messages = Object.values(err.responseJSON.errors).map(v => v.join(','));
                }
                showMessage(messages.join(' | '), 'danger');
            }
        });
    });

    // Delete Student
    $(document).on('click', '.delete-student-btn', function(){
        let id = $(this).data('id');
        $('#deleteStudentForm').attr('action','/osce/students/'+id);
        $('#deleteStudentModal').modal('show');
    });

    $('#deleteStudentForm').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'DELETE',
            data: $(this).serialize(),
            success: function(res){
                $('#deleteStudentModal').modal('hide');
                showMessage(res.success);
                $('#student-'+$('#deleteStudentForm').attr('action').split('/').pop()).remove();
                $('#studentTable tbody tr').each(function(i){
                    $(this).find('td:first').text(i+1);
                });
            }
        });
    });

});
</script>
<script>
$(document).ready(function(){
    // Live search filter
    $('#studentSearch').on('keyup', function(){
        var value = $(this).val().toLowerCase();
        $('#studentTable tbody tr').filter(function(){
            var admission = $(this).find('.student-adm').text().toLowerCase();
            var name = $(this).find('.student-name').text().toLowerCase();
            var department = $(this).find('.student-department').text().toLowerCase();
            $(this).toggle(admission.indexOf(value) > -1 || name.indexOf(value) > -1 || department.indexOf(value) > -1);
        });

        // Re-number rows after filtering
        $('#studentTable tbody tr:visible').each(function(i){
            $(this).find('td:first').text(i+1);
        });
    });
});
</script>
