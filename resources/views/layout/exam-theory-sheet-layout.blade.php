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
        <ul class="navbar-nav">        
          <li class="nav-item nav-search d-none d-md-flex">
          <strong><p class="bold-text-font">Student No: {{$studentData->studentno}}</p></strong>
          </li>
          <li class="nav-item nav-search d-none d-md-flex">
          <strong><p class="bold-text-font">Student Name: {{ $studentData->studentname }} </p></strong>
          </li>
          <li class="nav-item nav-search d-none d-md-flex">
          <strong><p class="bold-text-font">Programme: {{ $studentData->department}} </p></strong>
          </li>
          <li class="nav-item nav-search d-none d-md-flex">
          <strong><p class="bold-text-font">Level: {{ $studentData->level}} </p></strong>
          </li>
          <li class="nav-item nav-search d-none d-md-flex">
          <strong><p class="bold-text-font">{{ $studentData->no_of_qst}} Questions </p></strong>
          </li>          
          <li class="nav-item nav-search d-none d-md-flex">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal-2">
                    Submit Grading Score</button>
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
                <td><p class="bold-text-font-menu">{{$studentData->session1}}</p></td>
            </tr>
            <tr>
            <td><p class="bold-text-font-menu">Exam Type:</p></td>
                <td><p class="bold-text-font-menu">{{$studentData->exam_type}}</p></td>
            </tr>            
            <tr>
                <td><p class="bold-text-font-menu">Semester:</p></td>
                <td><p class="bold-text-font-menu">{{$studentData->semester}}</p></td>
            </tr>
            <tr>
                <td><p class="bold-text-font-menu">Course:</p></td>
                <td><p class="bold-text-font-menu">{{$studentData->course}}</p></td>
            </tr>          
            
          </table>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
           
            <table class="table">
                <tr>
                    <td> <h3 class="page-title">Computer Based Test - Grading</h3></td>
                    
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
    <form class="answer-form" data-question-number="{{$currentQuestionNo}}">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <strong>Question {{$currentQuestionNo}} of {{$studentData->no_of_qst}}</strong>
                    </h4>
                    <div class="table-responsive">
                        <table class="table" width="100%">
                            @if($currentQuestionType === 'text-image')
                                <img id="question-image" src="{{ asset('questions/') }}/{{$questionImage}}" alt="questionImage" width="1200" height="250">
                            @endif
                            <tr>
                                <td colspan="3"><p id="current-question" style="font-size: 34px">{!!$currentQuestion!!}</p></td>
                            </tr>
                            <tr>
                                <td width="82%">
                               <h5><strong><label for="grade-input">Answer:</label></strong></h5> 
                                    <textarea id="editor1" name="answer" rows="10" cols="80">{{$currentAnswer}}</textarea>
                                </td>
                            </tr>
                            <tr>
                            <td width="82%">
                                           <h5><strong><label for="grade-input">Score:</label</strong></h5>
                                            <input type="number" id="grade-input" name="grade" value="{{$currentGrade}}" min="0" max="100" class="form-control" style="width: 100px;">
                                        </td>
                            </tr>
                        </table>                    
                    </div>
                </div>                
            </div>
        </div>
    </form>
</div>
<div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
<input type="hidden" id="hidden-currentQuestionNo" value="{{$currentQuestionNo}}">
<button id="prev-button" class="btn btn-success">Previous Question</button>&nbsp;&nbsp;
<button id="next-button" class="btn btn-info">Next Question</button>
</div>                
            </div>
        </div>

          </div>

          
          <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-2">Submit Grading Score</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure you want to submit.</p>
                        </div>
                        <div class="modal-footer">
                          <a href="{{route('grading', ['qstId'=> $qstId , 'id' => $studentData->id])}}"  class="btn btn-success">Yes</a>
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
  
<script src="{{asset('student/js/jquery-3.6.0.min.js')}}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function initializeCKEditor() {
        if (CKEDITOR.instances.editor1) {
            CKEDITOR.instances.editor1.destroy(true);
        }
        CKEDITOR.replace('editor1');
    }

    function saveAnswerAndNavigate(direction) {
        let formData = {
            _token: '{{ csrf_token() }}',
            answer: CKEDITOR.instances.editor1.getData(),
            grade: $('#grade-input').val(),
            currentQuestionNo: $('#hidden-currentQuestionNo').val(),
            direction: direction
        };

        $.ajax({
            url: "{{ route('save-score', ['qstId'=> $qstId , 'id' => $studentData->id]) }}",
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.error) {
                    alert(response.error);
                } else {
                    renderQuestion(response);
                    initializeCKEditor();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    function renderQuestion(response) {
        $('#questions-container').empty();

        let questionHtml = `
            <form class="answer-form" data-question-number="${response.currentQuestionNo}">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <strong>Question ${response.currentQuestionNo} of ${response.totalQuestions}</strong>
                            </h4>
                            <div class="table-responsive">
                                <table class="table" width="100%">
                                    ${response.currentQuestionType === 'text-image' ? `<img id="question-image" src="${response.questionImage}" alt="questionImage" width="1200" height="250">` : ''}
                                    <tr>
                                        <td colspan="3"><p id="current-question" style="font-size: 34px">${response.currentQuestion}</p></td>
                                    </tr>
                                    <tr>
                                        <td width="82%">
                                        <h5><strong><label for="grade-input">Answer:</label></strong></h5>
                                            <textarea id="editor1" name="answer" rows="10" cols="80">${response.currentAnswer}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="82%">
                                            <h5><strong><label for="grade-input">Score:</label</strong></h5>
                                            <input type="number" id="grade-input" name="grade" value="${response.currentGrade}" min="0" max="100" class="form-control" style="width: 100px;">
                                        </td>
                                    </tr>
                                </table>                    
                            </div>
                        </div>                
                    </div>
                </div>
            </form>
        `;

        $('#questions-container').append(questionHtml);
        $('#hidden-currentQuestionNo').val(response.currentQuestionNo);
    }

    document.getElementById('next-button').addEventListener('click', function(event) {
        event.preventDefault();
        saveAnswerAndNavigate('next');
    });

    document.getElementById('prev-button').addEventListener('click', function(event) {
        event.preventDefault();
        saveAnswerAndNavigate('prev');
    });

    initializeCKEditor();
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
