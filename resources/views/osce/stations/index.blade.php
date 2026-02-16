@extends('layouts.app')

@section('content')
<div id="stationMessage" style="position: fixed; top: 20px; right: 20px; z-index: 1050; display: none;">
    <div class="alert" role="alert"></div>
</div>
<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <h4 class="font-weight-bold">Stations</h4>
        <a href="{{ route('stations.create') }}" class="btn btn-success">
            + Create Station
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>Station Name</th>
                        <th>Station Title</th>
                        <th>MCQ Duration</th>
                        <th>Created</th>
                        <th class="text-center">Actions</th> <!-- New column for Edit/Delete buttons -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($stations as $station)
                        <tr id="station-{{ $station->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td class="station-title">{{ $station->title }}</td>
                            <td class="station-question">{{ Str::limit($station->practical_question, 50) }}</td>
                            <td class="station-duration">{{ $station->duration }}</td>
                            <td>{{ $station->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <!-- Edit Button triggers modal -->
                                <button class="btn btn-sm btn-primary edit-station-btn" 
                                        data-id="{{ $station->id }}" 
                                        data-title="{{ $station->title }}" 
                                        data-question="{{ $station->practical_question }}"
                                         data-duration="{{ $station->duration }}">
                                    <i class="mdi mdi-pencil"></i> Edit
                                </button>

                                <button class="btn btn-sm btn-danger delete-station-btn" 
                                        data-id="{{ $station->id }}" 
                                        data-toggle="modal" 
                                        data-target="#deleteStationModal">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                No stations created yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>


            </table>

        </div>
    </div>

</div>

<!-- Edit Station Modal -->
<div class="modal fade" id="editStationModal" tabindex="-1" role="dialog" aria-labelledby="editStationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="editStationForm">
      @csrf
      @method('PUT')
      <input type="hidden" name="station_id" id="editStationId">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editStationModalLabel">Edit Station</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title" id="editStationTitle" required>
          </div>
          <div class="form-group">
            <label>Practical Question</label>
            <textarea class="form-control" name="practical_question" id="editStationQuestion" rows="4" required></textarea>
          </div>
          <div class="form-group">
            <label>MCQ Duration</label>
            <input type="number" class="form-control" name="duration" id="editStationDuration" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save Changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Delete Station Modal -->
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteStationModal" tabindex="-1" aria-labelledby="deleteStationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteStationModalLabel">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this station?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
      </div>
    </div>
  </div>
</div>




<script src="{{ asset('student/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('student/js/bootstrap.bundle.min.js') }}"></script>
<script>
$(document).ready(function(){

    // Function to show a message
    function showMessage(message, type = 'success') {
        let container = $('#stationMessage');
        let alertBox = container.find('.alert');

        alertBox.removeClass('alert-success alert-danger').addClass('alert-' + type).text(message);
        container.fadeIn();

        // Auto hide after 3 seconds
        setTimeout(function(){
            container.fadeOut();
        }, 3000);
        console.log(`[showMessage] ${type.toUpperCase()}: ${message}`);
    }

    // Edit modal
    $('.edit-station-btn').click(function(){
        let id = $(this).data('id');
        let title = $(this).data('title');
        let question = $(this).data('question');
        let duration = $(this).data('duration');
        console.log('[Edit Click] Station ID:', id, 'Title:', title);

        $('#editStationId').val(id);
        $('#editStationTitle').val(title);
        $('#editStationQuestion').val(question);
        $('#editStationDuration').val(duration);

        $('#editStationModal').modal('show');
    });

    // Handle Edit form submission via AJAX
    $('#editStationForm').submit(function(e){
        e.preventDefault();
        let id = $('#editStationId').val();
        let formData = $(this).serialize();
         console.log('[AJAX Edit] Sending data:', formData);

        $.ajax({
            url: '/osce/stations/' + id,
            type: 'POST',
            data: formData,
            success: function(res){
                console.log('[AJAX Edit Success] Response:', res);
                $('#editStationModal').modal('hide');

                // Update table row dynamically
                let row = $('#station-' + res.id);

                row.find('.station-title').text(res.title);
                row.find('.station-question').text(res.practical_question.substring(0,50));
                row.find('.station-duration').text(res.duration); // Update duration

                // Update the edit button attributes for next modal open
                let editBtn = row.find('.edit-station-btn');
                editBtn.data('title', res.title);
                editBtn.data('question', res.practical_question);
                editBtn.data('duration', res.duration);

                showMessage('Station updated successfully!', 'success');
            },
            error: function(err){
                 console.error('[AJAX Edit Error]', err);
                showMessage('Error updating station.', 'danger');
            }
        });
    });

    // AJAX delete
       let stationIdToDelete = null;

// When table delete button is clicked
$('.delete-station-btn').click(function(){
    stationIdToDelete = $(this).data('id'); // store the ID
    $('#deleteStationModal').modal('show');  // show modal
});

// When modal confirm button is clicked
$('#confirmDeleteBtn').click(function(){
    if(!stationIdToDelete) return;

    $.ajax({
        url: '/osce/stations/' + stationIdToDelete,
        type: 'POST', // Laravel DELETE requires POST with _method
        data: {
            _method: 'DELETE',
            _token: '{{ csrf_token() }}'
        },
        success: function(res){
            $('#station-' + stationIdToDelete).remove(); // remove row
            $('#deleteStationModal').modal('hide');      // hide modal
            stationIdToDelete = null;                     // reset
            showMessage('Station deleted successfully!', 'success');
            location.reload()
        },
        error: function(err){
            showMessage('Error deleting station.', 'danger');
        }
    });
});
});
</script>
@endsection
