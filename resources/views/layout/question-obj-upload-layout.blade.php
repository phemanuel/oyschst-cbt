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
    /* Gradient and hover for danger button */
    .btn-danger.btn-gradient {
        background: linear-gradient(135deg, #dc3545, #c82333); /* Bootstrap danger colors */
        border: none;
        color: #fff;
        transition: all 0.3s ease;
    }
    .btn-danger.btn-gradient:hover {
        background: linear-gradient(135deg, #c82333, #dc3545);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        text-decoration: none;
        color: #fff;
    }

    /* Gradient and hover for success button */
    .btn-success.btn-gradient {
        background: linear-gradient(135deg, #28a745, #218838);
        border: none;
        color: #fff;
        transition: all 0.3s ease;
    }
    .btn-success.btn-gradient:hover {
        background: linear-gradient(135deg, #218838, #28a745);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        text-decoration: none;
        color: #fff;
    }

    /* Icon spacing */
    .btn-gradient i {
        margin-right: 5px;
    }
</style>

<style>
    /* Gradient style for info button */
    .btn-info.btn-gradient {
        background: linear-gradient(135deg, #28a745, #20c997); /* Green to teal */
        border: none;
        color: #fff;
        transition: all 0.3s ease;
    }

    .btn-info.btn-gradient:hover {
        background: linear-gradient(135deg, #20c997, #28a745);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        text-decoration: none;
        color: #fff;
    }

    .btn-info.btn-gradient i {
        margin-right: 6px;
    }
</style>
<style>
    /* Gradient for label */
    .label-gradient {
        background: linear-gradient(135deg, #28a745, #218838);
        color: #fff;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 4px;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .label-gradient:hover {
        background: linear-gradient(135deg, #218838, #28a745);
        text-decoration: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        transform: translateY(-2px);
        color: #fff;
    }

    /* Icon spacing */
    .label-gradient i {
        margin-right: 5px;
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
        <li class="active">
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
        Question Bank(Objective)       
       <small><h4>(Note: You can search by Academic Session,Programme,Exam Type or Exam Mode)</h4></small> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active">Question Bank(Objective)</li>
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
              <p><strong>Lock/Unlock Exam : This denies the user access to the exam.(To be done by the tutor in-charge)</p></strong>
              <p><strong>Enable Question : This add the question to the list of exam to be done for the day.(To be done by the admin)</p></strong>
              <!-- <a href="{{route('student-create')}}" class="btn btn-primary">Create Student</a> -->
              <div class="box-tools">                
                <div class="input-group input-group-sm" style="width: 150px;">
                <a href="{{ route('question-upload-obj') }}" class="btn btn-info btn-gradient shadow-sm">
                    <i class="fa fa-upload"></i> Upload Question
                </a>
                </div>
              </div>
              <hr>
              <div class="box-header">
              <h3 class="box-title"></h3>
              <div class="box-tools">
              <!-- <form action="{{ route('question-setting-search') }}" method="post" class="form-inline">
                @csrf
                <div class="input-group input-group-sm" style="width: 300px;">
                    <input type="text" name="search" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                    <button type="submit" class="btn btn-success">Search</button>
                    </div>
                </div>
            </form> -->
              </div>
  </div>
             
            <!-- /.box-header -->
            <div class="panel panel-default mb-4">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-search text-primary"></i>Filter Question Settings
                    </h4>
                    <small class="text-muted">
                        Type to filter results in real time
                    </small>
                </div>

                <div class="panel-body">
                    <div class="row">

                        <!-- Programme -->
                        <div class="col-md-4">
                            <label class="text-primary">
                                <i class="fa fa-graduation-cap"></i> Programme
                            </label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input
                                    type="text"
                                    id="searchProgramme"
                                    class="form-control"
                                    placeholder="Search Programme">
                            </div>
                        </div>

                        <!-- Exam Type -->
                        <div class="col-md-4">
                            <label class="text-success">
                                <i class="fa fa-file-text"></i> Exam Type
                            </label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input
                                    type="text"
                                    id="searchExamType"
                                    class="form-control"
                                    placeholder="Search Exam Type">
                            </div>
                        </div>

                        <!-- Level -->
                        <div class="col-md-4">
                            <label class="text-warning">
                                <i class="fa fa-line-chart"></i> Level
                            </label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input
                                    type="text"
                                    id="searchLevel"
                                    class="form-control"
                                    placeholder="Search Level">
                            </div>
                        </div>

                    </div>

                    <hr>

                    <div class="text-right">
                        <button class="btn btn-xs btn-danger" id="clearFilters">
                            <i class="fa fa-times-circle"></i> Clear Filters
                        </button>
                    </div>
                </div>
            </div>

              <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                <tr>
                  <!-- <th>ID</th> -->
                  <th>Actions</th>
                  <th></th>
                  <th>Lock/Unlock Exam</th>
                  <th>Status</th> 
                  <th>Academic Session</th>
                  <th>Programme</th>
                  <th>Course</th>
                  <th>Level</th>
                  <th>Semester</th>
                  <th>Exam View Type</th>
                  <th>Exam Mode</th>
                  <th>Exam Type</th>
                  <th>Exam Date</th>
                  <th>Total No of Questions</th>
                  <th>No of Questions(Student)</th>
                  <th>Duration</th>
                  <th>Check Result</th>
                  <th>Created On</th>              
                </tr>
              </thead>
 
                @if ($questionSetting->count() > 0)
                 <tbody>
                @foreach ($questionSetting as $key => $rs)
                @php
                        $isOwner = auth()->id() == $rs->lock_id;
                        $isSuperAdmin = auth()->user()->user_type == 'superadmin';
                    @endphp 
                    <td>
                    @if($isOwner || $isSuperAdmin)
                        <button type="button"
                    class="btn btn-danger btn-gradient shadow-sm delete-btn"
                    data-toggle="modal"
                    data-target="#deleteModal"
                    data-id="{{ $rs->id }}">
                <i class="fa fa-trash"></i> Delete
            </button>
                    @else
                        <span class="badge badge-secondary">Locked by another user</span>
                    @endif
                    </td>



                    <td>
                        @if($isOwner || $isSuperAdmin)
                            <!-- Editable -->
                            <a class="btn btn-success btn-sm shadow-sm" 
                              href="{{ route('question-view', ['questionId' => $rs->id]) }}">
                              <i class="fa fa-edit"></i> Edit
                            </a>
                        @else
                            <!-- Locked -->
                            <button class="btn btn-secondary btn-sm shadow-sm" disabled 
                                    title="Edit Question">
                                <i class="fa fa-lock"></i> Edit
                            </button>
                        @endif
                    </td>              

                    @if($isOwner || $isSuperAdmin)

                        @if($rs->lock_status == 1)
                            <td>
                                <button type="button" 
                                        class="btn btn-danger btn-gradient shadow-sm lock-btn"
                                        data-toggle="modal" 
                                        data-target="#modal-success" 
                                        data-id="{{ $rs->id }}">
                                    <i class="fa fa-unlock-alt"></i> Unlock
                                </button>
                            </td>
                        @elseif($rs->lock_status == 0)
                            <td>
                                <button type="button" 
                                        class="btn btn-success btn-gradient shadow-sm lock-btn"
                                        data-toggle="modal" 
                                        data-target="#modal-success1" 
                                        data-id="{{ $rs->id }}">
                                    <i class="fa fa-lock"></i> Lock
                                </button>
                            </td>
                        @endif

                    @else
                        <td>
                            <span class="badge badge-secondary">
                                Locked by another user
                            </span>
                        </td>
                    @endif


         
                    <td>
                        {{ $rs->exam_status }}

                        @if ($rs->exam_status == 'Inactive')
                            @if($isOwner || $isSuperAdmin)
                                <!-- Enabled for owner or superadmin -->
                                <a class="btn btn-primary btn-sm shadow-sm" 
                                  href="{{ route('question-enable', ['questionId' => $rs->id]) }}">
                                    <i class="fa fa-check"></i> Enable Question
                                </a>
                            @else
                                <!-- Disabled for others -->
                                <button class="btn btn-secondary btn-sm shadow-sm" disabled 
                                        title="Only owner or superadmin can enable">
                                    <i class="fa fa-lock"></i> Enable Question
                                </button>
                            @endif
                        @elseif ($rs->exam_status == 'Active')
                            <!-- You can optionally show a disabled 'Disable' button here if needed -->
                        @endif
                    </td>

                    <!-- <td>{{ $key + 1 }}</td>                     -->
                    <td>{{$rs->session1}}</td>
                    <td>{{ $rs->department }}</td>
                    <td>{{$rs->course}}</td>
                    <td>{{ $rs->level }}</td>
                    <td>{{ $rs->semester }}</td>
                    <td>{{ $rs->exam_view_type }}</td>
                    <td>{{ $rs->exam_mode }}</td>
                    <td>{{ $rs->exam_type }}</td>
                    <td>{{ $rs->exam_date }}</td>
                    <td>{{ $rs->upload_no_of_qst }}</td>
                    <td>{{ $rs->no_of_qst }}</td>
                    <td>{{ $rs->duration }} mins</td>
                    @if($rs->check_result == 1)
                    <td>YES</td>
                    @else
                    <td>NO</td>
                    @endif  
                    <td>{{$rs->created_at}}</td>                   
                </tr>              
                @endforeach
</tbody>
                @else
                <tr>
                  <td colspan="8">Questions not available.</td>
                </tr>
        @endif
          
              </table>
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

<div class="modal modal-info fade" id="modal-success">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Unlock Exam.</h4>
            </div>
            <div class="modal-body">
                <p>Enter your password to unlock the exam.</p>
                <form id="unlock-form" method="post">
                    @csrf
                    <table class="table">
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" name="user_password" class="form-control"></td>
                        </tr>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline">Unlock Exam</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal modal-info fade" id="modal-success1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Lock Exam.</h4>
            </div>
            <div class="modal-body">
                <p>Enter your password to lock the exam.</p>
                <form id="lock-form" method="post">
                    @csrf
                    <table class="table">
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" name="user_password" class="form-control"></td>
                        </tr>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline">Lock Exam</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body text-center">
        <p class="font-weight-bold">Are you sure you want to delete this question and all related data?</p>
        <p class="text-muted small">This action cannot be undone.</p>
      </div>

      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger" id="deleteConfirmBtn">Yes, Delete</button>
        <span id="deleteProcessing" class="ml-2 text-muted" style="display:none;">
            <i class="fa fa-spinner fa-spin"></i> Processing...
        </span>
      </div>

    </div>
  </div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
 <script src="{{asset('student/js/jquery-3.6.0.min.js')}}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    $('#modal-success').on('show.bs.modal', function(event) {

        var button = $(event.relatedTarget);
        var id = button.data('id');
        var lockId = button.data('lock-id');
        var authId = button.data('auth-id');
        var userType = "{{ auth()->user()->user_type }}";

        // Security check BEFORE modal opens
        if (lockId != authId && userType !== 'superadmin') {
            event.preventDefault(); // Stop modal
            alert('You are not authorized to unlock this exam.');
            return false;
        }

        // If authorized, continue normally
        var form = $('#unlock-form');
        var action = "{{ url('/unlock-exam') }}/" + id;
        form.attr('action', action);
    });

});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    $('#modal-success1').on('show.bs.modal', function(event) {

        var button = $(event.relatedTarget);
        var id = button.data('id');
        var lockId = button.data('lock-id');
        var authId = button.data('auth-id');
        var userType = "{{ auth()->user()->user_type }}";

        // Security check BEFORE modal opens
        if (lockId != authId && userType !== 'superadmin') {
            event.preventDefault(); // Stop modal
            alert('You are not authorized to lock this exam.');
            return false;
        }

        // If authorized, continue normally
        var form = $('#lock-form');
        var action = "{{ url('/lock-exam') }}/" + id;
        form.attr('action', action);
    });

});
</script>



<script>
document.addEventListener('DOMContentLoaded', function () {

    const programmeInput = document.getElementById('searchProgramme');
    const examTypeInput = document.getElementById('searchExamType');
    const levelInput = document.getElementById('searchLevel');
    const rows = document.querySelectorAll('.student-row');
    const clearBtn = document.getElementById('clearFilters'); // Clear button

    function filterTable() {
        const programme = programmeInput.value.toLowerCase();
        const examType = examTypeInput.value.toLowerCase();
        const level = levelInput.value.toLowerCase();

        rows.forEach(row => {
            const rowProgramme = row.dataset.programme.toLowerCase();
            const rowExamType = row.dataset.examtype.toLowerCase();
            const rowLevel = row.dataset.level.toLowerCase();

            const matchProgramme = rowProgramme.includes(programme);
            const matchExamType = rowExamType.includes(examType);
            const matchLevel = rowLevel.includes(level);

            if (matchProgramme && matchExamType && matchLevel) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Live filtering
    programmeInput.addEventListener('keyup', filterTable);
    examTypeInput.addEventListener('keyup', filterTable);
    levelInput.addEventListener('keyup', filterTable);

    // Clear filters button
    clearBtn.addEventListener('click', function () {
        programmeInput.value = '';
        examTypeInput.value = '';
        levelInput.value = '';
        filterTable(); // Restore all rows
    });

});
</script>

<script>
$(document).ready(function() {
console.log('Delete JS loaded!');  // <-- check this in browser console

    let deleteQuestionId = null;

    // Modal show event
    $('#deleteModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget); // Button that triggered modal
        deleteQuestionId = button.data('id');  // Read data-id
        console.log('Modal triggered by button with ID:', deleteQuestionId);

        // Reset modal state
        $('#deleteConfirmBtn').prop('disabled', false);
        $('#deleteProcessing').hide();
    });

    // Use delegated event binding in case button is rendered dynamically
    $(document).on('click', '#deleteConfirmBtn', function() {
        console.log('Delete confirm button clicked. Current deleteQuestionId:', deleteQuestionId);

        if (!deleteQuestionId) return console.warn('No question ID set!');

        $(this).prop('disabled', true);
        $('#deleteProcessing').show();

        $.ajax({
            url: "{{ route('question-delete') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                questionId: deleteQuestionId
            },
            success: function(res) {
                console.log('AJAX success:', res);
                $('#deleteModal').modal('hide'); // hide modal
                alert(res.message);
                location.reload();
            },
            error: function(xhr) {
              console.error('AJAX error:', xhr);

              let errorMsg = 'Error deleting question.';
              
              // Check if server returned JSON with a message
              if (xhr.responseJSON && xhr.responseJSON.message) {
                  errorMsg = xhr.responseJSON.message;
              }

              alert(errorMsg);
              $('#deleteConfirmBtn').prop('disabled', false);
              $('#deleteProcessing').hide();
              location.reload();
          }
        });
    });

});
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
