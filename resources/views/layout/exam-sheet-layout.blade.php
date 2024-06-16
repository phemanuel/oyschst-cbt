<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('pageTitle')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="{{ asset('/favicon.png') }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('dashboard/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('dashboard/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('dashboard/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dashboard/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dashboard/dist/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('dashboard/bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('dashboard/bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('dashboard/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('dashboard/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('dashboard/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
   <style>
    .bold-text {
    font-size: 18px;
    font-weight: bold;
    color: white;
}

    .bold-text-font {
    font-size: 14px;
    font-weight: bold;    
}

    .bold-font-ans-std {
    font-size: 20px;
    font-weight: bold;
    color : blue;
}

.bold-font-ans-cor {
    font-size: 20px;
    font-weight: bold;
    color : green;
}
  </style>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{route('admin-dashboard')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>dmin</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="{{asset($collegeSetup->avatar)}}" alt="College Logo" width="30" height="30"> <b>Admin</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav"> 
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('dashboard/dist/img/avatar5.png')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{auth()->user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('dashboard/dist/img/avatar5.png')}}" class="img-circle" alt="User Image">

                <p>
                  {{auth()->user()->name}}
                  <small>Signed in</small>
                </p>
              </li>
              
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{route('logout')}}" class="btn btn-default btn-flat">Log out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('dashboard/dist/img/avatar5.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{auth()->user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        <li>
          <a href="{{route('admin-dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>          
        </li>
        <li>
          <a href="{{route('exam-setting')}}">
            <i class="fa fa-th"></i> <span>Exam Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li> <li>
          <a href="{{route('question')}}">
            <i class="fa fa-share"></i> <span>Question Bank</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="active">
          <a href="{{route('student-list')}}">
            <i class="fa fa-book"></i> <span>Student</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li>
          <a href="{{route('login-status')}}">
            <i class="fa fa-user"></i> <span>Student Login/Exam Status</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>  <li>
          <a href="{{route('change-course')}}">
            <i class="fa fa-laptop"></i> <span>Change of Course</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li>
          <a href="{{route('users')}}">
            <i class="fa fa-user"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>          
        </li>
        <li>
          <a href="{{route('admin-setup')}}">
            <i class="fa fa-table"></i> <span>Admin Setup</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li>
          <a href="{{route('report')}}">
            <i class="fa fa-folder"></i> <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li>
          <a href="{{route('logout')}}">
            <i class="fa fa-power-off"></i> <span>Logout</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Exam Sheet              
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active">Exam Sheet</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="box-header">
              <h3 class="box-title"></h3>
              
              <div class="col-12 grid-margin">            
              <div class="card">
                <div class="card-body">
                  @if($noOfQst == 10)
                    <a href="{{route('exam-sheet-page1', ['id' => $qstData->id])}}" class="btn btn-success">1-10</a>                  
                  @elseif($noOfQst == 20)
                    <a href="{{route('exam-sheet-page1', ['id' => $qstData->id])}}" class="btn btn-success">1-10</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page2', ['id' => $qstData->id])}}" class="btn btn-success">11-20</a>                  
                  @elseif($noOfQst == 30)
                    <a href="{{route('exam-sheet-page1', ['id' => $qstData->id])}}" class="btn btn-success">1-10</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheett-page2', ['id' => $qstData->id])}}" class="btn btn-success">11-20</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page3', ['id' => $qstData->id])}}" class="btn btn-success">21-30</a>  
                  @elseif($noOfQst == 40)
                    <a href="{{route('exam-sheet-page1', ['id' => $qstData->id])}}" class="btn btn-success">1-10</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page2', ['id' => $qstData->id])}}" class="btn btn-success">11-20</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page3', ['id' => $qstData->id])}}" class="btn btn-success">21-30</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page4', ['id' => $qstData->id])}}" class="btn btn-success">31-40</a>   
                  @elseif($noOfQst == 50)
                    <a href="{{route('exam-sheet-page1', ['id' => $qstData->id])}}" class="btn btn-success">1-10</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page2', ['id' => $qstData->id])}}" class="btn btn-success">11-20</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page3', ['id' => $qstData->id])}}" class="btn btn-success">21-30</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page4', ['id' => $qstData->id])}}" class="btn btn-success">31-40</a>&nbsp; &nbsp; 
                    <a href="{{route('exam-sheet-page5', ['id' => $qstData->id])}}" class="btn btn-success">41-50</a>  
                  @elseif($noOfQst == 60)
                    <a href="{{route('exam-sheet-page1', ['id' => $qstData->id])}}" class="btn btn-success">1-10</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page2', ['id' => $qstData->id])}}" class="btn btn-success">11-20</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page3', ['id' => $qstData->id])}}" class="btn btn-success">21-30</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page4', ['id' => $qstData->id])}}" class="btn btn-success">31-40</a>&nbsp; &nbsp; 
                    <a href="{{route('exam-sheet-page5', ['id' => $qstData->id])}}" class="btn btn-success">41-50</a>&nbsp; &nbsp; 
                    <a href="{{route('exam-sheet-page6', ['id' => $qstData->id])}}" class="btn btn-success">51-60</a>  
                  @elseif($noOfQst == 70)
                    <a href="{{route('exam-sheet-page1', ['id' => $qstData->id])}}" class="btn btn-success">1-10</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page2', ['id' => $qstData->id])}}" class="btn btn-success">11-20</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page3', ['id' => $qstData->id])}}" class="btn btn-success">21-30</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page4', ['id' => $qstData->id])}}" class="btn btn-success">31-40</a>&nbsp; &nbsp; 
                    <a href="{{route('exam-sheet-page5', ['id' => $qstData->id])}}" class="btn btn-success">41-50</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page6', ['id' => $qstData->id])}}" class="btn btn-success">51-60</a>&nbsp; &nbsp; 
                    <a href="{{route('exam-sheet-page7', ['id' => $qstData->id])}}" class="btn btn-success">61-70</a>   
                  @elseif($noOfQst == 80)
                    <a href="{{route('exam-sheet-page1', ['id' => $qstData->id])}}" class="btn btn-success">1-10</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page2', ['id' => $qstData->id])}}" class="btn btn-success">11-20</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page3', ['id' => $qstData->id])}}" class="btn btn-success">21-30</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page4', ['id' => $qstData->id])}}" class="btn btn-success">31-40</a>&nbsp; &nbsp; 
                    <a href="{{route('exam-sheet-page5', ['id' => $qstData->id])}}" class="btn btn-success">41-50</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page6', ['id' => $qstData->id])}}" class="btn btn-success">51-60</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page7', ['id' => $qstData->id])}}" class="btn btn-success">61-70</a>&nbsp; &nbsp;  
                    <a href="{{route('exam-sheet-page8', ['id' => $qstData->id])}}" class="btn btn-success">71-80</a> 
                  @elseif($noOfQst == 90)
                    <a href="{{route('exam-sheet-page1', ['id' => $qstData->id])}}" class="btn btn-success">1-10</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page2', ['id' => $qstData->id])}}" class="btn btn-success">11-20</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page3', ['id' => $qstData->id])}}" class="btn btn-success">21-30</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page4', ['id' => $qstData->id])}}" class="btn btn-success">31-40</a>&nbsp; &nbsp; 
                    <a href="{{route('exam-sheet-page5', ['id' => $qstData->id])}}" class="btn btn-success">41-50</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page6', ['id' => $qstData->id])}}" class="btn btn-success">51-60</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page7', ['id' => $qstData->id])}}" class="btn btn-success">61-70</a>&nbsp; &nbsp;  
                    <a href="{{route('exam-sheet-page8', ['id' => $qstData->id])}}" class="btn btn-success">71-80</a>&nbsp; &nbsp;  
                    <a href="{{route('exam-sheet-page9', ['id' => $qstData->id])}}" class="btn btn-success">81-90</a>   
                  @elseif($noOfQst == 100)
                    <a href="{{route('exam-sheet-page1', ['id' => $qstData->id])}}" class="btn btn-success">1-10</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page2', ['id' => $qstData->id])}}" class="btn btn-success">11-20</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page3', ['id' => $qstData->id])}}" class="btn btn-success">21-30</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page4', ['id' => $qstData->id])}}" class="btn btn-success">31-40</a>&nbsp; &nbsp; 
                    <a href="{{route('exam-sheet-page5', ['id' => $qstData->id])}}" class="btn btn-success">41-50</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page6', ['id' => $qstData->id])}}" class="btn btn-success">51-60</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page7', ['id' => $qstData->id])}}" class="btn btn-success">61-70</a>&nbsp; &nbsp;  
                    <a href="{{route('exam-sheet-page8', ['id' => $qstData->id])}}" class="btn btn-success">71-80</a>&nbsp; &nbsp;
                    <a href="{{route('exam-sheet-page9', ['id' => $qstData->id])}}" class="btn btn-success">81-90</a>&nbsp; &nbsp;  
                    <a href="{{route('exam-sheet-page10', ['id' => $qstData->id])}}" class="btn btn-success">91-100</a> 
                       
                  @endif                  
                </div>
            </div>
            </div>
              <hr>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
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
                        <p>
                        <span class="bold-font-ans-std">Selected Answer:</span> 
                        <span class="bold-font-ans-std">{{ $studentAnswer->{"OK" . $questionNo['a1']} }}</span> | 
                        <span class="bold-font-ans-cor">Correct Answer:</span> 
                        <span class="bold-font-ans-cor">{{ $correctAnswer->{"OK" . $questionNo['a1']} }}</span>
                        </p>
                       
                        </td>
                        <td></td>
                        <td></p></td>
                    </table>    
                    <!-- qst2 -->
                    <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q2'] }} </strong>
                  </h4>
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
                      <td width="82%">                      
                        <p>
                        <span class="bold-font-ans-std">Selected Answer:</span> 
                        <span class="bold-font-ans-std">{{ $studentAnswer->{"OK" . $questionNo['a2']} }}</span> | 
                        <span class="bold-font-ans-cor">Correct Answer:</span> 
                        <span class="bold-font-ans-cor">{{ $correctAnswer->{"OK" . $questionNo['a2']} }}</span>
                        </p>
                       
                        </td>
                        <td></td>
                        <td></p></td>
                    </table>   
                    
                    <!-- qst3 -->
                    <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q3'] }} </strong>
                  </h4>
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
                      <td width="82%">                      
                        <p>
                        <span class="bold-font-ans-std">Selected Answer:</span> 
                        <span class="bold-font-ans-std">{{ $studentAnswer->{"OK" . $questionNo['a3']} }}</span> | 
                        <span class="bold-font-ans-cor">Correct Answer:</span> 
                        <span class="bold-font-ans-cor">{{ $correctAnswer->{"OK" . $questionNo['a3']} }}</span>
                        </p>
                       
                        </td>
                        <td></td>
                        <td></p></td>
                    </table>     
                    
                    <!-- qst4 -->
                    <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q4'] }} </strong>
                  </h4>
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
                      <td width="82%">                      
                        <p>
                        <span class="bold-font-ans-std">Selected Answer:</span> 
                        <span class="bold-font-ans-std">{{ $studentAnswer->{"OK" . $questionNo['a4']} }}</span> | 
                        <span class="bold-font-ans-cor">Correct Answer:</span> 
                        <span class="bold-font-ans-cor">{{ $correctAnswer->{"OK" . $questionNo['a4']} }}</span>
                        </p>
                       
                        </td>
                        <td></td>
                        <td></p></td>
                    </table>  
                    
                    <!-- qst5 -->
                    <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q5'] }} </strong>
                  </h4>
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
                      <td width="82%">                      
                        <p>
                        <span class="bold-font-ans-std">Selected Answer:</span> 
                        <span class="bold-font-ans-std">{{ $studentAnswer->{"OK" . $questionNo['a5']} }}</span> | 
                        <span class="bold-font-ans-cor">Correct Answer:</span> 
                        <span class="bold-font-ans-cor">{{ $correctAnswer->{"OK" . $questionNo['a5']} }}</span>
                        </p>
                       
                        </td>
                        <td></td>
                        <td></p></td>
                    </table>  
                    
                    <!-- qst6 -->
                    <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q6'] }} </strong>
                  </h4>
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
                      <td width="82%">                      
                        <p>
                        <span class="bold-font-ans-std">Selected Answer:</span> 
                        <span class="bold-font-ans-std">{{ $studentAnswer->{"OK" . $questionNo['a6']} }}</span> | 
                        <span class="bold-font-ans-cor">Correct Answer:</span> 
                        <span class="bold-font-ans-cor">{{ $correctAnswer->{"OK" . $questionNo['a6']} }}</span>
                        </p>
                       
                        </td>
                        <td></td>
                        <td></p></td>
                    </table>  
                    
                    <!-- qst7 -->
                    <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q7'] }} </strong>
                  </h4>
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
                      <td width="82%">                      
                        <p>
                        <span class="bold-font-ans-std">Selected Answer:</span> 
                        <span class="bold-font-ans-std">{{ $studentAnswer->{"OK" . $questionNo['a7']} }}</span> | 
                        <span class="bold-font-ans-cor">Correct Answer:</span> 
                        <span class="bold-font-ans-cor">{{ $correctAnswer->{"OK" . $questionNo['a7']} }}</span>
                        </p>
                       
                        </td>
                        <td></td>
                        <td></p></td>
                    </table>  
                    
                    <!-- qst8 -->
                    <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q8'] }} </strong>
                  </h4>
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
                      <td width="82%">                      
                        <p>
                        <span class="bold-font-ans-std">Selected Answer:</span> 
                        <span class="bold-font-ans-std">{{ $studentAnswer->{"OK" . $questionNo['a8']} }}</span> | 
                        <span class="bold-font-ans-cor">Correct Answer:</span> 
                        <span class="bold-font-ans-cor">{{ $correctAnswer->{"OK" . $questionNo['a8']} }}</span>
                        </p>
                       
                        </td>
                        <td></td>
                        <td></p></td>
                    </table> 
                    
                    <!-- qst9 -->
                    <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q9'] }} </strong>
                  </h4>
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
                      <td width="82%">                      
                        <p>
                        <span class="bold-font-ans-std">Selected Answer:</span> 
                        <span class="bold-font-ans-std">{{ $studentAnswer->{"OK" . $questionNo['a9']} }}</span> | 
                        <span class="bold-font-ans-cor">Correct Answer:</span> 
                        <span class="bold-font-ans-cor">{{ $correctAnswer->{"OK" . $questionNo['a9']} }}</span>
                        </p>
                       
                        </td>
                        <td></td>
                        <td></p></td>
                    </table>  
                    
                    <!-- qst10 -->
                    <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q10'] }} </strong>
                  </h4>
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
                      <td width="82%">                      
                        <p>
                        <span class="bold-font-ans-std">Selected Answer:</span> 
                        <span class="bold-font-ans-std">{{ $studentAnswer->{"OK" . $questionNo['a10']} }}</span> | 
                        <span class="bold-font-ans-cor">Correct Answer:</span> 
                        <span class="bold-font-ans-cor">{{ $correctAnswer->{"OK" . $questionNo['a10']} }}</span>
                        </p>
                       
                        </td>
                        <td></td>
                        <td></p></td>
                    </table>     

                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  <div class="modal modal-info fade" id="modal-success">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Import Student List.</h4>
              </div>
              <div class="modal-body">
                <p>Importing students from a CSV (Comma Separated Values) file is a convenient way to bulk upload questions into a system. 
                Here's how the process typically works:
                </p>
                  <ul>
                    <li> Select the necessary criteria.</li>
                    <li> Load the CSV file <a class="btn btn-success" href="{{route('download-student-csv')}}">You can download a sample template here.</a></li>
                    <li> Click on import.</li>
                    <li> This will upload all students for the specified criteria.</li>
                    <li> You can edit each student as desired.</li>
                  </ul> 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <a href="{{route('student-import')}}" class="btn btn-outline">Proceed</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> {{$softwareVersion->version}}
    </div>
    <strong>&copy; 2020-<?php echo date('Y')  ?> <a target="_blank" href="{{$collegeSetup->web_url}}">{{$collegeSetup->name}}</a>.</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('dashboard/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('dashboard/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('dashboard/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{asset('dashboard/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('dashboard/bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('dashboard/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('dashboard/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('dashboard/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('dashboard/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('dashboard/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('dashboard/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('dashboard/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('dashboard/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('dashboard/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('dashboard/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dashboard/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dashboard/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dashboard/dist/js/demo.js')}}"></script>
</body>
</html>
