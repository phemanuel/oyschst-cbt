<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('pageTitle')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="shortcut icon" href="{{ asset('/favicon.png') }}">
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
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('dashboard/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>
  .exam-info-bar {
    display: flex;
    flex-wrap: nowrap;
    gap: 10px;
    overflow-x: auto;
}

.info-box {
    flex: 1;
    min-width: 140px;
    padding: 8px 12px;
    border-radius: 10px;
    color: #fff;
    font-size: 12px;
    line-height: 1.2;
    transition: 0.3s ease;
}

.info-box span {
    display: block;
    font-size: 12px;
    text-transform: uppercase;
    opacity: 0.8;
}

.info-box strong {
    font-size: 15px;
    font-weight: 600;
}

.info-box:hover {
    transform: translateY(-3px);
}

/* Different Background Colors */
.bg-course {
    background: linear-gradient(135deg, #1e3c72, #5b7fbf);
}

.bg-session {
    background: linear-gradient(135deg, #0b6d40, #38ef7d);
}

.bg-level {
    background: linear-gradient(135deg, #392610, #75620d);
    /* color: #222; */
}

.bg-type {
    background: linear-gradient(135deg, #8e2de2, #4a00e0);
}

.bg-mode {
    background: linear-gradient(135deg, #ff416c, #ff4b2b);
}

.bg-category {
    background: linear-gradient(135deg, #00c6ff, #0072ff);
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
        Question Upload (Objective) - Single-Page View 
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin-dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>  
        <li><a href="{{route('question-obj-upload')}}">Question Bank</a></li>       
        <li class="active">Question Upload(Objective)</li>
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
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header">
            <div class="exam-header shadow-sm mb-4 p-4 rounded">  
    

                <div class="row g-3">
                  <div class="col-12">
                    <div class="exam-info-bar">             

                          <div class="info-box bg-session">
                              <span>Programme</span>
                              <strong>{{ $question->department }}</strong>
                          </div>

                          <div class="info-box bg-category">
                              <span>Academic Session</span>
                              <strong>{{ $question->session1 }}</strong>
                          </div>

                          <div class="info-box bg-level">
                              <span>Level</span>
                              <strong>{{ $question->level }}</strong>
                          </div>

                          <div class="info-box bg-type">
                              <span>Exam Type</span>
                              <strong>{{ $question->exam_type }}</strong>
                          </div>
                          
                          <div class="info-box bg-course">
                              <span>Course</span>
                              <strong>{{ $question->course }}</strong>
                          </div>

                          <div class="info-box bg-mode">
                              <span>Mode</span>
                              <strong>{{ $question->exam_mode }}</strong>
                          </div>             

                      </div>


                </div>
  </div>
</div>


            <form action="{{route('question-search', ['id' => $questionSetting->id])}}" method="post">
              @csrf
            <table width="100%">
            <tr>
                <td width="68%"><h3 align="left"><strong>Question {{$question->question_no}} of {{$question->upload_no_of_qst}}</strong> </h3></td>
                <td width="9%">Question No: </td>
                <td width="15%"><input type="text" name="qst_search" class="form-control"> </td>
                <td width="8%"><button type="submit" class="btn btn-success">Search</button></td>
              </tr>
              </table>
            </form>
              
                        
            </div>
            <!-- /.box-header -->
            <hr>
            <div class="box-body pad">
              <form action="{{ route('question-save', ['id' => $questionSetting->id]) }}" method="post">
              @csrf

              @if($question->question_type == 'text-image')
              <strong><p>Question:</p></strong> 
                    <textarea id="editor1" name="question" rows="10" cols="80">
                                            {{$question->question}}
                    </textarea>
                    <hr>
              <img src="{{asset('questions/' . $question->graphic)}}" alt="questionImage" width="1200" height="250">
              <table width="100%">
                        <tr>
                            <td><strong>Option A</strong></td>
                            <td>&nbsp;</td>
                            <td><strong>Option B</strong></td>
                            <td>&nbsp;</td>
                            <td><strong>Option C</strong></td>
                            <td>&nbsp;</td>
                            <td><strong>Option D</strong></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="option_a" value="{{ strip_tags($question->option_a) }}"></td>
                            <td>&nbsp;</td>
                            <td><input type="text" class="form-control" name="option_b" value="{{ strip_tags($question->option_b) }}"></td>
                            <td>&nbsp;</td>
                            <td><input type="text" class="form-control" name="option_c" value="{{ strip_tags($question->option_c) }}"></td>
                            <td>&nbsp;</td>
                            <td><input type="text" class="form-control" name="option_d" value="{{ strip_tags($question->option_d) }}"></td>
                        </tr>
                    </table>
                    <hr>
                    <p><strong>Correct Answer :</strong> 
                    <select name="answer" id="" class="form-control">
                        <option value="A" {{ $question->answer == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ $question->answer == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ $question->answer == 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ $question->answer == 'D' ? 'selected' : '' }}>D</option>
                    </select></p>
              @else
                <strong><p>Question:</p></strong> 
                    <textarea id="editor1" name="question" rows="10" cols="80">
                                            {{$question->question}}
                    </textarea>
                    <hr>
                    <table width="100%">
                        <tr>
                            <td><strong>Option A</strong></td>
                            <td>&nbsp;</td>
                            <td><strong>Option B</strong></td>
                            <td>&nbsp;</td>
                            <td><strong>Option C</strong></td>
                            <td>&nbsp;</td>
                            <td><strong>Option D</strong></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="option_a" value="{{ strip_tags($question->option_a) }}"></td>
                            <td>&nbsp;</td>
                            <td><input type="text" class="form-control" name="option_b" value="{{ strip_tags($question->option_b) }}"></td>
                            <td>&nbsp;</td>
                            <td><input type="text" class="form-control" name="option_c" value="{{ strip_tags($question->option_c) }}"></td>
                            <td>&nbsp;</td>
                            <td><input type="text" class="form-control" name="option_d" value="{{ strip_tags($question->option_d) }}"></td>
                        </tr>
                    </table>
                    <hr>
                    <p><strong>Correct Answer :</strong> 
                    <select name="answer" id="" class="form-control">
                        <option value="A" {{ $question->answer == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ $question->answer == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ $question->answer == 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ $question->answer == 'D' ? 'selected' : '' }}>D</option>
                    </select></p>
              @endif
                 
                    <table width="100%">                    
                      
  <tr>
    <td colspan="6" style="padding-top:10px;">
        <div style="display:flex; gap:10px; justify-content:flex-start;">
            
            <button type="submit" name="action" value="previous"
                class="btn btn-primary btn-sm"
                style="min-width:110px;">
                <i class="fa fa-arrow-left"></i> Previous
            </button>

            <button type="submit" name="action" value="next"
                class="btn btn-info btn-sm"
                style="min-width:110px;">
                Next <i class="fa fa-arrow-right"></i>
            </button>

            <button type="button"
                class="btn btn-warning btn-sm"
                style="min-width:110px;"
                onclick="previewQuestion()">
                <i class="fa fa-eye"></i> Preview
            </button>

            <button type="button"
                class="btn btn-success btn-sm"
                style="min-width:110px;"
                data-toggle="modal"
                data-target="#exampleModal-2">
                <i class="fa fa-image"></i> Add Image
            </button>

            <button type="button"
                class="btn btn-danger btn-sm"
                style="min-width:110px;"
                data-toggle="modal"
                data-target="#exampleModal-3">
                <i class="fa fa-trash"></i> Delete Image
            </button>

            <button type="button"
                    class="btn btn-info btn-sm"
                    style="min-width:160px; font-weight:600;"
                    data-toggle="modal"
                    data-target="#addMoreModal">
                <i class="fa fa-plus"></i> Add More Question
            </button>

        </div>
    </td>
</tr>

                                           </table>
                  

                  <input type="hidden" name="currentQuestionNo" value="{{$question->question_no}}">
              </form>
            </div>
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div class="modal fade" id="questionPreviewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header" style="background:#000;color:#fff;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;">
                    &times;
                </button>
                <h4 class="modal-title">
                    <i class="fa fa-eye"></i> Question Preview
                </h4>
            </div>

            <div class="modal-body" style="background:#fff;color:#000;">
                <div id="preview-question" style="font-size:20px;"></div>

                <hr>

                <ol type="A" style="font-size:18px;">
                    <li id="preview-a"></li>
                    <li id="preview-b"></li>
                    <li id="preview-c"></li>
                    <li id="preview-d"></li>
                </ol>
            </div>

            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


  <form action="{{route('question-image-upload', ['id' => $questionSetting->id])}}" method="post" enctype="multipart/form-data">
    @csrf
  <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-2">Add question Image</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <label for="file">Image File (jpeg,jpg) format</label>
                          <input type="file" name="file" class="form-control">
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success"  value="upload">Upload</button>
                          <button type="button" class="btn btn-light" data-dismiss="modal" value="Cancel">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Ends -->
                  <input type="hidden" name="currentQuestionNo" value="{{$question->question_no}}">
  </form>
  <form action="{{route('delete-obj-image', ['id' => $questionSetting->id])}}" method="post">
    @csrf
  <div class="modal fade" id="exampleModal-3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-3" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-3">Delete question Image</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <label for="file">Are you sure you want to delete the image?</label>                          
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success" name="action" value="delete">Yes</button>
                          <button type="button" class="btn btn-light" data-dismiss="modal" value="Cancel">No</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Ends -->
                  <input type="hidden" name="questionId" value="{{$questionSetting->id}}">
                  <input type="hidden" name="questionNo" value="{{$question->question_no}}">
  </form>
<!-- Add more questions modal -->
<div class="modal fade" id="addMoreModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content shadow-lg border-0 rounded-3">

      <div class="modal-header bg-light">
        <h5 class="modal-title fw-bold">Add More Questions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
      </div>

      <div class="modal-body">

        <div class="alert alert-info">
            <strong>Currently Uploaded:</strong>
            {{ $questionSetting->upload_no_of_qst }}
            <br>
            <strong>Student Attempts:</strong>
            {{ $questionSetting->no_of_qst }}
        </div>

        <input type="hidden" id="questionId" value="{{ $questionSetting->id }}">

        <div class="mb-3">
            <label class="form-label">Total Questions to Add</label>
            <select class="form-control" id="totalToAdd" onchange="calculatePreview()">
                <option value="">Select</option>
                @for($i=10; $i<=100; $i+=10)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Total Questions to Add (Student)</label>
            <select class="form-control" id="totalAttempt" onchange="calculatePreview()">
                <option value="">Select</option>
                @for($i=10; $i<=100; $i+=10)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="alert alert-secondary d-none" id="previewBox">
            <strong>New Upload Total:</strong> <span id="newUploadTotal"></span><br>
            <strong>New Attempt Total:</strong> <span id="newAttemptTotal"></span>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button"
                class="btn btn-primary w-100"
                id="saveBtn"
                onclick="addMoreQuestions()">
            Save Changes
        </button>
        <button type="button" class="btn btn-light" data-dismiss="modal" value="Cancel">Cancel</button>
      </div>

    </div>
  </div>
</div>
<!-- end --> 

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
window.MathJax = {
    tex: {
        inlineMath: [['$', '$'], ['\\(', '\\)']]
    },
    svg: { fontCache: 'global' }
};
</script>

<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-svg.js"></script>

<script>
function previewQuestion() {

    // Get CKEditor content (RAW HTML with math)
    var questionHtml = CKEDITOR.instances.editor1.getData();

    // Get options
    var optionA = document.querySelector('input[name="option_a"]').value;
    var optionB = document.querySelector('input[name="option_b"]').value;
    var optionC = document.querySelector('input[name="option_c"]').value;
    var optionD = document.querySelector('input[name="option_d"]').value;

    // Inject into preview modal
    document.getElementById('preview-question').innerHTML = questionHtml;
    document.getElementById('preview-a').innerHTML = optionA;
    document.getElementById('preview-b').innerHTML = optionB;
    document.getElementById('preview-c').innerHTML = optionC;
    document.getElementById('preview-d').innerHTML = optionD;

    // Open modal
    $('#questionPreviewModal').modal('show');

    // Re-render MathJax
    if (window.MathJax) {
        MathJax.typesetPromise();
    }
}
</script>

<script>
  function calculatePreview() {

    let totalToAdd = parseInt(document.getElementById('totalToAdd').value) || 0;
    let totalAttempt = parseInt(document.getElementById('totalAttempt').value) || 0;

    let currentUpload = {{ $questionSetting->upload_no_of_qst }};
    let currentAttempt = {{ $questionSetting->no_of_qst }};

    if (totalToAdd && totalAttempt) {

        document.getElementById('previewBox').classList.remove('d-none');

        document.getElementById('newUploadTotal').innerText =
            currentUpload + totalToAdd;

        document.getElementById('newAttemptTotal').innerText =
            currentAttempt + totalAttempt;
    }
}

function addMoreQuestions() {

    let btn = document.getElementById('saveBtn');
    btn.disabled = true;
    btn.innerText = "Processing...";

    fetch("{{ route('add-more-questions') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            questionId: document.getElementById('questionId').value,
            totalToAdd: document.getElementById('totalToAdd').value,
            totalAttempt: document.getElementById('totalAttempt').value
        })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        location.reload();
    })
    .catch(() => {
        alert("Something went wrong.");
        btn.disabled = false;
        btn.innerText = "Save Changes";
    });
}


</script>

<!-- jQuery 3 -->
<script src="{{asset('dashboard/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('dashboard/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('dashboard/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dashboard/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dashboard/dist/js/demo.js')}}"></script>
<!-- CK Editor -->
<script src="{{asset('dashboard/bower_components/ckeditor/ckeditor.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('dashboard/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
</body>
</html>
