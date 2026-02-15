@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h3 class="fw-bold mb-4">All Stations & Procedures</h3>

    <div id="procedureMessage" style="display:none;">
        <div class="alert"></div>
    </div>

    @forelse($stations as $station)
        <div class="card mb-4 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $station->title }}</h5>
                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addProcedureModal" 
                        data-station-id="{{ $station->id }}">
                    Add Procedure
                </button>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Max Score</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($station->procedures as $procedure)
                            <tr id="procedure-{{ $procedure->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td class="procedure-title">{{ $procedure->title }}</td>
                                <td class="procedure-description">{{ Str::limit($procedure->description, 50) }}</td>
                                <td class="procedure-max-score">{{ $procedure->max_score }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary edit-procedure-btn" 
                                            data-id="{{ $procedure->id }}"
                                            data-title="{{ $procedure->title }}"
                                            data-description="{{ $procedure->description }}"
                                            data-max_score="{{ $procedure->max_score }}">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-procedure-btn" 
                                            data-id="{{ $procedure->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No procedures added yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <p class="text-center text-muted">No stations found.</p>
    @endforelse
</div>

@endsection

<!-- Add Procedure Modal -->
<div class="modal fade" id="addProcedureModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addProcedureForm">
            @csrf
            <input type="hidden" name="station_id" id="addProcedureStationId">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Procedure</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <!-- Show Station Name -->
                    <div class="mb-3">
                        <strong>Station:</strong> 
                        <span id="procedureStationName" class="text-primary"></span>
                    </div>

                    <!-- Procedure Title -->
                    <div class="form-group">
                        <label>Procedure Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <!-- Procedure Description -->
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>

                    <!-- Max Score -->
                    <div class="form-group">
                        <label>Max Score</label>                        
                        <select name="max_score" class="form-control">
                            <option value="0.5">0.5</option>
                            <option value="1" selected>1</option>
                            <option value="1.5">1.5</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Edit Procedure Modal -->
<div class="modal fade" id="editProcedureModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editProcedureForm">
            @csrf
            @method('PUT')
            <input type="hidden" id="editProcedureId" name="procedure_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Procedure</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" id="editProcedureTitle" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="editProcedureDescription" name="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Max Score</label>                        
                        <select name="max_score" id="editProcedureMaxScore" class="form-control">
                            <option value="0.5" @if(old('max_score')==0.5) selected @endif>0.5</option>
                            <option value="1" @if(old('max_score')==1) selected @endif>1</option>
                            <option value="1.5" @if(old('max_score')==1.5) selected @endif>1.5</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script src="{{ asset('student/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('student/js/bootstrap.bundle.min.js') }}"></script>
<script>
$(document).ready(function(){

    let procedureIdToDelete = null;

    function showMessage(message, type='success') {
        let container = $('#procedureMessage');
        let alertBox = container.find('.alert');
        alertBox.removeClass('alert-success alert-danger').addClass('alert-' + type).text(message);
        container.fadeIn();
        setTimeout(()=> container.fadeOut(), 3000);
    }

    // Edit modal
    $('.edit-procedure-btn').click(function(){
        let id = $(this).data('id');
        $('#editProcedureId').val(id);
        $('#editProcedureTitle').val($(this).data('title'));
        $('#editProcedureDescription').val($(this).data('description'));
        $('#editProcedureMaxScore').val($(this).data('max_score'));
        $('#editProcedureModal').modal('show');
    });

    // Edit form AJAX
    $('#editProcedureForm').submit(function(e){
        e.preventDefault();
        let id = $('#editProcedureId').val();
        let formData = $(this).serialize();

        $.ajax({
            url: '/osce/stations/procedures/' + id,
            type: 'POST',
            data: formData,
            success: function(res){
                $('#editProcedureModal').modal('hide');
                let row = $('#procedure-' + id);
                row.find('.procedure-title').text(res.title);
                row.find('.procedure-description').text(res.description.substring(0,50));
                row.find('.procedure-max-score').text(res.max_score);
                showMessage('Procedure updated successfully!');
            },
            error: function(err){ showMessage('Error updating procedure','danger'); }
        });
    });

    // Delete button click
    $('.delete-procedure-btn').click(function(){
        procedureIdToDelete = $(this).data('id');
        $('#deleteProcedureModal').modal('show');
    });

    // Confirm delete AJAX
    $('#confirmDeleteProcedure').click(function(){
        $.ajax({
            url: '/osce/stations/procedures/' + procedureIdToDelete,
            type: 'DELETE',
            data: {_token:'{{ csrf_token() }}'},
            success: function(res){
                $('#deleteProcedureModal').modal('hide');
                $('#procedure-' + procedureIdToDelete).remove();
                procedureIdToDelete = null;
                showMessage('Procedure deleted successfully!');
                location.reload(); // optional: reload after delete
            },
            error: function(err){
                showMessage('Error deleting procedure','danger');
            }
        });
    });

});
</script>

