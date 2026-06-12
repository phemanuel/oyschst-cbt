@extends('layouts.app2')

@section('content')
<div class="container mt-4">

    <!-- Station Info Card -->
    <div class="card shadow-lg mb-3 border-primary">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-book-open"></i> {{ $station->title }} - {{ $station->practical_question }}</h4>
            <div id="timerCard" class="p-2 text-center text-white font-weight-bold" 
                 style="font-size:1.2rem; width:150px; border-radius:8px; background-color:green;">
                <i class="fas fa-hourglass-half"></i> Time Left: 
                <span id="timer">{{ gmdate('i:s', $stationResult->mcq_time_left * 60) }}</span>
            </div>
        </div>
        <!-- <div class="card-body">
            <p></p>
        </div> -->
    </div>

    <!-- MCQ Question Card -->
    <div id="mcq-container" class="card shadow mb-3 border-info">
        <div class="card-body">
            @foreach($questions as $index => $question)
            <div class="mcq-question" data-index="{{ $index }}" style="{{ $index === 0 ? '' : 'display:none;' }}">
                <h5><i class="fas fa-question-circle"></i> Q{{ $index+1 }}: {{ $question->question }}</h5>
                <ul class="list-group mt-2">
                    @foreach($question->options as $option)
                        <li class="list-group-item">
                            <input type="radio" 
                                   name="question_{{ $question->id }}" 
                                   value="{{ $option->id }}"
                                   class="mcq-option"
                                   data-station="{{ $station->id }}"
                                   data-mark="{{ $question->mark }}"
                                   {{ isset($answers[$question->id]) && $answers[$question->id] == $option->id ? 'checked' : '' }}>
                            {{ $option->option_text }}
                        </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Navigation Buttons Card -->
    <div class="card shadow mb-3 border-success">
        <div class="card-body d-flex justify-content-between">
            <button id="prevBtn" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Previous
            </button>
            <div>
                <button id="nextBtn" class="btn btn-primary mr-2">
                    Next <i class="fas fa-arrow-right"></i>
                </button>
                <button id="submitBtn" class="btn btn-success">
                    <i class="fas fa-check-circle"></i> Submit
                </button>
            </div>
        </div>
    </div>

    <!-- Question Navigation Card -->
    <div class="card shadow border-warning">
        <div class="card-body">
            <strong>Question Navigation:</strong>
            <div id="questionNav" class="mt-2">
                @foreach($questions as $index => $question)
                    <button type="button" 
                            class="btn btn-sm q-nav-btn {{ isset($answers[$question->id]) ? 'btn-success' : 'btn-outline-secondary' }}" 
                            data-index="{{ $index }}">
                        {{ $index+1 }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

</div>

<!-- Include FontAwesome for Icons -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->


<!-- Submit Confirmation Modal -->
<div class="modal fade" id="confirmSubmitModal" tabindex="-1" role="dialog" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm Submission</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to submit this Station MCQ Test? All your answers will be saved.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-success" id="confirmSubmitBtn">Yes, Submit</button>
      </div>
    </div>
  </div>
</div>

<!-- Congratulatory Modal -->
<div class="modal fade" id="congratsModal" tabindex="-1" role="dialog" aria-labelledby="congratsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content text-center">
      <div class="modal-body">
        <h4 class="text-success font-weight-bold">🎉 Congratulations! 🎉</h4>
        <p>You have successfully completed this Station MCQ Test.</p>
        <button type="button" class="btn btn-primary mt-3" id="exitDashboardBtn">Exit to Dashboard</button>
      </div>
    </div>
  </div>
</div>

@endsection


<script src="{{ asset('student/js/jquery-3.6.0.min.js') }}"></script>
<script>
$(document).ready(function(){

    let currentIndex = 0;
    const totalQuestions = {{ count($questions) }};
    let timer = {{ $stationResult->mcq_time_left }} * 60; // seconds
    const timerCard = $('#timerCard');

    // Save every 5 seconds instead of every second
    const saveInterval = 5;

    // ---------------- Timer ----------------
    const timerInterval = setInterval(function(){
        if(timer <= 0){
            clearInterval(timerInterval);
            submitExam();
        } else {
            timer--;
            const minutes = Math.floor(timer / 60);
            const seconds = timer % 60;
            $('#timer').text(`${minutes.toString().padStart(2,'0')}:${seconds.toString().padStart(2,'0')}`);

            // Save every 5 seconds
            if(timer % saveInterval === 0){
                saveTime();
            }

            updateTimerStyle(timer);
        }
    }, 1000);

    // ---------------- Save remaining time ----------------
    function saveTime(){
        $.ajax({
            url: "/osce/student/station/{{ $station->id }}/save-time",
            type: "POST",
            data: {
                time_left: Math.floor(timer / 60), // floor to store minutes remaining
                _token: "{{ csrf_token() }}"
            },
            success: function(res){
                console.log('Time saved:', res);
            },
            error: function(err){
                console.error('Error saving time', err);
            }
        });
    }

    // ---------------- Timer color ----------------
        function updateTimerStyle(time){
        const total = {{ $stationResult->mcq_time_left }} * 60;
        const percentage = (time / total) * 100;

        // Only remove color classes
        timerCard.removeClass('bg-success bg-warning bg-danger text-dark text-white');

        if(percentage <= 10){
            timerCard.addClass('bg-danger blink text-white'); // blink stays
        } else if(percentage <= 50){
            timerCard.addClass('bg-warning blink text-dark');
            // timerCard.removeClass('blink'); // remove blink if not urgent
        } else {
            timerCard.addClass('bg-success text-white');
            timerCard.removeClass('blink'); // remove blink if not urgent
        }
    }

    // ---------------- Questions Navigation ----------------
    function showQuestion(index){
        $('.mcq-question').hide();
        $('.mcq-question[data-index="'+index+'"]').fadeIn();
        $('#prevBtn').prop('disabled', index === 0);
        $('#nextBtn').prop('disabled', index === totalQuestions - 1);
    }
    showQuestion(currentIndex);

    $('#nextBtn').click(function(){ if(currentIndex < totalQuestions-1){ currentIndex++; showQuestion(currentIndex); } });
    $('#prevBtn').click(function(){ if(currentIndex > 0){ currentIndex--; showQuestion(currentIndex); } });
    $(document).on('click', '.q-nav-btn', function(){
        currentIndex = $(this).data('index');
        showQuestion(currentIndex);
    });

    // ---------------- Save Answer ----------------
    $(document).on('change', '.mcq-option', function(){
        const mcq_id = $(this).attr('name').split('_')[1];
        const option_id = $(this).val();
        const station_id = $(this).data('station');
        const mark = $(this).data('mark');

        $.post("{{ route('student.save.answer') }}", {
            mcq_id: mcq_id,
            option_id: option_id,
            station_id: station_id,
            score: mark,
            _token: "{{ csrf_token() }}"
        }, function(res){
            updateNavButtonStatus();
        });
    });

    function updateNavButtonStatus(){
        $('.q-nav-btn').each(function(){
            const idx = $(this).data('index');
            const answered = $('.mcq-question[data-index="'+idx+'"] input.mcq-option:checked').length > 0;
            $(this).toggleClass('btn-success', answered);
            $(this).toggleClass('btn-outline-secondary', !answered);
        });
    }
    updateNavButtonStatus();

    // ---------------- Submit Exam ----------------
    function submitExam(){
        clearInterval(timerInterval);
        $('#submitBtn').prop('disabled', true);

        $.post("{{ route('student.station.submit', $station) }}", 
        { _token: "{{ csrf_token() }}" }, function(res){
            $('#congratsModal').modal({backdrop:'static', keyboard:false});
        });
    }

    $('#submitBtn').click(function(){ $('#confirmSubmitModal').modal('show'); });
    $('#confirmSubmitBtn').click(function(){ 
        $('#confirmSubmitModal').modal('hide'); 
        submitExam(); 
    });

    $('#exitDashboardBtn').click(function(){
        window.location.href = "{{ route('osce.logout') }}";
    });

    setInterval(function(){
        $('.blink').fadeOut(500).fadeIn(500);
    }, 1000);

});
</script>

<style>
.blink {
    font-weight: bold;
}
</style>

