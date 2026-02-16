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
                <!-- Station title and question -->
                <div>
                    <h5 class="mb-0">{{ $station->title }} - {{ $station->practical_question }}</h5>
                </div>

                <!-- Right side: Add button + Procedure count -->
                <div class="d-flex align-items-center">
                    <span class="badge badge-info mr-2">
                        {{ $station->procedures->count() }} procedure{{ $station->procedures->count() !== 1 ? 's' : '' }}
                    </span>

                    <button class="btn btn-success btn-sm add-procedure-btn" 
                            data-station-id="{{ $station->id }}"
                            data-station-title="{{ $station->title }}"
                            data-station-question="{{ $station->practical_question }}">
                        Add Procedure
                    </button>
                </div>
            </div>

            {{-- Scrollable Table --}}
            <div class="card-body p-0" style="max-height: 200px; overflow-y: auto;">
                <table class="table table-hover mb-0">
                    <thead class="bg-light sticky-top">
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
                                <td class="procedure-title">{{ $procedure->name }}</td>
                                <td class="procedure-description">{{ Str::limit($procedure->description, 50) }}</td>
                                <td class="procedure-max-score">{{ $procedure->marks }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary edit-procedure-btn" 
                                            data-id="{{ $procedure->id }}"
                                            data-title="{{ $procedure->name }}"
                                            data-description="{{ $procedure->description }}"
                                            data-max_score="{{ $procedure->marks }}">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-procedure-btn" 
                                            data-id="{{ $procedure->id }}"
                                            data-toggle="modal" 
                                            data-target="#deleteProcedureModal">
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
                    <h5 class="modal-title" id="addProcedureModalTitle">
                        Add Procedure
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Display Station Info -->
                    <p><strong>Station ID:</strong> <span id="addProcedureStationIdDisplay"></span></p>
                    <p><strong>Station Title:</strong> <span id="addProcedureStationTitleDisplay"></span></p>

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Max Score</label>
                        <select name="marks" class="form-control" required>
                            <option value="0.25">0.25</option>
                            <option value="0.5">0.5</option>
                            <option value="1.0">1.0</option>
                            <option value="1.5">1.5</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save Procedure</button>
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
                        <input type="text" id="editProcedureTitle" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="editProcedureDescription" name="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Max Score</label>                        
                        <select name="marks" id="editProcedureMaxScore" class="form-control">
                            <option value="0.25" @if(old('max_score')==0.25) selected @endif>0.25</option>
                            <option value="0.5" @if(old('max_score')==0.5) selected @endif>0.5</option>
                            <option value="1.0" @if(old('max_score')==1) selected @endif>1.0</option>
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

<!-- Delete Procedure Modal -->
<div class="modal fade" id="deleteProcedureModal" tabindex="-1" aria-labelledby="deleteProcedureModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to delete this procedure?</p>
                <p class="text-warning"><small>This action cannot be undone.</small></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" id="confirmDeleteProcedure" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('student/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('student/js/bootstrap.bundle.min.js') }}"></script>
<script>
$(document).ready(function(){

    let procedureIdToDelete = null;

    // ===============================
    // MESSAGE FUNCTION
    // ===============================
    function showMessage(message, type='success') {
        let container = $('#procedureMessage');
        let alertBox = container.find('.alert');

        alertBox.removeClass('alert-success alert-danger')
                .addClass('alert-' + type)
                .text(message);

        container.fadeIn();

        setTimeout(function(){
            container.fadeOut();
        }, 3000);

        console.log(`[Procedure] ${type.toUpperCase()}: ${message}`);
    }


    // ===============================
    // OPEN ADD PROCEDURE MODAL
    // ===============================
    $('.add-procedure-btn').click(function(){

        let stationId = $(this).data('station-id');
        let stationTitle = $(this).data('station-title');

        console.log('[Add Procedure Click] Station:', stationId);

        // Set hidden input
        $('#addProcedureStationId').val(stationId);

        // Show station name in modal title
        $('#addProcedureModal .modal-title')
            .text('Add Procedure - ' + stationTitle);
        $('#addProcedureStationIdDisplay').text(stationId);
        $('#addProcedureStationTitleDisplay').text(stationTitle);

        $('#addProcedureModal').modal('show');
    });


    // ===============================
    // ADD PROCEDURE AJAX
    // ===============================
    $('#addProcedureForm').submit(function(e){
        e.preventDefault();

        let formData = $(this).serialize();
        console.log('[AJAX Add] formData:', formData); // must include station_id

        console.log('[AJAX Add] Sending:', formData);

        $.ajax({
            url: '/osce/procedures',
            type: 'POST',
            data: formData,
            success: function(res){

                console.log('[AJAX Add Success]', res);

                $('#addProcedureModal').modal('hide');
                $('#addProcedureForm')[0].reset();

                showMessage('Procedure added successfully!', 'success');

                // Reload to display under correct station
                location.reload();
            },
            error: function(xhr){

                console.error('[AJAX Add Error]', xhr);

                if(xhr.status === 422){
                    let errors = xhr.responseJSON.errors;
                    let firstError = Object.values(errors)[0][0];
                    showMessage(firstError, 'danger');
                } else {
                    showMessage('Error adding procedure.', 'danger');
                }
            }
        });
    });


    // ===============================
    // OPEN EDIT MODAL
    // ===============================
    $('.edit-procedure-btn').click(function(){

        let id = $(this).data('id');

        console.log('[Edit Procedure Click] ID:', id);

        $('#editProcedureId').val(id);
        $('#editProcedureTitle').val($(this).data('title'));
        $('#editProcedureDescription').val($(this).data('description'));
        $('#editProcedureMaxScore').val($(this).data('max_score'));

        $('#editProcedureModal').modal('show');
    });


    // ===============================
    // EDIT PROCEDURE AJAX
    // ===============================
     // ----------------------------
    // Edit Procedure Modal
    // ----------------------------
    $('.edit-procedure-btn').click(function(){
        let id = $(this).data('id');
        $('#editProcedureId').val(id);
        $('#editProcedureTitle').val($(this).data('title'));
        $('#editProcedureDescription').val($(this).data('description'));
        $('#editProcedureMarks').val($(this).data('marks'));

        $('#editProcedureModal').modal('show');
        console.log('[Edit Procedure Click] ID:', id);
    });

    // Edit form submission
    $('#editProcedureForm').submit(function(e){
        e.preventDefault();
        let id = $('#editProcedureId').val();

        // Serialize form data and include _method=PUT
        let formData = $(this).serialize();
        formData += '&_method=PUT'; // important for PUT route

        $.ajax({
            url: '/osce/procedures/' + id,  // must match your route
            type: 'POST',              // use POST when sending _method=PUT
            data: formData,
            success: function(res){
                $('#editProcedureModal').modal('hide');

                // Update table row
                let row = $('#procedure-' + id);
                row.find('.procedure-title').text(res.procedure.name);
                row.find('.procedure-description').text(res.procedure.description.substring(0,50));
                row.find('.procedure-max-score').text(res.procedure.marks);

                // ✅ Update the edit button attributes to match the new data
                let editBtn = row.find('.edit-procedure-btn');
                editBtn.data('title', res.procedure.name);
                editBtn.data('description', res.procedure.description);
                editBtn.data('max_score', res.procedure.marks);

                showMessage('Procedure updated successfully!');
                console.log('[AJAX Edit Success]', res);
            },
            error: function(err){
                console.error('[AJAX Edit Error]', err);
                if(err.responseJSON && err.responseJSON.errors){
                    let messages = Object.values(err.responseJSON.errors).flat().join('\n');
                    showMessage(messages, 'danger');
                } else {
                    showMessage('Error updating procedure','danger');
                }
            }
        });
    });

    // ===============================
    // DELETE BUTTON CLICK
    // ===============================
    $('.delete-procedure-btn').click(function(){

        procedureIdToDelete = $(this).data('id');

        console.log('[Delete Click] ID:', procedureIdToDelete);

        $('#deleteProcedureModal').modal('show');
    });


    // ===============================
    // CONFIRM DELETE AJAX
    // ===============================
    $('#confirmDeleteProcedure').click(function(){

        if(!procedureIdToDelete) return;

        $.ajax({
            url: '/osce/procedures/' + procedureIdToDelete,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(res){

                console.log('[AJAX Delete Success]', res);

                $('#deleteProcedureModal').modal('hide');
                $('#procedure-' + procedureIdToDelete).remove();

                procedureIdToDelete = null;

                showMessage('Procedure deleted successfully!', 'success');

                // Reload to refresh grouping properly
                location.reload();
            },
            error: function(xhr){

                console.error('[AJAX Delete Error]', xhr);

                showMessage('Error deleting procedure.', 'danger');
            }
        });
    });

});
</script>


