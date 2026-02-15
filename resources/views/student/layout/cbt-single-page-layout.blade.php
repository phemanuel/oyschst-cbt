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
    <style>
/* Sidebar panel styling */
.exam-details-panel {
    border-left: 4px solid #098c1f; /* subtle blue accent */
    border-radius: 4px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    margin: 10px;
}

/* Panel heading styling */
.exam-details-panel .panel-heading {
    font-size: 16px;
    padding: 10px 12px;
}

/* Sidebar icon sizing */
.exam-details-panel .sidebar-icon {
    font-size: 18px; /* bigger for sidebar */
    margin-right: 5px;
}

/* Body background for readability */
.exam-details-panel .panel-body {
    background-color: #f9f9f9;
    padding: 10px 12px;
}

/* Definition list adjustments */
.dl-vertical dt {
    font-weight: bold;
    color: #333;
    margin-bottom: 3px;
    font-size: 14px;
}

.dl-vertical dd {
    margin-left: 0;
    margin-bottom: 8px;
    color: #555;
    font-size: 14px;
}    
</style>
<style>
    /* Navbar background */
.cbt-navbar {
  background-color: #28a745; /* green background */
  color: #fff;
  border-bottom: 2px solid #1e7e34; /* darker green border */
}

/* Logo section */
.logo-section {
  background-color: #218838; /* slightly darker green for contrast */
  padding: 0 15px;
}

/* Timer button */
.timer-btn {
  background-color: #453a07; /* gold accent */
  color: #000;
  padding: 5px 12px;
  border-radius: 4px;
  font-size: 14px;
  text-align: center;
  min-width: 100px;
}

/* Student info text */
.navbar-info .bold-text-font {
  color: #fff;
  font-size: 13px;
  margin: 0 10px;
}

/* Submit button */
.submit-btn {
  background-color: #453a07; /* teal for contrast */
  color: #fff;
  font-weight: bold;
  border-radius: 4px;
  padding: 5px 12px;
}

/* Hamburger icon color */
.navbar-toggler .fas {
  color: #fff;
}

</style>
<style>
    /* Panel heading */
.question-card .panel-heading {
    font-size: 18px;           /* bigger text */
    font-weight: bold;
    color: #fff;               /* white text for contrast */
    background-color: #393202; /* match button palette or slightly darker */
    padding: 12px;
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
    text-align: center;
}

/* Add space between heading and buttons */
.question-card .panel-body {
    padding: 15px;
}

/* Buttons wrapper */
#question-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;  /* spacing between buttons */
    justify-content: center;
    margin-top: 10px;  /* space below heading */
}

