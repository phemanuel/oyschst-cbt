@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h3 class="fw-bold mb-4">All Stations & MCQs</h3>

    <div id="mcqMessage" style="display:none;">
        <div class="alert"></div>
    </div>

    @forelse($stations as $station)
        <div class="card mb-4 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <!-- Station title -->
                <div>
                    <h5 class="mb-0">{{ $station->title }} - {{ $station->practical_question }}</h5>
                </div>

                <!-- Right side: Add button + MCQ count -->
                <div class="d-flex align-items-center">
                    <span class="badge badge-dark mr-2">
                        MCQ Duration:
                        {{ $station->duration }} mins
                    </span>
                    <span class="badge badge-info mr-2">
                        {{ $station->mcqQuestions->count() }} MCQ Questions{{ $station->mcqQuestions->count() !== 1 ? 's' : '' }}
                    </span>
                    <span class="badge badge-primary mr-2">
                        Total MCQ Marks:
                        {{ $station->mcqQuestions->sum('mark') }}
                    </span>

                    <button class="btn btn-success btn-sm add-mcq-btn" 
                            data-station-id="{{ $station->id }}"
                            data-station-title="{{ $station->title }}"
                             data-practical-question="{{ $station->practical_question }}">
                        Add MCQ
                    </button>
                </div>
            </div>

            {{-- Scrollable Table --}}
            <div class="card-body p-0" style="max-height: 250px; overflow-y: auto;">
                <table class="table table-hover mb-0">
                    <thead class="bg-light sticky-top">
                        <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>Mark</th>
                            <th>Options</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($station->mcqQuestions as $mcq)
                            <tr id="mcq-{{ $mcq->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td class="mcq-question">{{ $mcq->question }}</td>
                                <td class="mcq-mark">{{ $mcq->mark }}</td>
                                <td>
                                    <ul class="mb-0">
                                        @foreach($mcq->options as $option)
                                            <li>
                                                {{ $option->option_text }} @if($option->is_correct) <strong>(Correct)</strong> @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary edit-mcq-btn" 
                                            data-id="{{ $mcq->id }}"
                                            data-question="{{ $mcq->question }}"
                                            data-mark="{{ $mcq->mark }}"
                                            data-duration="{{ $mcq->duration }}"
                                            data-options='@json($mcq->options)'>
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-mcq-btn" 
                                            data-id="{{ $mcq->id }}"
                                            data-toggle="modal" 
                                            data-target="#deleteMCQModal">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No MCQs added yet.</td>
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

{{-- ADD MCQ MODAL --}}
<!-- Add MCQ Modal -->
<div class="modal fade" id="addMCQModal" tabindex="-1" role="dialog" aria-labelledby="addMCQModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form id="addMCQForm" action="{{ route('mcqs.store') }}" method="POST">
      @csrf
      <input type="hidden" name="station_id" id="addStationId">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add MCQ for <span id="addStationTitle">(<span id="addPracticalQuestion">)</span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Question</label>
            <input type="text" name="question" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Mark</label>
            <select  name="mark" class="form-control" required>
                            <option value="0.25">0.25</option>
                            <option value="0.5">0.5</option>
                            <option value="1.0">1.0</option>
                            <option value="1.5">1.5</option>
                        </select>
          </div>
           <!-- <div class="form-group">
            <label>Duration(Mins)</label>
            <input type="number" name="duration" class="form-control" required>
          </div> -->
          <div class="form-group">
            <label>Options</label>
            <div id="addOptionsWrapper"></div>
            <button type="button" id="addOptionBtn" class="btn btn-sm btn-secondary mt-2">Add Option</button>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save MCQ</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>


