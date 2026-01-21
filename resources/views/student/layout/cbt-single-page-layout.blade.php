<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/melody/template/pages/layout/horizontal-menu.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:05:55 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('pageTitle')</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('student/vendors/iconfonts/font-awesome/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('student/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('student/vendors/css/vendor.bundle.addons.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('student/css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('favicon.png')}}" />
  <style>
    .bold-text {
    font-size: 18px;
    font-weight: bold;
    color: white;
}

.bold-text-min {
    font-size: 14px;
    font-weight: bold;
    color: white;
}

    .bold-text-font {
    font-size: 15px;
    font-weight: bold;  
    color: white;  
}

.bold-text-font-menu {
    font-size: 16px;
    font-weight: bold;  
    color: black;  
    /* background-color: #663300; */
}

    .bold-font {
    font-size: 20px;
    font-weight: bold;
}

.bold-font-qst {
    font-size: 24px;
    /* font-weight: bold; */
}

.bold-font-ans {
    font-size: 16px;
    font-weight: bold;
    color: blue;
}

.bold-font-text {
    font-size: 16px;
    font-weight: bold;
    color: black;
}
  </style>
  	<style>
    /* Success Alert */
    .alert.alert-success {
        background-color: #28a745; /* Green background color */
        color: #fff; /* White text color */
        padding: 10px; /* Padding around the text */
        border-radius: 5px; /* Rounded corners */
    }

    /* Error Alert */
    .alert.alert-danger {
        background-color: #dc3545; /* Red background color */
        color: #fff; /* White text color */
        padding: 10px; /* Padding around the text */
        border-radius: 5px; /* Rounded corners */
    }
</style>
<style>
    .options-row {
        display: flex;
        align-items: center; /* Align radio button and text vertically */
        padding: 12px 0; /* Add spacing between rows */
    }

    .options-row span {
        font-weight: bold;
        font-size: 25px; /* Increase font size for (A)-(D) */
        margin-right: 15px; /* Space between (A)-(D) and the radio button */
    }

    .options-row input[type="radio"] {
        width: 20px; /* Increase the size of the radio button */
        height: 20px;
        margin-right: 15px; /* Space between radio button and the answer text */
    }

    .options-row label {
        font-size: 18px; /* Increase the font size of the answer text */
    }

    .options-container {
        width: 100%; /* Full width for the table */
        margin: 0 auto; /* Center the table within its parent */
    }

    .options-container td {
        padding: 8px 0; /* Add padding for better spacing */
    }
    
</style>
<style>
    .options-container {
        width: 100%;
    }
    .options-row td {
        padding: 10px 0;
    }
    .question-btn {
        margin-right: 8px; /* Space between buttons */
        margin-bottom: 8px; /* Space between rows */
    }
    .question-btn.attempted {
        background-color: #28a745; /* Green for attempted */
        color: #fff;
    }
    .question-btn.active {
        background-color: #ffc107; /* Yellow for active */
        color: #000;
    }

    </style>
    <style>
        .question-btn {
    position: relative;
    padding-right: 30px; /* Adjust padding for icon */
}

.tick-icon {
    position: absolute;
    top: 5px;
    right: 5px;
    font-size: 16px;
    color: white;
    display: none; /* Hidden by default */
}

.question-btn.attempted .tick-icon {
    display: inline-block; /* Show the tick icon when the question is attempted */
}

.question-btn.attempted {
    background-color: #4CAF50; /* Green for attempted */
    color: white;
}

    </style>
    <script>
window.MathJax = {
    tex: {
        inlineMath: [['$', '$'], ['\\(', '\\)']]
    },
    svg: { fontCache: 'global' }
};
</script>
<script src="{{ asset('js/mathjax/tex-mml-chtml.js') }}"></script>
   <!-- <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script> -->