/* Question buttons */
.question-btn {
    position: relative;
    width: 45px;
    height: 45px;
    border-radius: 50%; 
    background-color: #474204; /* existing color */
    color: #fff;
    font-weight: bold;
    font-size: 16px;
    border: none;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Hover effect */
.question-btn:hover {
    background-color: #5a4b00;
    cursor: pointer;
}

/* Active question */
.question-btn.active {
    border: 3px solid #2f2402; /* gold highlight */
}

/* Tick icon INSIDE button */
.tick-icon {
    position: absolute;
    bottom: 2px;
    right: 2px;
    font-size: 12px;
    color: #e8ebe8; /* green tick */
    display: none;
}

/* Show tick when answered */
.question-btn.answered .tick-icon {
    display: block;
    animation: tick-pop 0.3s ease-in-out;
}

/* Tick pop animation */
@keyframes tick-pop {
    0% { transform: scale(0); opacity: 0; }
    50% { transform: scale(1.2); opacity: 1; }
    100% { transform: scale(1); }
}

</style>
<style>
/* 10 minutes warning: deep orange with blinking */
.blink-warning {
    background-color: #ff9800; /* deep orange */
    color: #fff;                /* text white */
    font-weight: bold;
    animation: blink-warning 1s infinite;
}

/* 5 minutes danger: deep red with blinking */
.blink-danger {
    background-color: #d32f2f; /* deep red */
    color: #fff;
    font-weight: bold;
    animation: blink-danger 1s infinite;
}

.big-time {
    font-size: 28px;
    font-weight: 800;
    padding: 0 6px;
}

/* Blinking animations */
@keyframes blink-warning {
    0%, 50%, 100% { opacity: 1; }
    25%, 75% { opacity: 0; }
}

@keyframes blink-danger {
    0%, 50%, 100% { opacity: 1; }
    25%, 75% { opacity: 0; }
}


</style>


    <!-- MathJax Configuration -->
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
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar cbt-navbar">
  <!-- Logo Section -->
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center logo-section">
    <a href="#">
      <img src="{{ asset($collegeSetup->avatar) }}" alt="logo" width="50" height="50"/>
    </a>
  </div>

  <!-- Menu / Info Section -->
  <div class="navbar-menu-wrapper d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="fas fa-bars"></span>
    </button>

    <!-- Timer -->
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item d-none d-lg-flex">
        <a class="nav-link" href="#">            
          <span class="btn timer-btn">
            <strong>
              <p class="bold-text-min">Time Left</p>
              <p><span class="bold-text-min" id="timer"></span></p>
            </strong>
          </span>
        </a>
      </li>
    </ul>

    <!-- Student & Exam Info -->
 <ul class="navbar-nav navbar-info" style="list-style: none; padding: 0; margin: 0 0 15px 0; width: 100%; background-color: #3b3407; border-radius: 6px; overflow: hidden;">

    <!-- Student No -->
    <li style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #fff;">
        <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 13px; color: #ecf0f1;">Student No</div>
        <div style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: bold; color: #fff;">
            {{ $studentData->admission_no }}
        </div>
    </li>

    <!-- Student Name -->
    <li style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #fff;">
        <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 13px; color: #ecf0f1;">Name</div>
        <div style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: bold; color: #fff;">
            {{ $studentData->surname }} {{ $studentData->first_name }} {{ $studentData->other_name }}
        </div>
    </li>

    <!-- Programme -->
    <li style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #fff;">
        <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 13px; color: #ecf0f1;">Programme</div>
        <div style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: bold; color: #fff;">
            {{ $studentData->department }}
        </div>
    </li>

    <!-- Level -->
    <li style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #fff;">
        <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 13px; color: #ecf0f1;">Level</div>
        <div style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: bold; color: #fff;">
            {{ $studentData->level }}
        </div>
    </li>

    <!-- Questions -->
    <li style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #fff;">
        <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 13px; color: #ecf0f1;">Questions</div>
        <div style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: bold; color: #fff;">
            {{ $examSetting->no_of_qst }}
        </div>
    </li>

    <!-- Duration -->
    <li style="padding: 12px 15px; text-align: center;">
        <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 13px; color: #ecf0f1;">Duration</div>
        <div style="font-family: 'Arial', sans-serif; font-size: 16px; font-weight: bold; color: #fff;">
            {{ $examSetting->duration }} Mins
        </div>
    </li>

</ul>

<!-- Submit Test Button (separate, right-aligned, with spacing) -->
<div style="text-align: right; margin-top: 5px; margin-left: 10px;">
    <button type="button" class="btn btn-warning" style="background-color: #3b3407; color: #FFFFFF; font-weight: bold; border-radius: 4px; min-width: 150px;" data-toggle="modal" data-target="#exampleModal-2">
        Submit Test
    </button>
</div>


  </div>
</nav>

    <!-- partial -->
    
    <div class="container-fluid page-body-wrapper">      
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <!-- optional profile info -->
        </li>

        <hr>
    <li>
    <li>
    <!-- Timer Warning Panel -->
    <div id="time-warning" class="hidden panel panel-default exam-details-panel" style="
        padding: 12px 20px;
        border-radius: 8px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 600;
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    ">
        <i id="time-warning-icon" class="fa fa-clock" style="font-size:18px;"></i>
        <span id="time-warning-text"></span>
    </div>
</li>

        <li>
            <div class="panel panel-default exam-details-panel">
                    <table class="table">
                        <tr> 
                            <td>
                                <h4 class="page-title" style="
                                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                                    font-size: 16px; 
                                    font-weight: 600; 
                                    color: #2b2902; 
                                    display: flex; 
                                    align-items: center;
                                    gap: 8px;
                                    margin: 0;
                                ">
                                    <i class="fa fa-question-circle" style="color: #28a745; font-size:18px;"></i>
                                    Read questions carefully and answer appropriately.
                                </h4>
                            </td>
                            <!-- Optional button -->
                            <!-- <td> 
                                <button type="button" name="{{$pageNo}}" id="{{$pageNo}}" class="btn btn-info">Load Answers</button>
                            </td> -->
                        </tr>

                    </table>
                </div>
        </li>
        <li>
            <div class="panel panel-default exam-details-panel">
                <div class="panel-heading">
                    <strong style="display: flex; align-items: center; gap: 6px; font-size: 16px; color: #1c1d1f;">
                        <span class="glyphicon glyphicon-info-sign" style="color: #28a745; font-size: 18px;"></span>
                        <i class="fa fa-book" style="color: #0a932f; font-size: 16px;"></i>
                        Exam Details
                    </strong>

                </div>

                <div class="panel-body">
                    <dl class="dl-vertical">
                        <dt>Academic Session:</dt>
                        <dd>{{ $examSetting->session1 }}</dd>                        

                        <dt>Semester:</dt>
                        <dd>{{ $examSetting->semester }}</dd>

                        <dt>Exam Type:</dt>
                        <dd>{{ $examSetting->exam_type }}</dd>

                        <dt>Course:</dt>
                        <dd>{{ $examSetting->course }}</dd>
                    </dl>
                </div>
            </div>
        </li>

        <li>
    <!-- Attempted Questions Counter -->
        <li>
            <div class="panel panel-default exam-details-panel">
                <table class="table" style="margin-bottom:0;">
                    <tr> 
                        <td>
                            <h4 id="attempted-counter" class="page-title" style="
                                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                                font-size: 16px; 
                                font-weight: 600; 
                                color: #2b2902; 
                                display: flex; 
                                align-items: center;
                                gap: 8px;
                                margin: 0;
                                transition: background-color 0.3s, color 0.3s;
                                padding: 4px 8px;
                                border-radius: 4px;
                            ">
                                <i class="fa fa-tasks" style="color: #28a745; font-size:18px;"></i>
                                You have attempted 0 out of {{ $examSetting->no_of_qst }} questions
                            </h4>

                            <!-- Progress Bar -->
                            <!-- <div class="progress" style="height: 12px; margin-top:5px; border-radius:6px; background-color:#e0e0e0;">
                                <div id="attempted-progress" class="progress-bar" role="progressbar" style="
                                    width: 0%;
                                    background-color: #28a745;
                                    border-radius:6px;
                                    transition: width 0.3s ease;
                                "></div> -->
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </li>



    </ul>
</nav>

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">          
          
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
          <div class="row d-flex">
    <!-- Left Column: Question & Options -->
<div class="col-md-8 d-flex">
    <div class="card flex-fill d-flex flex-column" style="max-height:100%; overflow-y:auto;">
        <div class="card-body d-flex flex-column" style="padding-bottom:0;">
            <form action="" class="answer-form" data-question-number="1">
                <!-- Question Header -->
                <h4 class="card-title mb-3">
                    <strong>Question <span id="current-question-number">1</span> of {{ $examSetting->no_of_qst }}</strong>
                </h4>     

                <!-- Question Container -->
                <div class="question-container mb-3" style="padding:15px; font-size:30px; background-color:#f9f9f9; border-radius:4px;">
                    <div id="current-question"></div>
                </div>

                <!-- Options Table -->
                <table class="options-container w-100" style="border-collapse: collapse;">
                    @foreach(['A','B','C','D'] as $opt)
                    <tr class="options-row" style="height:40px;">
                        <td style="padding:4px 8px;">
                            <input type="radio" name="option" id="option_{{ strtolower($opt) }}" value="{{ $opt }}" />
                            <label for="option_{{ strtolower($opt) }}" style="margin-left:6px; font-size:18px; cursor:pointer;">
                                <i class="fa fa-circle-o me-1"></i> Option {{ $opt }}
                            </label>
                        </td>
                    </tr>
                    @endforeach
                </table>

            </form>
        </div>

        <!-- Previous / Next Buttons in a separate footer card -->
        <div class="card mt-2" style="background-color:#f0f0f0; border-radius:6px; margin:8px;">
            <div class="card-body d-flex justify-content-between p-2">
                <button id="prev-button" class="btn d-flex align-items-center" 
                        style="background-color:#3b3407; color:#fff; font-weight:bold; gap:5px; border-radius:6px;">
                    <i class="fa fa-arrow-left"></i> Previous
                </button>

                <button id="next-button" class="btn d-flex align-items-center" 
                        style="background-color:#28a745; color:#fff; font-weight:bold; gap:5px; border-radius:6px;">
                    Next <i class="fa fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>



    <!-- Right Column: Question Navigation -->
    <div class="col-md-4 d-flex">
        <div class="card flex-fill d-flex flex-column" style="max-height:100%;">
            <!-- Sticky Header -->
            <div class="card-header text-center" 
                 style="font-weight:bold; font-size:16px; background-color:#3b3407; color:#fff; position:sticky; top:0; z-index:10; border-radius:6px 6px 0 0;">
                Question Navigation
            </div>

            <!-- Scrollable Buttons -->
            <div class="card-body flex-fill" style="padding:10px; overflow-y:auto;">
               <div id="question-buttons" class="question-buttons-wrapper" 
                    data-admission-no="{{ $studentData->admission_no }}" 
                    style="display:flex; flex-wrap:wrap; gap:8px; justify-content:center;">

                    @for ($i = 1; $i <= $examSetting->no_of_qst; $i++)
                        <button type="button" 
                                class="btn question-btn {{ $i === 1 ? 'active' : '' }}" 
                                data-question-number="{{ $i }}"
                                style="
                                    position:relative;
                                    width:50px; 
                                    height:50px; 
                                    border-radius:50%; 
                                    background-color:#474204; 
                                    color:#fff; 
                                    font-weight:bold; 
                                    font-size:16px; 
                                    border:none; 
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    transition: all 0.2s;
                                ">
                            <span class="question-number">{{ $i }}</span>
                            <!-- Tick icon in top-right corner -->
                            <i class="fa fa-check tick-icon" 
                            style="
                                position:absolute; 
                                top:10px; 
                                right:10px; 
                                color:#fff; 
                                display:none; 
                                font-size:14px;
                            "></i>
                        </button>
                    @endfor

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
        <footer class="footer" style="background-color: #ffffff; padding: 10px 20px;">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                    Copyright © 2020 - <?php echo date('Y'); ?> 
                    <a href="{{$collegeSetup->web_url}}" target="_blank">{{$collegeSetup->name}}</a>.
                </span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                    Version : {{$softwareVersion->version}}
                </span>
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
<!-- Time counter -->
<script>
"use strict";

// Duration in seconds fetched from DB
let duration = {{ $studentMin }}; 
let remainingTime = duration;

// Warning thresholds
const tenMinLeft = 10 * 60; // 600 seconds
const fiveMinLeft = 5 * 60;  // 300 seconds

// Elements
const timerEl = document.getElementById('timer');
const warningDiv = document.getElementById('time-warning');
const warningText = document.getElementById('time-warning-text');
const icon = document.getElementById('time-warning-icon');

// Start countdown
function startTimer() {
    // Immediately check warning in case remainingTime <= thresholds
    updateTimerWarning(remainingTime);

    const interval = setInterval(() => {
        if (remainingTime > 0) {
            remainingTime--;

            // Save remaining time every full minute
            if (remainingTime % 60 === 0) saveRemainingTime(Math.floor(remainingTime));

            updateTimerDisplay(remainingTime);
            updateTimerWarning(remainingTime);

        } else {
            clearInterval(interval);
            alert("Time is up!");
            window.location.href = "{{ route('cbt-submit', ['id' => $studentData->id]) }}";
        }
    }, 1000);
}

// Save remaining time to DB
function saveRemainingTime(remainingMinutes) {
    fetch('/update-remaining-time/{{ $studentData->id }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ remaining_time: remainingMinutes })
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) console.error('Failed to save remaining time');
    });
}

