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
<style>
        .green-hr {
            border: 1px solid green;
        }
    </style>
</head>
<body class="sidebar-fixed">
<div id="cbt-content">
        <!-- CBT Content goes here -->
        <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a  href="#"><img src="{{asset($collegeSetup->avatar)}}" alt="logo" width="50" height="50"/></a>
        <!-- <a  href="#"><img src="{{asset($collegeSetup->avatar)}}" alt="logo" width="50" height="50"/></a> -->
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
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
                Question Menu&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;</span>            
          </li>
         
          <hr>
          @if($examSetting->no_of_qst == 10)
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <button type="button" name="1" id="1"  class="btn btn-success">Question 1-10</button>              
          </li>
          @elseif($examSetting->no_of_qst == 20)
          <li class="nav-item">            
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <button type="button" name="1" id="1"  class="btn btn-success">Question 1-10</button>              
            </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="2" id="2"  class="btn btn-success">Question 11-20</button>
          </li>
          @elseif($examSetting->no_of_qst == 30)
          <li class="nav-item">            
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <button type="button" name="1" id="1"  class="btn btn-success">Question 1-10</button>              
            </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="2" id="2"  class="btn btn-success">Question 11-20</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="3" id="3"  class="btn btn-success">Question 21-30</button>
          </li>
          @elseif($examSetting->no_of_qst == 40)
          <li class="nav-item">            
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <button type="button" name="1" id="1"  class="btn btn-success">Question 1-10</button>              
            </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="2" id="2"  class="btn btn-success">Question 11-20</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="3" id="3"  class="btn btn-success">Question 21-30</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="4" id="4"  class="btn btn-success">Question 31-40</button>
          </li>
          @elseif($examSetting->no_of_qst == 50)
          <li class="nav-item">            
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <button type="button" name="1" id="1"  class="btn btn-success">Question 1-10</button>              
            </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="2" id="2"  class="btn btn-success">Question 11-20</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="3" id="3"  class="btn btn-success">Question 21-30</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="4" id="4"  class="btn btn-success">Question 31-40</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="5" id="5"  class="btn btn-success">Question 41-50</button>
          </li>
          @elseif($examSetting->no_of_qst == 60)
          <li class="nav-item">            
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <button type="button" name="1" id="1"  class="btn btn-success">Question 1-10</button>              
            </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="2" id="2"  class="btn btn-success">Question 11-20</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="3" id="3"  class="btn btn-success">Question 21-30</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="4" id="4"  class="btn btn-success">Question 31-40</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="5" id="5"  class="btn btn-success">Question 41-50</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="6" id="6"  class="btn btn-success">Question 51-60</button>
          </li>
          @elseif($examSetting->no_of_qst == 70)
          <li class="nav-item">            
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <button type="button" name="1" id="1"  class="btn btn-success">Question 1-10</button>              
            </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="2" id="2"  class="btn btn-success">Question 11-20</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="3" id="3"  class="btn btn-success">Question 21-30</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="4" id="4"  class="btn btn-success">Question 31-40</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="5" id="5"  class="btn btn-success">Question 41-50</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="6" id="6"  class="btn btn-success">Question 51-60</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="7" id="7"  class="btn btn-success">Question 61-70</button>
          </li>
          @elseif($examSetting->no_of_qst == 80)
          <li class="nav-item">            
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <button type="button" name="1" id="1"  class="btn btn-success">Question 1-10</button>              
            </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="2" id="2"  class="btn btn-success">Question 11-20</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="3" id="3"  class="btn btn-success">Question 21-30</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="4" id="4"  class="btn btn-success">Question 31-40</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="5" id="5"  class="btn btn-success">Question 41-50</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="6" id="6"  class="btn btn-success">Question 51-60</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="7" id="7"  class="btn btn-success">Question 61-70</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="8" id="8"  class="btn btn-success">Question 71-80</button>
          </li><br>
          @elseif($examSetting->no_of_qst == 90)
          <li class="nav-item">            
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <button type="button" name="1" id="1"  class="btn btn-success">Question 1-10</button>              
            </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="2" id="2"  class="btn btn-success">Question 11-20</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="3" id="3"  class="btn btn-success">Question 21-30</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="4" id="4"  class="btn btn-success">Question 31-40</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="5" id="5"  class="btn btn-success">Question 41-50</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="6" id="6"  class="btn btn-success">Question 51-60</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="7" id="7"  class="btn btn-success">Question 61-70</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="8" id="8"  class="btn btn-success">Question 71-80</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="9" id="9"  class="btn btn-success">Question 81-90</button>
          </li>
          @elseif($examSetting->no_of_qst == 100)
          <li class="nav-item">            
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <button type="button" name="1" id="1"  class="btn btn-success">Question 1-10</button>              
            </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="2" id="2"  class="btn btn-success">Question 11-20</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="3" id="3"  class="btn btn-success">Question 21-30</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="4" id="4"  class="btn btn-success">Question 31-40</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="5" id="5"  class="btn btn-success">Question 41-50</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="6" id="6"  class="btn btn-success">Question 51-60</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="7" id="7"  class="btn btn-success">Question 61-70</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="8" id="8"  class="btn btn-success">Question 71-80</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="9" id="9"  class="btn btn-success">Question 81-90</button>
          </li><br>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="10" id="10"  class="btn btn-success">Question 91-100</button>
          </li>
          @endif          
        <hr>
        <!-- <li class="nav-item">
              <span class="bold-text-font-menu">&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                Exam Details&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;</span>           
          </li>
          <hr> -->
          <table class="table">
            
            <tr>
            <td><p class="bold-text-font-menu">Exam Type:</p></td>
                <td><p class="bold-text-font-menu">{{$examSetting->exam_type}}</p></td>
            </tr>
            @if($examSetting->exam_category == 'SEMESTER')
            <tr>
                <td><p class="bold-text-font-menu">Semester:</p></td>
                <td><p class="bold-text-font-menu">{{$examSetting->session1}}</p></td>
            </tr>
            <tr>
                <td><p class="bold-text-font-menu">Course:</p></td>
                <td><p class="bold-text-font-menu">{{$examSetting->course}}</p></td>
            </tr>
            @else

            @endif
            
          </table>
          <hr>
          
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
           
            <table class="table">
                <tr>
                    <td> <h3 class="page-title">Computer Based Test - Read questions carefully and select the answer appropriately.</h3></td>
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
          <div class="row">         
              
              <!-- Questions will be dynamically loaded here -->
              <div id="questions-container">
    
              </div>
           <!-- end card -->     
           <!-- <input type="hidden" name="btn_action" id="btn_action" />    
           <input type="hidden" name="pageNo" value ="{{$pageNo}}"> -->
  

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

