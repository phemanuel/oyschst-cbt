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
              <button type="button" name="1" id="1"  class="btn btn-success">Question 1-10</button>
              <!-- <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">Question 1-10</a>            -->
          </li>
          @elseif($examSetting->no_of_qst == 20)
          <li class="nav-item">            
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <button type="button" name="1" id="1"  class="btn btn-success">Question 1-10</button>              
            </li>
          <li class="nav-item">           
              <i class=""></i>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;              
              <button type="button" name="2" id="2"  class="btn btn-success">Question 11-20</button>
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
                    <td> <button type="button" name="{{$pageNo}}" id="{{$pageNo}}"  class="btn btn-info">Load Answers</button></td>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

                // Iterate through fetched questions and render them
                $.each(response.qstData, function(key, question) {
                    var questionNumber = key.replace('qst', '');
                    var graphic = response.graphicData['g' + questionNumber];
                    var questionType = response.qstType['qt' + questionNumber];
                    var answer = response.answerData['a' + questionNumber];

                    var questionHtml = `
                        <form class="answer-form" data-page-no="${response.pageNo}" data-question-number="${questionNumber}">
                            @csrf
                            <div class="col-12 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card
                                        <h4 class="card-title">
                                            <strong>Question ${questionNumber} </strong>
                                        </h4>
                                        <div class="table-responsive">
                                            <table class="table" width="100%">
                                                ${questionType === 'text-image' && graphic ? `<tr><td colspan="3"><img src="${graphic}" alt="questionImage" width="1200" height="250"></td></tr>` : ''}
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
</body>



</html>
