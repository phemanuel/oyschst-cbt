<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('pageTitle')</title>
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
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{asset('dashboard/bower_components/fullcalendar/dist/fullcalendar.min.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/bower_components/fullcalendar/dist/fullcalendar.print.min.css')}}" media="print">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="{{ asset('css/tooltipster.bundle.min.css') }}" />

<style>
  .admin-box {
    background: linear-gradient(135deg, #00c6ff, #0072ff);
    color: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    overflow: hidden;
}

.admin-box:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.25);
}

.admin-box .inner h3 {
    font-size: 34px;
    font-weight: 700;
    margin-bottom: 5px;
}

.admin-box .inner p {
    font-size: 15px;
    opacity: 0.95;
}

.admin-box .icon {
    font-size: 70px;
    opacity: 0.25;
    top: 10px;
}

.admin-box .small-box-footer {
    background: rgba(0,0,0,0.15);
    color: #fff;
    font-weight: 500;
    padding: 10px;
    transition: background 0.2s ease;
}

.admin-box .small-box-footer:hover {
    background: rgba(0,0,0,0.25);
}

</style>
<style>
  .students-box {
    background: linear-gradient(135deg, #28a745, #1e7e34);
    color: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    overflow: hidden;
}

.students-box:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.25);
}

.students-box .inner h3 {
    font-size: 34px;
    font-weight: 700;
    margin-bottom: 5px;
}

.students-box .inner p {
    font-size: 15px;
    opacity: 0.95;
}

.students-box .icon {
    font-size: 70px;
    opacity: 0.25;
    top: 10px;
}

.students-box .small-box-footer {
    background: rgba(0,0,0,0.15);
    color: #fff;
    font-weight: 500;
    padding: 10px;
    transition: background 0.2s ease;
}

.students-box .small-box-footer:hover {
    background: rgba(0,0,0,0.25);
}

</style>
<style>
  .questions-box {
    background: linear-gradient(135deg, #f1c40f, #d4ac0d);
    color: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    overflow: hidden;
}

.questions-box:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.25);
}

.questions-box .inner h3 {
    font-size: 34px;
    font-weight: 700;
    margin-bottom: 5px;
}

.questions-box .inner p {
    font-size: 15px;
    opacity: 0.95;
}

.questions-box .icon {
    font-size: 70px;
    opacity: 0.25;
    top: 10px;
}

.questions-box .small-box-footer {
    background: rgba(0,0,0,0.15);
    color: #fff;
    font-weight: 500;
    padding: 10px;
    transition: background 0.2s ease;
}

.questions-box .small-box-footer:hover {
    background: rgba(0,0,0,0.25);
}

</style>
<style>
  .programmes-box {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    overflow: hidden;
}

.programmes-box:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.25);
}

.programmes-box .inner h3 {
    font-size: 34px;
    font-weight: 700;
    margin-bottom: 5px;
}

.programmes-box .inner p {
    font-size: 15px;
    opacity: 0.95;
}

.programmes-box .icon {
    font-size: 70px;
    opacity: 0.25;
    top: 10px;
}

.programmes-box .small-box-footer {
    background: rgba(0,0,0,0.18);
    color: #fff;
    font-weight: 500;
    padding: 10px;
    transition: background 0.2s ease;
}

.programmes-box .small-box-footer:hover {
    background: rgba(0,0,0,0.28);
}

