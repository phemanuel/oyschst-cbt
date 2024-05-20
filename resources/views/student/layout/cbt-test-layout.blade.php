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
    font-size: 14px;
    font-weight: bold;  
    color: white;  
}

.bold-text-font-menu {
    font-size: 14px;
    font-weight: bold;  
    color: black;  
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
    color: red;
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
        <a class="navbar-brand brand-logo" href="#"><img src="{{asset($collegeSetup->avatar)}}" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="#"><img src="{{asset($collegeSetup->avatar)}}" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        
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
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item d-none d-lg-flex">
            <a class="nav-link" href="#">            
              <span class="btn btn-primary"><strong><p class="bold-text-min">Time Left</p> <p><span class="bold-text-min" id="timer"></span> </p></strong></span>
            </a>
          </li>
        </ul>
        
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->
      
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close fa fa-times"></i>
        <ul class="nav nav-tabs" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task-todo">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
              </ul>
            </div>
            <div class="events py-4 border-bottom px-3">
              <div class="wrapper d-flex mb-2">
                <i class="fa fa-times-circle text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page</p>
              <p class="text-gray mb-0">build a js based app</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="fa fa-times-circle text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="../../images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
           
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fa fa-home menu-icon"></i>
              <span class="bold-text-font-menu">Question Menu</span>
            </a>
          </li>
          <hr>
          @if($examSetting->no_of_qst == 10)
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">Question 1-10</a>           
          </li>
          @elseif($examSetting->no_of_qst == 20)
          <li class="nav-item">            
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">Question 1-10</a>
            </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page2', ['id' => $studentData->id])}}" class="btn btn-success">Question 11-20</a>
          </li>
          @elseif($examSetting->no_of_qst == 30)
          <li class="nav-item">            
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">Question 1-10</a>
            </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page2', ['id' => $studentData->id])}}" class="btn btn-success">Question 11-20</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page3', ['id' => $studentData->id])}}" class="btn btn-success">Question 21-30</a>
          </li>
          @elseif($examSetting->no_of_qst == 40)
          <li class="nav-item">            
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">Question 1-10</a>
            </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page2', ['id' => $studentData->id])}}" class="btn btn-success">Question 11-20</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page3', ['id' => $studentData->id])}}" class="btn btn-success">Question 21-30</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page4', ['id' => $studentData->id])}}" class="btn btn-success">Question 31-40</a>
          </li>
          @elseif($examSetting->no_of_qst == 50)
          <li class="nav-item">            
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">Question 1-10</a>
            </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page2', ['id' => $studentData->id])}}" class="btn btn-success">Question 11-20</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page3', ['id' => $studentData->id])}}" class="btn btn-success">Question 21-30</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page4', ['id' => $studentData->id])}}" class="btn btn-success">Question 31-40</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page5', ['id' => $studentData->id])}}" class="btn btn-success">Question 41-50</a>
          </li>
          @elseif($examSetting->no_of_qst == 60)
          <li class="nav-item">            
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">Question 1-10</a>
            </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page2', ['id' => $studentData->id])}}" class="btn btn-success">Question 11-20</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page3', ['id' => $studentData->id])}}" class="btn btn-success">Question 21-30</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page4', ['id' => $studentData->id])}}" class="btn btn-success">Question 31-40</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page5', ['id' => $studentData->id])}}" class="btn btn-success">Question 41-50</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page6', ['id' => $studentData->id])}}" class="btn btn-success">Question 51-60</a>
          </li>
          @elseif($examSetting->no_of_qst == 70)
          <li class="nav-item">            
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">Question 1-10</a>
            </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page2', ['id' => $studentData->id])}}" class="btn btn-success">Question 11-20</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page3', ['id' => $studentData->id])}}" class="btn btn-success">Question 21-30</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page4', ['id' => $studentData->id])}}" class="btn btn-success">Question 31-40</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page5', ['id' => $studentData->id])}}" class="btn btn-success">Question 41-50</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page6', ['id' => $studentData->id])}}" class="btn btn-success">Question 51-60</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page7', ['id' => $studentData->id])}}" class="btn btn-success">Question 61-70</a>
          </li>
          @elseif($examSetting->no_of_qst == 80)
          <li class="nav-item">            
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">Question 1-10</a>
            </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page2', ['id' => $studentData->id])}}" class="btn btn-success">Question 11-20</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page3', ['id' => $studentData->id])}}" class="btn btn-success">Question 21-30</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page4', ['id' => $studentData->id])}}" class="btn btn-success">Question 31-40</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page5', ['id' => $studentData->id])}}" class="btn btn-success">Question 41-50</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page6', ['id' => $studentData->id])}}" class="btn btn-success">Question 51-60</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page7', ['id' => $studentData->id])}}" class="btn btn-success">Question 61-70</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page8', ['id' => $studentData->id])}}" class="btn btn-success">Question 71-80</a>
          </li>
          @elseif($examSetting->no_of_qst == 90)
          <li class="nav-item">            
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">Question 1-10</a>
            </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page2', ['id' => $studentData->id])}}" class="btn btn-success">Question 11-20</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page3', ['id' => $studentData->id])}}" class="btn btn-success">Question 21-30</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page4', ['id' => $studentData->id])}}" class="btn btn-success">Question 31-40</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page5', ['id' => $studentData->id])}}" class="btn btn-success">Question 41-50</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page6', ['id' => $studentData->id])}}" class="btn btn-success">Question 51-60</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page7', ['id' => $studentData->id])}}" class="btn btn-success">Question 61-70</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page8', ['id' => $studentData->id])}}" class="btn btn-success">Question 71-80</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page9', ['id' => $studentData->id])}}" class="btn btn-success">Question 81-90</a>
          </li>
          @elseif($examSetting->no_of_qst == 100)
          <li class="nav-item">            
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">Question 1-10</a>
            </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page2', ['id' => $studentData->id])}}" class="btn btn-success">Question 11-20</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page3', ['id' => $studentData->id])}}" class="btn btn-success">Question 21-30</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page4', ['id' => $studentData->id])}}" class="btn btn-success">Question 31-40</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page5', ['id' => $studentData->id])}}" class="btn btn-success">Question 41-50</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page6', ['id' => $studentData->id])}}" class="btn btn-success">Question 51-60</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page7', ['id' => $studentData->id])}}" class="btn btn-success">Question 61-70</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page8', ['id' => $studentData->id])}}" class="btn btn-success">Question 71-80</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page9', ['id' => $studentData->id])}}" class="btn btn-success">Question 81-90</a>
          </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a href="{{route('cbt-page10', ['id' => $studentData->id])}}" class="btn btn-success">Question 91-100</a>
          </li>
          @endif
          <hr>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal-2">
                    Submit Test</button>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
           
            <table class="table">
                <tr>
                    <td> <h3 class="page-title">Computer Based Test - Read questions carefully and select the answer appropriately.</h3></td>
                    <td> <button id = "{{$pageNo}}" type="button" name="{{$pageNo}}" id="{{$pageNo}}"  class="btn btn-info">Load Answers</button></td>
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
          <form action="" method="POST">
              @csrf
          <!-- begin card -->
            <div class="col-12 grid-margin" id="question1">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q1'] }} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                    @if($question1->question_type == 'text-image')
                      <tr>                        
                      <img src="{{asset('questions/' . $question1->graphic)}}" alt="questionImage" width="1200" height="250">                        
                      </tr>
                      <tr>
                        <td><p class="bold-font-qst">{!! $question1->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @else
                      <tr>                        
                        <td><p class="bold-font-qst">{!! $question1->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @endif
                      <tr>
                      <td width="82%">
                      <input type="submit" name="option{{ $questionNo['q1'] }}A" id="option{{ $questionNo['q1'] }}B" value="A" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q1'] }}B" id="option{{ $questionNo['q1'] }}B" value="B" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q1'] }}C" id="option{{ $questionNo['q1'] }}C" value="C" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q1'] }}D" id="option{{ $questionNo['q1'] }}D" value="D" class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <hr>
                        <!-- <p><span class="bold-font-text">Selected Answer:</span>  -->
                        <!-- <span class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a1']} }}</span> -->
                        <span id="answer1" class="bold-font-ans"></span>
                        
                        </p>
                        <input type="hidden" name="q1" id="questionNumber" value="{{ $questionNo['q1'] }}">
                        </td>
                        <td></td>
                        <td></p></td>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->
           <!-- begin card -->
           <div class="col-12 grid-margin" id="question2">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q2'] }} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                    @if($question2->question_type == 'text-image')
                      <tr>                        
                      <img src="{{asset('questions/' . $question2->graphic)}}" alt="questionImage" width="1200" height="250">                        
                      </tr>
                      <tr>
                        <td><p class="bold-font-qst">{!! $question2->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @else
                      <tr>                        
                        <td><p class="bold-font-qst">{!! $question2->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @endif
                      <tr>
                      <td><input type="submit" name="option{{ $questionNo['q2'] }}A" id="option{{ $questionNo['q2'] }}A" value="A" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q2'] }}B" id="option{{ $questionNo['q2'] }}B" value="B" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q2'] }}C" id="option{{ $questionNo['q2'] }}C" value="C" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q2'] }}D" id="option{{ $questionNo['q2'] }}D" value="D" class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <hr>
                        <!-- <p><span class="bold-font-text">Selected Answer:</span>  -->
                        <!-- <span class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a2']} }}</span> -->
                        <span id="answer2" class="bold-font-ans"></span>
                        </p>
                        <input type="hidden" name="q2" id="questionNumber" value="{{ $questionNo['q2'] }}">
                        </td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->
           <!-- begin card -->
           <div class="col-12 grid-margin" id="question3">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q3'] }} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                    @if($question3->question_type == 'text-image')
                      <tr>                        
                      <img src="{{asset('questions/' . $question3->graphic)}}" alt="questionImage" width="1200" height="250">                        
                      </tr>
                      <tr>
                        <td><p class="bold-font-qst">{!! $question3->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @else
                      <tr>                        
                        <td><p class="bold-font-qst">{!! $question3->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @endif
                      <tr>
                      <td width="82%"><input type="submit" name="option{{ $questionNo['q3'] }}A" id="option{{ $questionNo['q3'] }}A" value="A" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q3'] }}B" id="option{{ $questionNo['q3'] }}B" value="B" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q3'] }}C" id="option{{ $questionNo['q3'] }}C" value="C" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q3'] }}D" id="option{{ $questionNo['q3'] }}D" value="D" class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <hr>
                        <!-- <p><span class="bold-font-text">Selected Answer:</span>  -->
                        <!-- <span class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a3']} }}</span> -->
                        <span id="answer3" class="bold-font-ans"></span>                        
                        </p>
                        <input type="hidden" name="q3" id="questionNumber" value="{{ $questionNo['q3'] }}">                        
                        </td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->          
           <!-- begin card -->
           <div class="col-12 grid-margin" id="question4">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q4'] }} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                    @if($question4->question_type == 'text-image')
                      <tr>                        
                      <img src="{{asset('questions/' . $question4->graphic)}}" alt="questionImage" width="1200" height="250">                        
                      </tr>
                      <tr>
                        <td><p class="bold-font-qst">{!! $question4->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @else
                      <tr>                        
                        <td><p class="bold-font-qst">{!! $question4->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @endif
                      <tr>
                      <td><input type="submit" name="option{{ $questionNo['q4'] }}A" id="option{{ $questionNo['q4'] }}A" value="A" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q4'] }}B" id="option{{ $questionNo['q4'] }}B" value="B" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q4'] }}C" id="option{{ $questionNo['q4'] }}C" value="C" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q4'] }}D" id="option{{ $questionNo['q4'] }}D" value="D" class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <hr>
                        <!-- <p><span class="bold-font-text">Selected Answer:</span>  -->
                        <!-- <span class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a4']} }}</span> -->
                        <span id="answer4" class="bold-font-ans"></span>
                        </p>
                        <input type="hidden" name="q4" id="questionNumber" value="{{ $questionNo['q4'] }}">

                        </td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->
           <!-- begin card -->
           <div class="col-12 grid-margin" id="question5">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q5'] }} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                    @if($question5->question_type == 'text-image')
                      <tr>                        
                      <img src="{{asset('questions/' . $question5->graphic)}}" alt="questionImage" width="1200" height="250">                        
                      </tr>
                      <tr>
                        <td><p class="bold-font-qst">{!! $question5->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @else
                      <tr>                        
                        <td><p class="bold-font-qst">{!! $question5->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @endif
                      <tr>
                      <td><input type="submit" name="option{{ $questionNo['q5'] }}A" id="option{{ $questionNo['q5'] }}A" value="A" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q5'] }}B" id="option{{ $questionNo['q5'] }}B" value="B" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q5'] }}C" id="option{{ $questionNo['q5'] }}C" value="C" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q5'] }}D" id="option{{ $questionNo['q5'] }}D" value="D" class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <hr>
                        <!-- <p><span class="bold-font-text">Selected Answer:</span>  -->
                        <!-- <span class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a5']} }}</span> -->
                        <span id="answer5" class="bold-font-ans"></span>
                        </p>
                        <input type="hidden" name="q5" id="questionNumber" value="{{ $questionNo['q5'] }}">
                        </td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->
           <!-- begin card -->
           <div class="col-12 grid-margin" id="question6">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {!! $questionNo['q6'] !!} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                    @if($question6->question_type == 'text-image')
                      <tr>                        
                      <img src="{{asset('questions/' . $question6->graphic)}}" alt="questionImage" width="1200" height="250">                        
                      </tr>
                      <tr>
                        <td><p class="bold-font-qst">{!! $question6->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @else
                      <tr>                        
                        <td><p class="bold-font-qst">{!! $question6->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @endif
                      <tr>
                      <td><input type="submit" name="option{{ $questionNo['q6'] }}A" id="option{{ $questionNo['q6'] }}A" value="A" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q6'] }}B" id="option{{ $questionNo['q6'] }}B" value="B"  class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q6'] }}C" id="option{{ $questionNo['q6'] }}C" value="C"  class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q6'] }}D" id="option{{ $questionNo['q6'] }}D" value="D"  class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <hr>
                        <!-- <p><span class="bold-font-text">Selected Answer:</span>  -->
                        <!-- <span class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a6']} }}</span> -->
                        <span id="answer6" class="bold-font-ans"></span>
                        </p>
                        <input type="hidden" name="q6" id="questionNumber" value="{{ $questionNo['q6'] }}">
                        </td>
                        <td></td>
                      </tr>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->
           <!-- begin card -->
           <div class="col-12 grid-margin" id="question7">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {!! $questionNo['q7'] !!} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                    @if($question7->question_type == 'text-image')
                      <tr>                        
                      <img src="{{asset('questions/' . $question7->graphic)}}" alt="questionImage" width="1200" height="250">                        
                      </tr>
                      <tr>
                        <td><p class="bold-font-qst">{!! $question7->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @else
                      <tr>                        
                        <td><p class="bold-font-qst">{!! $question7->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @endif
                      <tr>
                      <td><input type="submit" name="option{{ $questionNo['q7'] }}A" id="option{{ $questionNo['q7'] }}A" value="A"  class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q7'] }}B" id="option{{ $questionNo['q7'] }}B" value="B" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q7'] }}C" id="option{{ $questionNo['q7'] }}C" value="C" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q7'] }}D" id="option{{ $questionNo['q7'] }}D" value="D" class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <hr>
                        <!-- <p><span class="bold-font-text">Selected Answer:</span>  -->
                        <!-- <span class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a7']} }}</span> -->
                        <span id="answer7" class="bold-font-ans"></span>
                        </p>
                        <input type="hidden" name="q7" id="questionNumber" value="{{ $questionNo['q7'] }}">
                        </td>
                        <td></td>
                      </tr>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->
           <!-- begin card -->
           <div class="col-12 grid-margin" id="question8">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {!! $questionNo['q8'] !!} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                    @if($question8->question_type == 'text-image')
                      <tr>                        
                      <img src="{{asset('questions/' . $question8->graphic)}}" alt="questionImage" width="1200" height="250">                        
                      </tr>
                      <tr>
                        <td><p class="bold-font-qst">{!! $question8->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @else
                      <tr>                        
                        <td><p class="bold-font-qst">{!! $question8->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @endif
                      <tr>
                      <td><input type="submit" name="option{{ $questionNo['q8'] }}A" id="option{{ $questionNo['q8'] }}A" value="A" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q8'] }}B" id="option{{ $questionNo['q8'] }}B" value="B" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q8'] }}C" id="option{{ $questionNo['q8'] }}C" value="C" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q8'] }}D" id="option{{ $questionNo['q8'] }}D" value="D"class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <hr>
                        <!-- <p><span class="bold-font-text">Selected Answer:</span>  -->
                        <!-- <span class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a8']} }}</span> -->
                        <span id="answer8" class="bold-font-ans"></span>
                        </p>
                        <input type="hidden"  name="q8" id="questionNumber" value="{{ $questionNo['q8'] }}">
                        </td>
                        <td></td>
                      </tr>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->
           <!-- begin card -->
           <div class="col-12 grid-margin" id="question9">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {!! $questionNo['q9'] !!} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                    @if($question9->question_type == 'text-image')
                      <tr>                        
                      <img src="{{asset('questions/' . $question9->graphic)}}" alt="questionImage" width="1200" height="250">                        
                      </tr>
                      <tr>
                        <td><p class="bold-font-qst">{!! $question9->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @else
                      <tr>                        
                        <td><p class="bold-font-qst">{!! $question9->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @endif
                      <tr>
                      <td><input type="submit" name="option{{ $questionNo['q9'] }}A" id="option{{ $questionNo['q9'] }}A" value="A" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q9'] }}B" id="option{{ $questionNo['q9'] }}B" value="B" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q9'] }}C" id="option{{ $questionNo['q9'] }}C" value="C" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q9'] }}D" id="option{{ $questionNo['q9'] }}D" value="D" class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <hr>
                        <!-- <p><span class="bold-font-text">Selected Answer:</span>  -->
                        <!-- <span class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a9']} }}</span> -->
                        <span id="answer9" class="bold-font-ans"></span>
                        </p>
                        <input type="hidden" name="q9" id="questionNumber" value="{{ $questionNo['q9'] }}">
                        </td>
                        <td></td>
                      </tr>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->
           <!-- begin card -->
           <div class="col-12 grid-margin" id="question10">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {!! $questionNo['q10'] !!} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                    @if($question10->question_type == 'text-image')
                      <tr>                        
                      <img src="{{asset('questions/' . $question10->graphic)}}" alt="questionImage" width="1200" height="250">                        
                      </tr>
                      <tr>
                        <td><p class="bold-font-qst">{!! $question10->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @else
                      <tr>                        
                        <td><p class="bold-font-qst">{!! $question10->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @endif
                      <tr>
                      <td><input type="submit" name="option{{ $questionNo['q10'] }}A" id="option{{ $questionNo['q10'] }}A" value="A" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q10'] }}B" id="option{{ $questionNo['q10'] }}B" value="B" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q10'] }}C" id="option{{ $questionNo['q10'] }}C" value="C" class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option{{ $questionNo['q10'] }}D" id="option{{ $questionNo['q10'] }}D" value="D" class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <hr>
                        <!-- <p><span class="bold-font-text">Selected Answer:</span>  -->
                        <!-- <span class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a10']} }}</span> -->
                        <span id="answer10" class="bold-font-ans"></span>
                        </p>
                        <input type="hidden" name="q10" id="questionNumber" value="{{ $questionNo['q10'] }}">
                        </td>
                        <td></td>
                      </tr>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->     
           <input type="hidden" name="btn_action" id="btn_action" />    
           <input type="hidden" name="pageNo" value ="{{$pageNo}}">
  </form>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript"> 
    // Assuming jQuery is included in your project
    $(document).ready(function() {

        $('input[type="submit"]').click(function(event) {
            event.preventDefault(); // Prevent the default form submission

            var optionName = $(this).attr('name');
            var selectedOption = $(this).val(); 
            console.log("OptionName:", optionName);
            console.log("SelectedOption:", selectedOption);       

            // Extract the question number from optionName
            var number = optionName.match(/\d+/)[0];
            var pageNumber = {{$pageNo}};
            console.log("Question number:", number);
            console.log("Page Number:", pageNumber);

            // Send AJAX request
            $.ajax({
                url: "{{ route('update-answers', ['id' => $studentData->id, 'pageNo' => $pageNo]) }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    optionName: optionName,
                    selectedOption: selectedOption,
                    number: number
                },
                success: function(response) {
                     // Log the response
                     console.log('Response:', response);

                    // Extract data from the response
                    var questionNumber = response.questionNumber;
                    var updatedOption = response.selectedOption;
                    var answerData = response.answerData;

                    // Log extracted data to verify
                    console.log("questionNumber:", questionNumber);
                    console.log("updatedOption:", updatedOption);
                    console.log("answerData:", answerData);

                    // Ensure answerData is defined before attempting to access it
                    if (answerData) {
                        // Update the <span> elements with the received data
                        $('#questionNoDisplay').text(questionNumber);
                        $('#updatedOptionDisplay').text(updatedOption);

                        // Update individual answers
                        $('#answer1').text('Selected Answer: ' + (answerData['a1'] || ''));
                        $('#answer2').text('Selected Answer: ' + (answerData['a2'] || ''));
                        $('#answer3').text('Selected Answer: ' + (answerData['a3'] || ''));
                        $('#answer4').text('Selected Answer: ' + (answerData['a4'] || ''));
                        $('#answer5').text('Selected Answer: ' + (answerData['a5'] || ''));
                        $('#answer6').text('Selected Answer: ' + (answerData['a6'] || ''));
                        $('#answer7').text('Selected Answer: ' + (answerData['a7'] || ''));
                        $('#answer8').text('Selected Answer: ' + (answerData['a8'] || ''));
                        $('#answer9').text('Selected Answer: ' + (answerData['a9'] || ''));
                        $('#answer10').text('Selected Answer: ' + (answerData['a10'] || ''));
                    } else {
                        console.error('answerData is not defined in the response');
                    }
                    console.log('Answer updated successfully');
                },
                error: function(xhr, status, error) {
                    console.error('Error updating answer:', error);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
    // Function to handle click event for loading answers
    $('button.btn.btn-info').click(function(event) {
        event.preventDefault(); // Prevent the default button behavior

        // Send AJAX request to fetch answers
        var pageNo = $(this).attr('id');
        
        $.ajax({
            url: "{{ route('fetch-answers', ['id' => $studentData->id, 'pageNo' => $pageNo]) }}",
            method: 'GET',
            success: function(response) {
                console.log('Answers for page', pageNo, ':', response);

                // Update the UI with the retrieved answers
                updateAnswersUI(response.answerData);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching answers:', error);
            }
        });
    });

    // Function to update UI with answers
    function updateAnswersUI(answerData) {
        $('#answer1').text('Selected Answer: ' + (answerData['a1'] || ''));
        $('#answer2').text('Selected Answer: ' + (answerData['a2'] || ''));
        $('#answer3').text('Selected Answer: ' + (answerData['a3'] || ''));
        $('#answer4').text('Selected Answer: ' + (answerData['a4'] || ''));
        $('#answer5').text('Selected Answer: ' + (answerData['a5'] || ''));
        $('#answer6').text('Selected Answer: ' + (answerData['a6'] || ''));
        $('#answer7').text('Selected Answer: ' + (answerData['a7'] || ''));
        $('#answer8').text('Selected Answer: ' + (answerData['a8'] || ''));
        $('#answer9').text('Selected Answer: ' + (answerData['a9'] || ''));
        $('#answer10').text('Selected Answer: ' + (answerData['a10'] || ''));
    }
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
</body>


<!-- Mirrored from www.urbanui.com/melody/template/pages/layout/sidebar-fixed.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:05:56 GMT -->
</html>
