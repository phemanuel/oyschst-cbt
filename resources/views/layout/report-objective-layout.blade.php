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

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<style>
.result-btn-wrapper{
    position: relative;
    display: inline-block;
}

.result-btn{
    padding: 6px 12px;
    font-size: 13px;
    font-weight: 600;
}

.result-ribbon{
    position: absolute;
    top: -6px;
    right: -12px;
    min-width: 22px;
    height: 18px;
    line-height: 18px;
    padding: 0 5px;
    font-size: 11px;
    font-weight: 700;
    color: #fff;
    text-align: center;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    animation: popIn 0.3s ease;
}

/* Colors */
.bg-red{ background:#d9534f; }
.bg-blue{ background:#0275d8; }
.bg-green{ background:#5cb85c; }

/* Disabled state */
.result-btn.disabled{
    pointer-events: none;
    opacity: 0.6;
    cursor: not-allowed;
}

@keyframes popIn {
    from { transform: scale(0.7); opacity: 0; }
    to   { transform: scale(1); opacity: 1; }
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
        </li> 
        <li>
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
        <li class="active">
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
        Report Objective     
       <small><h4>(Note: You can search by Programme, Academic Session and Exam Type)</h4></small> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li> 
        <li><a href="{{route('report')}}">Report</a></li>
        <li class="active">Report Objective</li>
      </ol>
    </section>
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
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
              <form action="{{route('report-objective-view-all')}}" method="post">
                @csrf
                <div class="panel panel-default">
                  <div class="panel-heading">
                      <h4>
                          <i class="fa fa-filter text-primary"></i> Filter Exam Results
                      </h4>
                      <small class="text-muted">Select filters to refine the results. Leave blank to show all.</small>
                  </div>
                  <div class="panel-body">
                      <div class="row">

                          <!-- Academic Session -->
                          <div class="col-md-3 mb-2">
                              <label class="text-primary">
                                  <i class="fa fa-calendar"></i> Academic Session
                              </label>
                              <div class="input-group">
                                  <span class="input-group-addon bg-primary text-white">
                                      <i class="fa fa-search"></i>
                                  </span>                                 
                  <select name="session1" id="filter-session1" class="form-control"></select>
              
                              </div>
                          </div>

                          <!-- Programme -->
                          <div class="col-md-3 mb-2">
                              <label class="text-success">
                                  <i class="fa fa-graduation-cap"></i> Programme
                              </label>
                              <div class="input-group">
                                  <span class="input-group-addon bg-success text-white">
                                      <i class="fa fa-search"></i>
                                  </span>
                                  <select name="department" id="filter-department" class="form-control">
                                      <option value="">All</option>
                                      @foreach($dept as $rd)
                                          <option value="{{ $rd->department }}">{{ $rd->department }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>

                          <!-- Level -->
                          <div class="col-md-2 mb-2">
                              <label class="text-warning">
                                  <i class="fa fa-line-chart"></i> Level
                              </label>
                              <div class="input-group">
                                  <span class="input-group-addon bg-warning text-white">
                                      <i class="fa fa-search"></i>
                                  </span>
                                  <select name="level" id="filter-level" class="form-control">
                                      <option value="">All</option>
                                      @foreach($class as $rd)
                                          <option value="{{ $rd->level }}">{{ $rd->level }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>

                          <!-- Exam Type -->
                          <div class="col-md-2 mb-2">
                              <label class="text-danger">
                                  <i class="fa fa-file-text"></i> Exam Type
                              </label>
                              <div class="input-group">
                                  <span class="input-group-addon bg-danger text-white">
                                      <i class="fa fa-search"></i>
                                  </span>
                                  <select name="exam_type" id="filter-examtype" class="form-control">
                                      <option value="">All</option>
                                      @foreach($examType as $rd)
                                          <option value="{{ $rd->exam_type }}">{{ $rd->exam_type }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>

                      </div>

                      <!-- Clear Filters Button -->
                      <div class="text-right mt-2">
                          <button class="btn btn-xs btn-danger" id="clearFiltersExam">
                              <i class="fa fa-times-circle"></i> Clear Filters
                          </button>
                      </div>
                  </div>
              </div>

              </form>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                <!-- <a href="#" class="btn btn-info">Upload Question</a> -->
                </div>
              </div>
              <hr>
              <div class="box-header">
              <h3 class="box-title"></h3>
              <div class="box-tools">
              <!-- <form action="{{ route('report-search') }}" method="post" class="form-inline">
                @csrf
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="search" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                    <button type="submit" class="btn btn-success">Search</button>
                    </div>
                </div>
            </form> -->
              </div>
  </div>
             
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">

            <div id="question-settings-table">
                @include('partials.question-settings-table', ['questionSetting' => $questionSetting])
            </div>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    var select = document.getElementById('filter-session');
    var currentYear = new Date().getFullYear();
    var numberOfSessions = 10; // last 10 sessions

    for (var i = 0; i < numberOfSessions; i++) {
        var startYear = currentYear - i;
        var endYear = startYear + 1;
        var sessionText = startYear + '/' + endYear;
        var option = document.createElement('option');
        option.value = sessionText;
        option.text = sessionText;
        select.appendChild(option);
    }
});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    function fetchFilteredData() {
        var session1 = $('#filter-session').val();
        var department = $('#filter-department').val();
        var level = $('#filter-level').val();
        var exam_type = $('#filter-examtype').val();

        $.ajax({
            url: "{{ route('report-objective-filter') }}",
            method: "GET",
            data: {
                session1: session1,
                department: department,
                level: level,
                exam_type: exam_type
            },
            success: function(response) {
                $('#question-settings-table').html(response);
            }
        });
    }

    // Trigger AJAX when filters change
    $('#filter-session, #filter-department, #filter-level, #filter-examtype').on('change', fetchFilteredData);

    // Clear Filters Button
    $('#clearFiltersExam').on('click', function(e) {
        e.preventDefault();

        // Reset all selects to default
        $('#filter-session').val('');
        $('#filter-department').val('');
        $('#filter-level').val('');
        $('#filter-examtype').val('');

        // Fetch data with all filters cleared
        fetchFilteredData();
    });

});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var select = document.getElementById('filter-session1');
    var currentYear = new Date().getFullYear();
    var numberOfSessions = 10; // last 10 sessions

    for (var i = 0; i < numberOfSessions; i++) {
        var startYear = currentYear - i;
        var endYear = startYear + 1;
        var sessionText = startYear + '/' + endYear;
        var option = document.createElement('option');
        option.value = sessionText;
        option.text = sessionText;
        select.appendChild(option);
    }
});
</script>
<script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.result-ribbon').forEach(badge => {
        let target = parseInt(badge.dataset.count);
        let current = 0;
        let step = Math.max(1, Math.ceil(target / 15));

        let interval = setInterval(() => {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(interval);
            }
            badge.textContent = current;
        }, 25);
    });
});
</script>

</script>

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