<!-- Fetch questions and update Answers -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="{{ asset('student/js/jquery-3.5.1.min.js') }}"></script>
<script>
        $(document).ready(function() {
            // Function to fetch questions and render them
            function fetchQuestions(id, pageNo) {
                var url = "{{ route('fetch-questions', ['id' => '__ID__', 'pageNo' => '__PAGE_NO__']) }}"
                    .replace('__ID__', id)
                    .replace('__PAGE_NO__', pageNo);

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        console.log('Response from fetchQuestions:', response);

                        // Render the fetched questions
                        renderQuestions(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching questions:', error);
                    }
                });
            }
            
            // Function to render questions on the page
              function renderQuestions(response) {
                  $('#questions-container').empty(); // Clear previous questions

                  // Determine the starting question number based on the page number
                  var startingQuestionNumber = (response.pageNo - 1) * 10 + 1;

                  // Iterate through fetched questions and render them
                  $.each(response.qstData, function(key, question) {
                      var questionIndex = key.replace('qst', '');
                      var questionNumber = startingQuestionNumber + parseInt(questionIndex) - 1;
                      var graphic = response.graphicData['g' + questionIndex];
                      var questionType = response.qstType['qt' + questionIndex];
                      var answer = "Selected Answer: " + (response.answerData['a' + questionIndex] || ''); // Prepend "Selected Answer:"

                      // Construct the path to the image
                      var imagePath = graphic ? `/questions/${graphic}` : '';

                      var questionHtml = `
                          <form class="answer-form" data-page-no="${response.pageNo}" data-question-number="${questionNumber}">
                              @csrf
                              <div class="col-12 grid-margin">
                                  <div class="card">
                                      <div class="card-body">
                                          <h4 class="card-title">
                                              <strong>Question ${questionNumber}</strong>
                                          </h4>
                                          <div class="table-responsive">
                                              <table class="table" width="100%">
                                                  ${questionType === 'text-image' && graphic ? `<img src="${imagePath}" alt="questionImage" width="1200" height="300">` : ''}
                                                  <tr>
                                                      <td colspan="3"><p class="bold-font-qst">${question}</p></td>
                                                  </tr>
                                                  <tr>
                                                      <td width="82%">
                                                          <input type="submit" name="option${questionNumber}A" value="A" class="btn btn-dark"/> &nbsp; &nbsp;
                                                          <input type="submit" name="option${questionNumber}B" value="B" class="btn btn-dark"/> &nbsp; &nbsp;
                                                          <input type="submit" name="option${questionNumber}C" value="C" class="btn btn-dark"/> &nbsp; &nbsp;
                                                          <input type="submit" name="option${questionNumber}D" value="D" class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                                                          <hr>                        
                                                          <span id="answer${questionNumber}" class="bold-font-ans">${answer}</span>
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
                  });
              }

            // Function to update answer
            function updateAnswer(studentId, pageNo, questionNumber, optionName, selectedOption) {
                var url = "{{ route('update-answers', ['id' => '__ID__', 'pageNo' => '__PAGE_NO__']) }}"
                    .replace('__ID__', studentId)
                    .replace('__PAGE_NO__', pageNo);

                $.ajax({
                    url: url,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        optionName: optionName,
                        selectedOption: selectedOption,
                        number: questionNumber
                    },
                    success: function(response) {
                        console.log('Response from updateAnswer:', response);

                        // Update the answer display
                        $('#answer' + questionNumber).text('Selected Answer: ' + selectedOption);
                        console.log('Answer updated successfully');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating answer:', error);
                    }
                });
            }

            // Event listener for question buttons
            $('button.btn-success').click(function() {
                var pageNo = $(this).attr('name');
                var studentId = '{{ $studentData->id }}'; // Use the actual student ID from your backend
                fetchQuestions(studentId, pageNo);
            });

            // Event listener for answer form submission
            $(document).on('submit', 'form.answer-form', function(event) {
                event.preventDefault(); // Prevent the default form submission

                var form = $(this);
                var optionName = form.find('input[type="submit"]:focus').attr('name');
                var selectedOption = form.find('input[type="submit"]:focus').val();
                var questionNumber = form.data('question-number');
                var pageNo = form.data('page-no');
                var studentId = '{{ $studentData->id }}'; // Use the actual student ID from your backend

                updateAnswer(studentId, pageNo, questionNumber, optionName, selectedOption);
            });
        });
    </script>

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
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      function enterFullScreen(element) {
        if (element.requestFullscreen) {
          element.requestFullscreen();
        } else if (element.mozRequestFullScreen) {
          element.mozRequestFullScreen();
        } else if (element.webkitRequestFullscreen) {
          element.webkitRequestFullscreen();
        } else if (element.msRequestFullscreen) {
          element.msRequestFullscreen();
        }
      }

      enterFullScreen(document.documentElement);

      document.addEventListener('fullscreenchange', function() {
        if (!document.fullscreenElement) {
          alert('Please stay in full-screen mode for the best test experience.');
          enterFullScreen(document.documentElement);
        }
      });
    });
  </script>

</body>



</html>
