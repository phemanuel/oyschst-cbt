@extends('layouts.app2')

@section('content')
<div class="container">
    <h3>{{ $station->title }}</h3>
    <p>{{ $station->practical_question }}</p>
    <div class="float-right">
        Time Left: <span id="timer">{{ gmdate('i:s', $stationResult->mcq_time_left) }}</span>
    </div>

    <div id="mcq-container">
        @foreach($questions as $index => $question)
        <div class="mcq-question" data-index="{{ $index }}" style="{{ $index === 0 ? '' : 'display:none;' }}">
            <h5>Q{{ $index+1 }}: {{ $question->question }}</h5>
            <ul class="list-group">
                @foreach($question->options as $option)
                    <li class="list-group-item">
                        <input type="radio" name="question_{{ $question->id }}" value="{{ $option->id }}"
                        class="mcq-option"
                        {{ isset($answers[$question->id]) && $answers[$question->id] == $option->id ? 'checked' : '' }}>
                        {{ $option->option_text }}
                    </li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>

    <div class="mt-3">
        <button id="prevBtn" class="btn btn-secondary">Previous</button>
        <button id="nextBtn" class="btn btn-primary">Next</button>
        <button id="submitBtn" class="btn btn-success">Submit</button>
    </div>

    <div class="mt-3">
        <strong>Question Navigation:</strong>
        <div id="questionNav">
            @foreach($questions as $index => $question)
                <button class="btn btn-sm btn-outline-secondary q-nav-btn {{ isset($answers[$question->id]) ? 'btn-success' : '' }}" data-index="{{ $index }}">
                    {{ $index+1 }}
                </button>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){

    let currentIndex = 0;
    let totalQuestions = {{ count($questions) }};
    let timer = {{ $stationResult->mcq_time_left }}; // seconds

    // Timer countdown
    let timerInterval = setInterval(function(){
        if(timer <= 0){
            clearInterval(timerInterval);
            alert('Time is up!');
            submitExam();
        } else {
            timer--;
            $('#timer').text(new Date(timer * 1000).toISOString().substr(14,5));
            saveTime();
        }
    }, 1000);

    function saveTime(){
        $.post("{{ route('student.save.time', $station) }}", { time_left: timer, _token: "{{ csrf_token() }}" });
    }

    function showQuestion(index){
        $('.mcq-question').hide();
        $('.mcq-question[data-index="'+index+'"]').show();
    }

    $('#nextBtn').click(function(){
        if(currentIndex < totalQuestions-1){
            currentIndex++;
            showQuestion(currentIndex);
        }
    });

    $('#prevBtn').click(function(){
        if(currentIndex > 0){
            currentIndex--;
            showQuestion(currentIndex);
        }
    });

    $('.mcq-option').change(function(){
        let mcq_id = $(this).attr('name').split('_')[1];
        let option_id = $(this).val();

        $.post("{{ route('student.save.answer') }}", {
            mcq_id: mcq_id,
            option_id: option_id,
            _token: "{{ csrf_token() }}"
        }, function(res){
            if(res.success){
                // Tick nav button
                $('.q-nav-btn[data-index="'+currentIndex+'"]').removeClass('btn-outline-secondary').addClass('btn-success');
            }
        });
    });

    $('.q-nav-btn').click(function(){
        let idx = $(this).data('index');
        currentIndex = idx;
        showQuestion(idx);
    });

    function submitExam(){
        clearInterval(timerInterval);
        $('#submitBtn').prop('disabled', true);
        $.post("{{ route('student.station.submit', $station) }}", {_token: "{{ csrf_token() }}"}, function(res){
            alert('Station submitted!');
            window.location.href = "{{ route('student.dashboard') }}";
        });
    }

    $('#submitBtn').click(function(){
        if(confirm('Are you sure you want to submit this station?')){
            submitExam();
        }
    });

});
</script>
@endsection