</style>
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
          <img src="dashboard/dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{auth()->user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        <li class="active">
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
        </li> <li>
          <a href="{{route('student-list')}}">
            <i class="fa fa-book"></i> <span>Student List/Upload</span>
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
        Dashboard        
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    @if(session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
          @elseif(session('error'))
						<div class="alert alert-danger">
							{{ session('error') }}
						</div>
						@endif	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box admin-box">
                <div class="inner">
                    <h3>{{ $users->count() }}</h3>
                    <p>Admin Users</p>
                </div>

                <div class="icon">
                    <i class="fa fa-users-cog"></i>
                </div>

                <a href="{{ route('users') }}" class="small-box-footer">
                    Manage Admins <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <div class="small-box students-box">
                <div class="inner">
                    <h3>{{ $students->count() }}</h3>
                    <p>Students</p>
                </div>

                <div class="icon">
                    <i class="fa fa-user-graduate"></i>
                </div>

                <a href="{{ route('student-list') }}" class="small-box-footer">
                    View Students <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <div class="small-box questions-box">
                <div class="inner">
                    <h3>{{ $questions->count() }}</h3>
                    <p>Questions</p>
                </div>

                <div class="icon">
                    <i class="fa fa-question"></i>
                </div>

                <a href="{{ route('question') }}" class="small-box-footer">
                    Manage Questions <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <div class="small-box programmes-box">
                <div class="inner">
                    <h3>{{ $departments->count() }}</h3>
                    <p>Programmes</p>
                </div>

                <div class="icon">
                    <i class="fa fa-sitemap"></i>
                </div>

                <a href="{{ route('college-setup') }}" class="small-box-footer">
                    Manage Programmes <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

     <!-- Main content -->
     <section class="content">
    <div class="row">

        <!-- Sidebar: Current Exam Dates -->
        <div class="col-md-3">
            <div class="card shadow-sm mb-3 border-0" style="background: linear-gradient(135deg, #6C5B7B, #355C7D); color: #fff;">
                <div class="card-header bg-transparent border-0">
                    <h5 class="mb-0">
                        <i class="mdi mdi-calendar-check"></i> Current Exam Dates
                    </h5>
                </div>
                <div class="card-body p-2" style="max-height: 400px; overflow-y: auto;">
                    <div id="external-events">
                        <!-- Example placeholder events -->
                        <div class="external-event p-2 rounded mb-2" style="background-color: #F67280; color: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); cursor: pointer;">
                            Math 101 - 25 Jan 2026
                        </div>
                        <div class="external-event p-2 rounded mb-2" style="background-color: #C06C84; color: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); cursor: pointer;">
                            Physics 201 - 28 Jan 2026
                        </div>
                    </div>
                    <small class="d-block mt-2 text-white-50">
                        Drag events onto the calendar if needed.
                    </small>
                </div>
            </div>
        </div>


        <!-- Calendar -->
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">
                        <i class="mdi mdi-calendar-month"></i> Exam Calendar
                    </h3>
                </div>
                <div class="card-body p-2">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

    </div>
</section>

    <!-- /.content -->
  </div>
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
<!-- fullCalendar -->
<script src="{{asset('dashboard/bower_components/moment/moment.js')}}"></script>
<script src="{{asset('dashboard/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<!-- Page specific script -->

<script>
  $(function () {

    function fetchExamDates() {
        return $.ajax({
            url: '/exam-dates',
            method: 'GET',
            dataType: 'json'
        });
    }

    fetchExamDates().done(function(examDates) {

        // Sort upcoming exams: nearest date first
        examDates.sort((a, b) => new Date(b.start) - new Date(a.start));

        // Pastel / modern gradient colors
        const colors = ['#FF6B6B', '#6BCB77', '#4D96FF', '#FFD93D', '#845EC2', '#FF9671'];

        // Sidebar: clear previous events
        const $sidebar = $('#external-events');
        $sidebar.empty();

        examDates.forEach((event, index) => {
            // Assign pastel colors and ensure FullCalendar uses them
            const color = colors[index % colors.length];
            event.backgroundColor = color;
            event.borderColor = color;

            const $eventDiv = $(`
                <div class="external-event list-group-item mb-2 rounded" 
                     style="background-color: ${color}; color:#fff; cursor:pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <strong>${event.title}</strong>
                    <br>
                    <small>${moment(event.start).format('DD MMM YYYY')}</small>
                </div>
            `);
            $sidebar.append($eventDiv);

            // Make events draggable
            $eventDiv.data('eventObject', event);
            $eventDiv.draggable({
                zIndex: 999,
                revert: true,
                revertDuration: 0
            });

            // Tooltipster for sidebar events
            $eventDiv.tooltipster({
                content: `<strong>${event.title}</strong><br>${event.description || ''}`,
                theme: 'tooltipster-light',
                interactive: true,
                delay: 100
            });
        });

        // Initialize FullCalendar
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
                today: 'Today',
                month: 'Month',
                week: 'Week',
                day: 'Day'
            },
            events: examDates,
            editable: true,
            droppable: true,
            height: 550,
            fixedWeekCount: false,
            weekNumbers: false,
            navLinks: true,
            defaultView: 'month',
            eventRender: function(event, element) {
                // Force pastel color and tooltip
                element.css({
                    'background-color': event.backgroundColor,
                    'border-color': event.borderColor,
                    'color': '#fff'
                });

                element.tooltipster({
                    content: `<div><strong>${event.title}</strong><br>${event.description || ''}</div>`,
                    theme: 'tooltipster-light',
                    interactive: true,
                    delay: 100
                });
            },
            drop: function(date, allDay) {
                var originalEventObject = $(this).data('eventObject');
                var copiedEventObject = $.extend({}, originalEventObject);
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                copiedEventObject.backgroundColor = $(this).css('background-color');
                copiedEventObject.borderColor = $(this).css('border-color');
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                if ($('#drop-remove').is(':checked')) {
                    $(this).remove();
                }
            }
        });

    }).fail(function() {
        alert('Failed to fetch exam dates.');
    });

});

</script>
<script src="{{ asset('js/tooltipster.bundle.min.js') }}"></script>
</body>
</html>