// Update timer display
function updateTimerDisplay(time) {
    const minutes = Math.floor(time / 60);
    const seconds = time % 60;
    timerEl.textContent = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
}

// Update warning panel with blinking
function updateTimerWarning(time) {
    if (time <= fiveMinLeft) { // 5 minutes or less
        warningDiv.classList.remove('hidden', 'warning', 'danger', 'blink-warning', 'blink-danger');
        warningDiv.classList.add('danger', 'blink-danger'); // separate blink class
        warningText.innerHTML = 'Only less than <span class="big-time">5</span> minutes remaining!';
        icon.className = "fa fa-exclamation-triangle";

    } else if (time <= tenMinLeft) { // 10 minutes or less
        warningDiv.classList.remove('hidden', 'warning', 'danger', 'blink-warning', 'blink-danger');
        warningDiv.classList.add('warning', 'blink-warning'); // separate blink class
        warningText.innerHTML = 'You have less than <span class="big-time">10</span> minutes left!';
        icon.className = "fa fa-clock";

    } else {
        warningDiv.classList.add('hidden');
        warningDiv.classList.remove('warning', 'danger', 'blink-warning', 'blink-danger');
    }
}

// Start the timer
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
    const attemptedCounterEl = document.getElementById('attempted-counter');

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
    const totalQuestions = {{ $examSetting->no_of_qst }};
    const attemptedQuestions = new Set();

    // ===============================
    // Fetch attempted questions from DB
    // ===============================
    fetch(`/get-attempted-questions?admission_no=${admissionNo}`)
        .then(res => res.json())
        .then(data => {
            console.log("Fetched attempted questions:", data);
            if (Array.isArray(data)) {
                data.forEach(qNum => attemptedQuestions.add(qNum));
                updateAttemptedCounter();
                updateButtonStates(parseInt(buttons[0].dataset.questionNumber)); // first question active
            }
        })
        .catch(err => console.error('Error fetching attempted questions:', err));

    // ===============================
    // Clear question and options
    // ===============================
    const clearQuestion = () => {
        currentQuestionEl.innerHTML = '';
        Object.values(optionLabels).forEach(label => label.innerHTML = '');
        Object.values(optionInputs).forEach(input => input.checked = false);
    };

    // ===============================
    // Update button states and ticks
    // ===============================
    const updateButtonStates = (activeNumber) => {
        buttons.forEach(btn => {
            const btnNumber = parseInt(btn.dataset.questionNumber);
            const tick = btn.querySelector('.tick-icon');

            // Reset
            btn.style.backgroundColor = '#474204';
            btn.style.color = '#fff';
            btn.classList.remove('active');

            // Active question
            if (btnNumber === activeNumber) {
                btn.style.backgroundColor = '#28a745';
                btn.style.color = '#fff';
                btn.classList.add('active');
            }

            // Attempted questions
            if (attemptedQuestions.has(btnNumber)) {
                if (tick) {
                    tick.style.display = 'block';
                    tick.style.color = '#fff';
                }
            } else {
                if (tick) tick.style.display = 'none';
            }
        });
    };

    // ===============================
    // Update attempted counter
    // ===============================
    const updateAttemptedCounter = () => {
        attemptedCounterEl.innerHTML = `
            <i class="fa fa-tasks" style="color: #28a745; font-size:18px;"></i>
            You have attempted ${attemptedQuestions.size} out of ${totalQuestions} questions
        `;
        
    };

    // ===============================
    // ===============================
    // Load a question
    // ===============================
    const loadQuestion = (questionNumber) => {
        clearQuestion();

        // Fetch question data
        fetch(`/get-question/${questionNumber}?admission_no=${admissionNo}`)
            .then(res => res.json())
            .then(data => {
                currentQuestionNumberEl.textContent = questionNumber;

                // ===============================
                // Render Question
                // ===============================
                // ===============================
// ===============================
if (data.questionType === 'text') {
    // Only text question
    currentQuestionEl.innerHTML = '';
    if (data.question) {
        const questionText = document.createElement('p');
        questionText.textContent = data.question;
        questionText.style.fontSize = '2.20rem'; // bigger font
        questionText.style.fontWeight = '400'; // semi-bold
        questionText.style.marginBottom = '0.5rem';
        currentQuestionEl.appendChild(questionText);
    }
} else if (data.questionType === 'text-image') {
    // Clear current content
    currentQuestionEl.innerHTML = '';    

    // Add question text first
    if (data.question) {
        const questionText = document.createElement('p');
        questionText.textContent = data.question;
        questionText.style.fontSize = '2.20rem'; // bigger font
        questionText.style.fontWeight = '400'; // semi-bold
        questionText.style.marginBottom = '0.5rem';
        currentQuestionEl.appendChild(questionText);
    }

    // Add image
    if (data.graphic) {
        const img = document.createElement('img');
        img.src = `/questions/${data.graphic}`;
        img.alt = 'Question Image';
        img.classList.add('img-fluid', 'mb-3');
        img.style.maxWidth = '100%';
        currentQuestionEl.appendChild(img);
    }
}



                // ===============================
                // Set Options (with safe defaults)
                // ===============================
                optionLabels.A.innerHTML = data.option_a || '';
                optionLabels.B.innerHTML = data.option_b || '';
                optionLabels.C.innerHTML = data.option_c || '';
                optionLabels.D.innerHTML = data.option_d || '';

                // ===============================
                // Render MathJax (offline safe)
                // ===============================
                if (window.MathJax && MathJax.startup && MathJax.startup.promise) {
                    MathJax.startup.promise.then(() => {
                        try {
                            MathJax.typeset([
                                currentQuestionEl,
                                optionLabels.A,
                                optionLabels.B,
                                optionLabels.C,
                                optionLabels.D
                            ]);
                        } catch (err) {
                            console.error('MathJax typeset error:', err);
                        }
                    }).catch(err => {
                        console.error('MathJax startup promise error:', err);
                    });
                }

                // ===============================
                // Mark previously selected answer
                // ===============================
                if (data.answerSelected) {
                    const ans = data.answerSelected.toUpperCase();
                    if (optionInputs[ans]) {
                        optionInputs[ans].checked = true;
                        attemptedQuestions.add(parseInt(questionNumber));
                    }
                }

                // ===============================
                // Update UI state
                // ===============================
                updateButtonStates(parseInt(questionNumber));
                updateAttemptedCounter();
                updateNavButtonsState(parseInt(questionNumber));

            })
            .catch(err => {
                console.error('Question fetch error:', err);
                currentQuestionEl.innerHTML = 'Failed to load question.';
            });
    };


    // ===============================
    // Save answer
    // ===============================
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
        .then(res => res.json())
        .then(() => {
            attemptedQuestions.add(parseInt(questionNumber));
            updateButtonStates(parseInt(questionNumber));
            updateAttemptedCounter();
        })
        .catch(err => console.error(err));
    };

    // ===============================
    // Option change event
    // ===============================
    Object.values(optionInputs).forEach(input => {
        input.addEventListener('change', function () {
            const selectedOption = this.value;
            const questionNumber = parseInt(currentQuestionNumberEl.textContent);
            saveAnswer(questionNumber, selectedOption);
        });
    });

    // ===============================
    // Question buttons click
    // ===============================
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const questionNumber = parseInt(this.dataset.questionNumber);
            loadQuestion(questionNumber);
        });
    });

    // ===============================
    // Prev/Next buttons
    // ===============================
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');

    const updateNavButtonsState = (current) => {
        prevButton.disabled = current <= 1;
        nextButton.disabled = current >= totalQuestions;
    };

    prevButton.addEventListener('click', () => {
        const current = parseInt(currentQuestionNumberEl.textContent);
        if (current > 1) loadQuestion(current - 1);
    });

    nextButton.addEventListener('click', () => {
        const current = parseInt(currentQuestionNumberEl.textContent);
        if (current < totalQuestions) loadQuestion(current + 1);
    });

    // ===============================
    // Initial load
    // ===============================
    loadQuestion(parseInt(buttons[0].dataset.questionNumber));
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