</head>
<body class="sidebar-fixed">
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a  href="#"><img src="{{asset($collegeSetup->avatar)}}" alt="logo" width="50" height="50"/></a>
        <!-- <a  href="#"><img src="{{asset($collegeSetup->avatar)}}" alt="logo" width="50" height="50"/></a> -->
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="fas fa-bars"></span>
        </button>
      <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item d-none d-lg-flex">
            <a class="nav-link" href="#">            
              <span class="btn btn-primary"><strong><p class="bold-text-min">Time Left</p> <p><span class="bold-text-min" id="timer"></span> </p></strong></span>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav">        
          <li class="nav-item nav-search d-none d-md-flex">
          <strong><p class="bold-text-font">Student No: {{$studentData->admission_no}}</p></strong>
          </li>
          <li class="nav-item nav-search d-none d-md-flex">
          <strong><p class="bold-text-font">Student Name: {{ $studentData->surname }} {{ $studentData->first_name }} {{ $studentData->other_name }}</p></strong>
          </li>
          <li class="nav-item nav-search d-none d-md-flex">
          <strong><p class="bold-text-font">Programme: {{ $studentData->department}} </p></strong>
          </li>
          <li class="nav-item nav-search d-none d-md-flex">
          <strong><p class="bold-text-font">Level: {{ $studentData->level}} </p></strong>
          </li>
          <li class="nav-item nav-search d-none d-md-flex">
          <strong><p class="bold-text-font">{{ $examSetting->no_of_qst}} Questions </p></strong>
          </li>
          <li class="nav-item nav-search d-none d-md-flex">
          <strong><p class="bold-text-font">{{ $examSetting->duration}} Mins </p></strong>
          </li>
          <li class="nav-item nav-search d-none d-md-flex">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal-2">
                    Submit Test</button>
          </li>
        </ul>
        
        
      </div>
      
    </nav>
    <!-- partial -->
    
    <div class="container-fluid page-body-wrapper">      
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
           
          </li>
        <hr>
        <li class="nav-item">
              <span class="bold-text-font-menu">&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                Exam Details&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;</span>           
          </li>
          <hr>
          <table class="table">
            <tr>
                <td><p class="bold-text-font-menu">Academic Session:</p></td>
                <td><p class="bold-text-font-menu">{{$examSetting->session1}}</p></td>
            </tr>
            <tr>
            <td><p class="bold-text-font-menu">Exam Type:</p></td>
                <td><p class="bold-text-font-menu">{{$examSetting->exam_type}}</p></td>
            </tr>            
            <tr>
                <td><p class="bold-text-font-menu">Semester:</p></td>
                <td><p class="bold-text-font-menu">{{$examSetting->semester}}</p></td>
            </tr>
            <tr>
                <td><p class="bold-text-font-menu">Course:</p></td>
                <td><p class="bold-text-font-menu">{{$examSetting->course}}</p></td>
            </tr>
            <!-- @if($examSetting->exam_category == 'SEMESTER-EXAM')
            <tr>
                <td><p class="bold-text-font-menu">Semester:</p></td>
                <td><p class="bold-text-font-menu">{{$examSetting->session1}}</p></td>
            </tr>
            <tr>
                <td><p class="bold-text-font-menu">Course:</p></td>
                <td><p class="bold-text-font-menu">{{$examSetting->course}}</p></td>
            </tr>
            @else

            @endif -->
            
          </table>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
           
            <table class="table">
                <tr>
                    <td> <h3 class="page-title">Computer Based Test - Read questions carefully and answer appropriately.</h3></td>
                    <!-- <td> <button type="button" name="{{$pageNo}}" id="{{$pageNo}}"  class="btn btn-info">Load Answers</button></td> -->
                </tr>
            </table>            
          </div>          
          <div>
          @if(session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
          @elseif(session('error'))
						<div class="alert alert-danger">
							{{ session('error') }}
						</div>
						@endif	
          </div>
          <!-- question-Loaded -->
          <div class="row">         
          <div id="questions-container">
    <!-- This will be populated with questions dynamically -->   

</div>

<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
        <form action="" class="answer-form" data-question-number="1">
            <!-- Buttons for each question -->
            <div id="question-buttons" class="d-flex flex-wrap gap-2 mb-4" data-admission-no="{{ $studentData->admission_no }}">
                @for ($i = 1; $i <= $examSetting->no_of_qst; $i++)
                    <button 
                        type="button" 
                        class="btn btn-primary question-btn {{ $i === 1 ? 'active' : '' }}" 
                        data-question-number="{{ $i }}">
                        <span class="question-number">{{ $i }}</span>
                        <!-- Tick icon overlay (initially hidden) -->
                        <i class="fa fa-check tick-icon"></i>
                    </button>
                @endfor
            </div>
        <hr>
        <h4 class="card-title">
            <strong>Question <span id="current-question-number">1</span> of {{$examSetting->no_of_qst}}</strong>
        </h4>     
            
        <div class="question-container">    
            <div id="current-question"></div> <!-- This is where the question content will be inserted -->
        </div>

        <table class="options-container">
            <tr class="options-row">
                <td>
                    <input type="radio" name="option" id="option_a" value="A" />
                    <label for="option_a"></label>
                </td>
            </tr>
            <tr class="options-row">
                <td>
                    <input type="radio" name="option" id="option_b" value="B" />
                    <label for="option_b"></label>
                </td>
            </tr>
            <tr class="options-row">
                <td>
                    <input type="radio" name="option" id="option_c" value="C" />
                    <label for="option_c"></label>
                </td>
            </tr>
            <tr class="options-row">
                <td>
                    <input type="radio" name="option" id="option_d" value="D" />
                    <label for="option_d"></label>
                </td>
            </tr>
        </table>
    
    </form>
        
        </div>                
    </div>
</div>

<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <input type="hidden" id="hidden-currentQuestionNo" value="{{$currentQuestionNo}}">
            <div class="d-flex justify-content-between">
                <button id="prev-button" class="btn btn-success">Previous Question</button>
                <button id="next-button" class="btn btn-info">Next Question</button>
            </div>
        </div>
    </div>
</div>

</div>

          
          <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-2">Submit Computer Based Test</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure you want to submit.</p>
                        </div>
                        <div class="modal-footer">
                          <a href="{{route('cbt-submit', ['id' => $studentData->id])}}"  class="btn btn-success">Yes</a>
                          <button type="button" class="btn btn-light" data-dismiss="modal">No</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Ends -->

                  </div>
    
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 - <?php echo date('Y') ; ?> <a href="{{$collegeSetup->web_url}}" target="_blank">{{$collegeSetup->name}}</a>. </span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Version : {{$softwareVersion->version}} </span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- Time counter -->
  <script>
     "use strict";
        let duration = {{ $studentMin }}; // Duration in seconds
        let remainingTime = duration;

        function startTimer() {
            const interval = setInterval(() => {
                if (remainingTime > 0) {
                    remainingTime--;
                    if (remainingTime % 60 === 0) {
                        saveRemainingTime(Math.floor(remainingTime));
                    }
                    updateTimerDisplay(remainingTime);
                } else {
                    clearInterval(interval);
                    alert("Time is up!");
                    // Redirect the user after the alert is dismissed
                    window.location.href = "{{ route('cbt-submit', ['id' => $studentData->id]) }}";
                }
            }, 1000);
        }

        function saveRemainingTime(remainingMinutes) {
            fetch('/update-remaining-time/{{ $studentData->id }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ remaining_time: remainingMinutes })
            }).then(response => response.json())
              .then(data => {
                  if (!data.success) {
                      console.error('Failed to save remaining time');
                  }
              });
        }

        function updateTimerDisplay(remainingTime) {
            const minutes = Math.floor(remainingTime / 60);
            const seconds = remainingTime % 60;
            document.getElementById('timer').textContent = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
        }

        startTimer();
    </script>