{{-- EDIT MCQ MODAL --}}
<!-- EDIT MCQ MODAL -->
<div class="modal fade" id="editMCQModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <form id="editMCQForm">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit MCQ</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <!-- Question -->
                    <div class="form-group">
                        <label>Question</label>
                        <textarea id="editQuestion" name="question" class="form-control" required></textarea>
                    </div>

                    <!-- Mark -->
                    <div class="form-group">
                        <label>Mark</label>
                        <select id="editMark" name="mark" class="form-control" required>
                            <option value="0.25">0.25</option>
                            <option value="0.50">0.50</option>
                            <option value="1.00">1.00</option>
                            <option value="1.50">1.50</option>
                        </select>
                    </div>

                    <!-- <div class="form-group">
                        <label>Duration(Mins)</label>
                        <input type="number" id="editDuration" name="duration" class="form-control" required>
                    </div> -->

                    <!-- Options -->
                    <hr>
                    <h6>Options</h6>

                    <div id="editOptionsWrapper"></div>

                    <button type="button" class="btn btn-sm btn-secondary mt-2" id="editAddOptionBtn">
                        Add Option
                    </button>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update MCQ</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>

            </form>

        </div>
    </div>
</div>



{{-- DELETE MCQ MODAL --}}
<div class="modal fade" id="deleteMCQModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="deleteMCQForm" method="POST">
      @csrf
      @method('DELETE')
      <input type="hidden" name="mcq_id" id="deleteMCQId">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete MCQ</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this MCQ?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Delete</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- ALERT MESSAGE --}}
<div id="mcqMessage" style="display:none;">
    <div class="alert"></div>
</div>


<script src="{{ asset('student/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('student/js/bootstrap.bundle.min.js') }}"></script>
<script>
$(document).ready(function(){

    var mcqMessage = $('#mcqMessage');
    var mcqAlert = mcqMessage.find('.alert');

    function showMessage(type, message){
        mcqAlert.attr('class','alert alert-'+type).text(message);
        mcqMessage.show();
        setTimeout(function(){ mcqMessage.hide(); }, 4000);
    }

    // ---------------- ADD MCQ ----------------
    var addOptionIndex = 1;

    $('.add-mcq-btn').click(function(){
        var stationId = $(this).data('station-id');
        var stationTitle = $(this).data('station-title');

        $('#addStationId').val(stationId);
        $('#addStationTitle').text(stationTitle);

        // Reset options
        $('#addOptionsWrapper').html(`
            <div class="option-item d-flex mb-2">
                <input type="text" name="options[0][option_text]" class="form-control mr-2" placeholder="Option text" required>
                <label class="form-check-label mr-2">
                    Correct <input type="checkbox" name="options[0][is_correct]" value="1" class="correct-checkbox">
                </label>
                <button type="button" class="btn btn-danger btn-sm remove-option-btn">Remove</button>
            </div>
        `);
        addOptionIndex = 1;

        $('#addMCQModal').modal('show');
    });

    // Add new option
    $('#addOptionBtn').click(function(){
        var html = `
        <div class="option-item d-flex mb-2">
            <input type="text" name="options[${addOptionIndex}][option_text]" class="form-control mr-2" placeholder="Option text" required>
            <label class="form-check-label mr-2">
                Correct <input type="checkbox" name="options[${addOptionIndex}][is_correct]" value="1" class="correct-checkbox">
            </label>
            <button type="button" class="btn btn-danger btn-sm remove-option-btn">Remove</button>
        </div>`;
        $('#addOptionsWrapper').append(html);
        addOptionIndex++;
    });

    // Remove option
    $(document).on('click','.remove-option-btn',function(){
        $(this).closest('.option-item').remove();
    });

    // Enforce single correct checkbox for Add & Edit
    $(document).on('change', '.correct-checkbox', function(){
        if(this.checked){
            // Uncheck all other checkboxes in the same wrapper
            $(this).closest('#addOptionsWrapper, #editOptionsWrapper')
                   .find('.correct-checkbox').not(this).prop('checked', false);
        }
    });

    // Submit Add MCQ form
    $('#addMCQForm').submit(function(e){
        e.preventDefault();
        var form = $(this);

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(res){
                showMessage('success', res.success);
                $('#addMCQModal').modal('hide');
                form[0].reset();
                setTimeout(function(){ location.reload(); }, 1000);
            },
            error: function(xhr){
                var err = 'Error occurred.';
                if(xhr.responseJSON && xhr.responseJSON.errors){
                    err = Object.values(xhr.responseJSON.errors).map(v=>v.join(', ')).join(' | ');
                }
                showMessage('danger', err);
            }
        });
    });

    // ---------------- EDIT MCQ ----------------
