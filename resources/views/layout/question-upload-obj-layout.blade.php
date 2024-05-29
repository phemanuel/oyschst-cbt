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
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

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
        </li>
        <li>
          <a href="{{route('student-list')}}">
            <i class="fa fa-book"></i> <span>Student</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li>
          <a href="{{route('login-status')}}">
            <i class="fa fa-user"></i> <span>Student Login Status</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>        
        <li>
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
          <a href="{{route('college-setup')}}">
            <i class="fa fa-table"></i> <span>College Setup</span>
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
            <i class="fa fa-folder"></i> <span>Logout</span>
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
        Question Upload(Objectives)        
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('question')}}">Question Bank</a></li>        
        <li class="active">Question Upload(Objectives)</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
            <table width="100%">
<tr>
                  <td width="88%"><h3 class="box-title">Upload single question at a time.</h3></td>
    <td width="12%"><p align="right"><a href="{{route('question')}}" class="btn btn-success">Back to Questions</a></p></td>
  </tr>
                <tr>
                  <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-success">
                Get more Info about this module
              </button></td>
                  <td></td>
                </tr>
              </table>
              
            </div>
            @if(session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
          @elseif(session('error'))
						<div class="alert alert-danger">
							{{ session('error') }}
						</div>
						@endif	
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{route('question-upload-obj.action')}}" method="post" enctype="multipart/form-data">
              @csrf              
              <div class="box-body">  
              <div class="form-group">
                  <label for="exampleInputEmail1">Academic Session</label>
                  <select name="session1" id="" class="form-control">
                  <!-- <option value="{{old('session1')}}">{{old('session1')}}</option>                   -->
                  @foreach($acad_sessions as $rd)
				<option value="{{$rd->session1}}">{{$rd->session1}}</option>
				@endforeach
                  </select>
                </div>             
                @error('session1')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <div class="form-group">
                  <label for="exampleInputEmail1">Programme</label>
                  <select name="department" class="form-control">
                  <!-- <option value="{{old('department')}}" selected>{{old('department')}}</option>                   -->
                  @foreach($dept as $rd)
				<option value="{{$rd->department}}">{{$rd->department}}</option>
				@endforeach
                  </select>
                </div>   
                <p><a href="{{route('college-setup')}}"><u> Create Programme</u> </a></p>          
                @error('department')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <div class="form-group">
                  <label for="exampleInputEmail1">Level</label>
                  <select name="level" id="" class="form-control">
                  <!-- <option value="{{old('level')}}" selected>{{old('level')}}</option>                   -->
                  @foreach($level as $rd)
				<option value="{{$rd->level}}">{{$rd->level}}</option>
				@endforeach
                  </select>
                </div> 
                <p><a href="{{route('college-setup')}}"><u> Create Class/Level</u> </a></p>            
                @error('level')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror      
                <div class="form-group">
                  <label for="exampleInputEmail1">Semester</label>
                  <select name="semester" id="" class="form-control">                   
				<option value="First">First</option>
				<option value="Second">Second</option>
                  </select>
                </div>          
                <!-- <div class="form-group">
                  <label for="exampleInputEmail1">Exam Category</label>
                  <select name="exam_category" id="" class="form-control">
                  <option value="GENERAL" selected>GENERAL</option> 
                  <option value="SEMESTER">SEMESTER</option> 
                  </select>
                </div>             
                @error('exam_category')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror -->
                <div class="form-group">
                  <label for="exampleInputEmail1">Exam Type</label>
                  <select name="exam_type" id="" class="form-control">
                  <!-- <option value="{{old('exam_type')}}" selected>{{old('exam_type')}}</option>                   -->
                  @foreach($examType as $rd)
				<option value="{{$rd->exam_type}}">{{$rd->exam_type}}</option>
				@endforeach
                  </select>
                </div>     
                <p><a href="{{route('exam-type')}}"><u> Create Exam Type</u> </a></p>        
                @error('exam_type')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <div class="form-group">
                  <label for="exampleInputEmail1">Subject/Course</label>
                  <select name="course" id="" class="form-control">                  
                  @foreach($courseData as $rd)
                  <option value="{{$rd->course}}">{{$rd->course}}</option>
                  @endforeach
                  </select>
                </div>   
                <p><a href="{{route('college-setup')}}"><u> Create Subject/Course</u> </a></p>         
                @error('course')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <div class="form-group">
                  <label for="exampleInputEmail1">Total No of questions to upload</label>
                  <select name="upload_no_of_qst" class="form-control">
                  <option value="10" selected>10</option>
                  <option value="20">20</option>
                  <option value="30">30</option>
                  <option value="40">40</option>
                  <option value="50">50</option>
                  <option value="60">60</option>
                  <option value="70">70</option>
                  <option value="80">80</option>
                  <option value="90">90</option>
                  <option value="100">100</option>
                </select>
                </div>             
                @error('upload_no_of_qst')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <div class="form-group">
                  <label for="exampleInputEmail1">No of questions for student</label>
                  <select name="no_of_qst" class="form-control">
                  <option value="10" selected>10</option>
                  <option value="20">20</option>
                  <option value="30">30</option>
                  <option value="40">40</option>
                  <option value="50">50</option>
                  <option value="60">60</option>
                  <option value="70">70</option>
                  <option value="80">80</option>
                  <option value="90">90</option>
                  <option value="100">100</option>
                </select>
                </div>             
                @error('no_of_qst')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <div class="form-group">
                  <label for="exampleInputEmail1">Exam Duration(Minutes)</label>
                  <input type="text" name="duration" class="form-control" value="{{old('duration')}}">
                </div>             
                @error('duration')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <div class="form-group">
                  <label for="exampleInputEmail1">Exam Date(mm/dd/yy)</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker" name="exam_date" value="{{old('exam_date')}}">
                </div> 
  </div>           
                @error('exam_date')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Start Upload</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->

        