<script src="{{asset('student/js/jquery-3.6.0.min.js')}}"></script>

<!-- Question rendering -->
<!-- <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async
        src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js">
</script> -->

<!-- <script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.question-btn');
    const currentQuestionNumberEl = document.getElementById('current-question-number');
    const currentQuestionEl = document.getElementById('current-question');
    const optionLabels = {
        A: document.querySelector('label[for="option_a"]'),
        B: document.querySelector('label[for="option_b"]'),
        C: document.querySelector('label[for="option_c"]'),
        D: document.querySelector('label[for="option_d"]'),
    };
    const optionInputs = {
        A: document.getElementById('option_a'),
        B: document.getElementById('option_b'),
        C: document.getElementById('option_c'),
        D: document.getElementById('option_d'),
    };

    const admissionNo = document.getElementById('question-buttons').dataset.admissionNo;
    const attemptedQuestions = new Set();

    const clearQuestion = () => {
        currentQuestionEl.innerHTML = '';
        Object.values(optionLabels).forEach(label => label.innerHTML = '');
        Object.values(optionInputs).forEach(input => input.checked = false);
    };

    const renderMath = () => {
        if (window.MathJax) {
            MathJax.typesetPromise();
        }
    };

    const loadQuestion = (questionNumber) => {
        clearQuestion();

        fetch(`/get-question/${questionNumber}?admission_no=${admissionNo}`)
            .then(response => response.json())
            .then(data => {
                currentQuestionNumberEl.textContent = questionNumber;

                // Insert question and options
                currentQuestionEl.innerHTML = data.question;
                optionLabels.A.innerHTML = data.option_a;
                optionLabels.B.innerHTML = data.option_b;
                optionLabels.C.innerHTML = data.option_c;
                optionLabels.D.innerHTML = data.option_d;

                // Render LaTeX in question and options
                renderMath();

                const answerSelected = data.answerSelected;
                if (answerSelected) {
                    optionInputs[answerSelected].checked = true;
                }

                if (answerSelected !== null) {
                    attemptedQuestions.add(questionNumber);
                    const activeButton = document.querySelector(`.question-btn[data-question-number="${questionNumber}"]`);
                    if (activeButton) activeButton.classList.add('attempted');
                }

                buttons.forEach(btn => btn.classList.remove('active'));
                const activeButton = document.querySelector(`.question-btn[data-question-number="${questionNumber}"]`);
                if (activeButton) activeButton.classList.add('active');
            })
            .catch(error => {
                console.error('Error fetching question:', error);
                currentQuestionEl.innerHTML = 'Failed to load question. Please try again later.';
            });
    };

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const questionNumber = this.getAttribute('data-question-number');
            loadQuestion(questionNumber);
        });
    });

    Object.values(optionInputs).forEach(input => {
        input.addEventListener('change', function () {
            const selectedOption = this.value;
            const questionNumber = currentQuestionNumberEl.textContent;

            fetch('/save-single-answer', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    question_number: questionNumber,
                    selected_option: selectedOption,
                    admission_no: admissionNo
                })
            })
            .then(response => response.json())
            .then(data => {
                attemptedQuestions.add(questionNumber);
                const activeButton = document.querySelector(`.question-btn[data-question-number="${questionNumber}"]`);
                if (activeButton) activeButton.classList.add('attempted');
            })
            .catch(error => console.error('Error saving option:', error));
        });
    });

    const firstQuestionNumber = buttons[0].getAttribute('data-question-number');
    loadQuestion(firstQuestionNumber);
});
</script> -->