var editOptionIndex = 0;

$('.edit-mcq-btn').click(function(){

    var mcqId = $(this).data('id');
    var question = $(this).data('question');
    var mark = $(this).data('mark');
    // var duration = $(this).data('duration');
    var options = $(this).data('options');

    $('#editMCQForm').attr('action','/osce/mcqs/'+mcqId);
    $('#editQuestion').val(question);
    // $('#editDuration').val(duration);

    // Ensure select value matches exactly
    $('#editMark').val(parseFloat(mark).toFixed(2));

    // Reset options
    $('#editOptionsWrapper').empty();
    editOptionIndex = 0;

    options.forEach(function(opt,i){

        var html = `
        <div class="option-item d-flex align-items-center mb-2">

            <input type="hidden" name="options[${i}][id]" value="${opt.id}">

            <input type="text"
                   name="options[${i}][option_text]"
                   class="form-control mr-2"
                   value="${opt.option_text}"
                   required>

            <label class="form-check-label mr-2">
                Correct
                <input type="checkbox"
                       name="options[${i}][is_correct]"
                       value="1"
                       class="correct-checkbox"
                       ${opt.is_correct ? 'checked' : ''}>
            </label>

            <button type="button"
                    class="btn btn-danger btn-sm remove-option-btn">
                Remove
            </button>

        </div>`;

        $('#editOptionsWrapper').append(html);
        editOptionIndex++;
    });

    $('#editMCQModal').modal('show');
});


// ---------------- ENFORCE SINGLE CORRECT ----------------
$(document).on('change', '.correct-checkbox', function () {

    if ($(this).is(':checked')) {
        // Uncheck every other checkbox inside edit wrapper ONLY
        $('#editOptionsWrapper .correct-checkbox')
            .not(this)
            .prop('checked', false);
    }

});


// ---------------- ADD NEW OPTION ----------------
$('#editAddOptionBtn').click(function(){

    var html = `
    <div class="option-item d-flex align-items-center mb-2">

        <input type="text"
               name="options[new_${editOptionIndex}][option_text]"
               class="form-control mr-2"
               placeholder="Option text"
               required>

        <label class="form-check-label mr-2">
            Correct
            <input type="checkbox"
                   name="options[new_${editOptionIndex}][is_correct]"
                   value="1"
                   class="correct-checkbox">
        </label>

        <button type="button"
                class="btn btn-danger btn-sm remove-option-btn">
            Remove
        </button>

    </div>`;

    $('#editOptionsWrapper').append(html);
    editOptionIndex++;
});


// ---------------- REMOVE OPTION ----------------
$(document).on('click','.remove-option-btn', function(){
    $(this).closest('.option-item').remove();
});


// ---------------- SUBMIT EDIT ----------------
$('#editMCQForm').submit(function(e){

    e.preventDefault();
    var form = $(this);

    $.ajax({
        url: form.attr('action'),
        method: 'POST',
        data: form.serialize(),

        success: function(res){
            showMessage('success', res.success);
            $('#editMCQModal').modal('hide');
            setTimeout(function(){ location.reload(); }, 800);
        },

        error: function(xhr){
            var err = 'Error occurred.';

            if(xhr.responseJSON && xhr.responseJSON.errors){
                err = Object.values(xhr.responseJSON.errors)
                            .map(v => v.join(', '))
                            .join(' | ');
            }

            showMessage('danger', err);
        }
    });

});

    // ---------------- DELETE MCQ ----------------
    $('.delete-mcq-btn').click(function(){
        var mcqId = $(this).data('id');
        $('#deleteMCQForm').attr('action','/osce/mcqs/'+mcqId);
        $('#deleteMCQModal').modal('show');
    });

    $('#deleteMCQForm').submit(function(e){
        e.preventDefault();
        var form = $(this);

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(res){
                showMessage('success', res.success);
                $('#deleteMCQModal').modal('hide');
                setTimeout(function(){ location.reload(); }, 1000);
            },
            error: function(xhr){

                if(xhr.responseJSON && xhr.responseJSON.error){
                    showMessage('danger', xhr.responseJSON.error);
                }else{
                    showMessage('danger','Delete failed.');
                }

            }
        });
    });

});


</script>