<!-- left column -->
<div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
            <table width="100%">
<tr>
                  <td width="88%"><h3 class="box-title">Import all Questions.(CSV format)</h3></td>
    <td width="12%"><p align="right"><a href="{{route('question')}}" class="btn btn-success">Back to Questions</a></p></td>
  </tr>
                <tr>
                  <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-success1">
                Get more Info about this module
              </button></td>
                  <td></td>
                </tr>
              </table>
            </div>
            @if(session('success-import'))
						<div class="alert alert-success">
							{{ session('success-import') }}
						</div>
          @elseif(session('error-import'))
						<div class="alert alert-danger">
							{{ session('error-import') }}
						</div>
						@endif	
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{route('question-upload-obj-import.action')}}" method="post" enctype="multipart/form-data">
              @csrf              
              <div class="box-body">  
              <div class="form-group">
                  <label for="exampleInputEmail1">Academic Session</label>
                  <select name="session1" id="" class="form-control">
                  <!-- <option value="{{old('session1')}}" selected>{{old('session1')}}</option>                   -->
                  @foreach($acad_sessions as $rd)
				<option value="{{$rd->session1}}">{{$rd->session1}}</option>
				@endforeach
                  </select>
                </div>             
                @error('session1')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <div class="form-group">
                  <label for="exampleInputEmail1">Programme</label>
                  <select name="department" class="form-control">
                  <!-- <option value="{{old('department')}}" selected>{{old('department')}}</option>                   -->
                  @foreach($dept as $rd)
				<option value="{{$rd->department}}">{{$rd->department}}</option>
				@endforeach
                  </select>
                </div>   
                <p><a href="{{route('college-setup')}}"><u> Create Programme</u> </a></p>          
                @error('department')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <div class="form-group">
                  <label for="exampleInputEmail1">Level</label>
                  <select name="level" id="" class="form-control">
                  <!-- <option value="{{old('level')}}" selected>{{old('level')}}</option>                   -->
                  @foreach($level as $rd)
				<option value="{{$rd->level}}">{{$rd->level}}</option>
				@endforeach
                  </select>
                </div> 
                <p><a href="{{route('college-setup')}}"><u> Create Class/Level</u> </a></p>  
                <div class="form-group">
                  <label for="exampleInputEmail1">Semester</label>
                  <select name="semester" id="" class="form-control"> 
                				<option value="First">First</option>
				<option value="Second">Second</option>
                  </select>
                </div>          
                @error('level')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror                
                <!-- <div class="form-group">
                  <label for="exampleInputEmail1">Exam Category</label>
                  <select name="exam_category" id="" class="form-control">
                  <option value="GENERAL" selected>GENERAL</option> 
                  <option value="SEMESTER">SEMESTER</option> 
                  </select>
                </div>             
                @error('exam_category')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror -->
                <div class="form-group">
                  <label for="exampleInputEmail1">Exam Type</label>
                  <select name="exam_type" id="" class="form-control">
                  <!-- <option value="{{old('exam_type')}}" selected>{{old('exam_type')}}</option>                   -->
                  @foreach($examType as $rd)
				<option value="{{$rd->exam_type}}">{{$rd->exam_type}}</option>
				@endforeach
                  </select>
                </div>     
                <p><a href="{{route('exam-type')}}"><u> Create Exam Type</u> </a></p>        
                @error('exam_type')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <div class="form-group">
                  <label for="exampleInputEmail1">Subject/Course</label>
                  <select name="course" id="" class="form-control">                  
                  @foreach($courseData as $rd)
                  <option value="{{$rd->course}}">{{$rd->course}}</option>
                  @endforeach
                  </select>
                </div>   
                <p><a href="{{route('college-setup')}}"><u> Create Subject/Course</u> </a></p>         
                @error('course')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <div class="form-group">
                  <label for="exampleInputEmail1">Total No of questions to upload</label>
                  <select name="upload_no_of_qst" class="form-control">
                  <option value="10" selected>10</option>
                  <option value="20">20</option>
                  <option value="30">30</option>
                  <option value="40">40</option>
                  <option value="50">50</option>
                  <option value="60">60</option>
                  <option value="70">70</option>
                  <option value="80">80</option>
                  <option value="90">90</option>
                  <option value="100">100</option>
                </select>
                </div>             
                @error('upload_no_of_qst')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <div class="form-group">
                  <label for="exampleInputEmail1">No of questions to upload</label>
                  <select name="no_of_qst" class="form-control">
                  <option value="10" selected>10</option>
                  <option value="20">20</option>
                  <option value="30">30</option>
                  <option value="40">40</option>
                  <option value="50">50</option>
                  <option value="60">60</option>
                  <option value="70">70</option>
                  <option value="80">80</option>
                  <option value="90">90</option>
                  <option value="100">100</option>
                </select>
                </div>             
                @error('no_of_qst')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <div class="form-group">
                  <label for="exampleInputEmail1">Exam Duration(Minutes)</label>
                  <input type="text" name="duration" class="form-control" value="{{old('duration')}}">
                </div>             
                @error('duration')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <div class="form-group">
                  <label for="exampleInputEmail1">Exam Date(mm/dd/yy)</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker1" name="exam_date" value="{{old('exam_date')}}">
                </div> 
  </div>           
                @error('exam_date')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <div class="form-group">
                  <label for="exampleInputEmail1">File (CSV Format)</label>
                  <input type="file" name="file"  class="form-control" />
                </div>             
                @error('file')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror 
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Start Import</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          
          
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <div class="modal modal-info fade" id="modal-success">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload Single Questions.</h4>
              </div>
              <div class="modal-body">
                <p>Uploading questions one at a time is suitable when you want to manually review and input each question. 
                  Here's how this process generally works:
                </p>
                  <ul>
                    <li> Select the necessary criteria.</li>
                    <li><u>Total No of Questions to upload</u>  refers to the number of questions you want to 
                      upload.</li>
                      <li><u>The No of question for student</u>  refers to how many question the student can 
                        access out of the total number of questions uploaded. i.e If the total number of questions uploaded 
                      is 100, you can decide to test the students on 50 questions only, the application pick different question from 
                    the 100 questions.</li>
                    <li> Click on Start Upload.</li>
                    <li> This will generate a dummy template for the specified no of questions.</li>
                    <li> You can start editing the questions as desired.</li>
                  </ul> 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-outline">Save changes</button> -->
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal modal-info fade" id="modal-success1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Import all questions.</h4>
              </div>
              <div class="modal-body">
              <p>Importing questions from a CSV (Comma Separated Values) file is a convenient way to bulk upload questions into a system. 
                Here's how the process typically works:
                </p>
                  <ul>
                    <li> Select the necessary criteria.</li>
                    <li><u>Total No of Questions to upload</u>  refers to the number of questions you want to 
                      upload.</li>
                      <li><u>The No of question for student</u>  refers to how many question the student can 
                        access out of the total number of questions uploaded. i.e If the total number of questions uploaded 
                      is 100, you can decide to test the students on 50 questions only, the application pick different question from 
                    the 100 questions.</li>
                    <li> Load the CSV file <a class="btn btn-success" href="{{route('download-question-csv')}}">You can download a sample template here.</a></li>
                    <li> Click on Start Import.</li>
                    <li> This will upload all the questions for the specified no of questions.</li>
                    <li> You can start editing the questions as desired.</li>
                  </ul> 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-outline">Save changes</button> -->
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

<script src="{{asset('dashboard/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('dashboard/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('dashboard/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('dashboard/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('dashboard/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('dashboard/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('dashboard/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('dashboard/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('dashboard/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('dashboard/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{asset('dashboard/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('dashboard/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('dashboard/plugins/iCheck/icheck.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('dashboard/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dashboard/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dashboard/dist/js/demo.js')}}"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Date picker
    $('#datepicker1').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>