<!-- Question Rendering -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.question-btn');
    const currentQuestionNumberEl = document.getElementById('current-question-number');
    const currentQuestionEl = document.getElementById('current-question');

    const optionLabels = {
        A: document.querySelector('label[for="option_a"]'),
        B: document.querySelector('label[for="option_b"]'),
        C: document.querySelector('label[for="option_c"]'),
        D: document.querySelector('label[for="option_d"]'),
    };

    const optionInputs = {
        A: document.getElementById('option_a'),
        B: document.getElementById('option_b'),
        C: document.getElementById('option_c'),
        D: document.getElementById('option_d'),
    };

    const admissionNo = document.getElementById('question-buttons').dataset.admissionNo;

    // Keep track of attempted questions
    const attemptedQuestions = new Set();

    // Clear current question and options
    const clearQuestion = () => {
        currentQuestionEl.innerHTML = '';
        Object.values(optionLabels).forEach(label => label.innerHTML = '');
        Object.values(optionInputs).forEach(input => input.checked = false);
    };

    // Load a question by number
    const loadQuestion = (questionNumber) => {
        clearQuestion();

        fetch(`/get-question/${questionNumber}?admission_no=${admissionNo}`)
            .then(response => response.json())
            .then(data => {
                currentQuestionNumberEl.textContent = questionNumber;

                // Insert question and options
                currentQuestionEl.innerHTML = data.question;
                optionLabels.A.innerHTML = data.option_a;
                optionLabels.B.innerHTML = data.option_b;
                optionLabels.C.innerHTML = data.option_c;
                optionLabels.D.innerHTML = data.option_d;

                // Render LaTeX using MathJax
                if (window.MathJax) {
                    MathJax.typesetPromise([
                        currentQuestionEl,
                        optionLabels.A,
                        optionLabels.B,
                        optionLabels.C,
                        optionLabels.D
                    ]).catch(err => console.error('MathJax typeset error:', err.message));
                }

                // Mark previously selected option
                const answerSelected = data.answerSelected;
                if (answerSelected) {
                    optionInputs[answerSelected].checked = true;
                }

                // Mark attempted
                if (answerSelected !== null) {
                    attemptedQuestions.add(questionNumber);
                    const btn = document.querySelector(`.question-btn[data-question-number="${questionNumber}"]`);
                    if (btn) btn.classList.add('attempted');
                }

                // Highlight active button
                buttons.forEach(btn => btn.classList.remove('active'));
                const activeBtn = document.querySelector(`.question-btn[data-question-number="${questionNumber}"]`);
                if (activeBtn) activeBtn.classList.add('active');

                updateNavButtonsState(parseInt(questionNumber));
            })
            .catch(err => {
                console.error('Error fetching question:', err);
                currentQuestionEl.innerHTML = 'Failed to load question. Please try again later.';
            });
    };

    // Save selected answer
    const saveAnswer = (questionNumber, selectedOption) => {
        fetch('/save-single-answer', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                question_number: questionNumber,
                selected_option: selectedOption,
                admission_no: admissionNo
            })
        })
        .then(response => response.json())
        .then(() => {
            attemptedQuestions.add(questionNumber);
            const btn = document.querySelector(`.question-btn[data-question-number="${questionNumber}"]`);
            if (btn) btn.classList.add('attempted');
        })
        .catch(err => console.error('Error saving answer:', err));
    };

    // Handle option selection
    Object.values(optionInputs).forEach(input => {
        input.addEventListener('change', function () {
            const selectedOption = this.value;
            const questionNumber = currentQuestionNumberEl.textContent;
            saveAnswer(questionNumber, selectedOption);
        });
    });

    // Handle question button clicks
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const questionNumber = this.dataset.questionNumber;
            loadQuestion(questionNumber);
        });
    });

    // Previous / Next navigation
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');

    const updateNavButtonsState = (current) => {
        const total = buttons.length;
        prevButton.disabled = current <= 1;
        nextButton.disabled = current >= total;
    };

    prevButton.addEventListener('click', () => {
        const current = parseInt(currentQuestionNumberEl.textContent);
        if (current > 1) loadQuestion(current - 1);
    });

    nextButton.addEventListener('click', () => {
        const current = parseInt(currentQuestionNumberEl.textContent);
        if (current < buttons.length) loadQuestion(current + 1);
    });

    // Load first question on page load
    loadQuestion(buttons[0].dataset.questionNumber);
});
</script>




<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="{{ asset('student/js/jquery-3.5.1.min.js') }}"></script>

        <!-- CK Editor -->
<script src="{{asset('dashboard/bower_components/ckeditor/ckeditor.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('dashboard/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- <script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script> -->
  <!-- plugins:js -->
  <script src="{{asset('student/vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{asset('student/vendors/js/vendor.bundle.addons.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('student/js/off-canvas.js')}}"></script>
  <script src="{{asset('student/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('student/js/misc.js')}}"></script>
  <script src="{{asset('student/js/settings.js')}}"></script>
  <script src="{{asset('student/js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('student/js/dashboard.js')}}"></script>
  <!-- End custom js for this page-->
  <script src="{{asset('student/js/modal-demo.js')}}"></script>
</body>



</html>
