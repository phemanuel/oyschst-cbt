<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/melody/template/pages/layout/horizontal-menu.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:05:55 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

    .bold-text-font {
    font-size: 14px;
    font-weight: bold;    
}

    .bold-font-text {
    font-size: 16px;
    font-weight: bold;
}

.bold-font {
    font-size: 16px;
    /* font-weight: bold; */
}

.bold-font-score {
    font-size: 20px;
    font-weight: bold;
    color: green;
}
  </style>
  
  	<style>
    /* Success Alert */
    .alert.alert-success {
        background-color: #28a745; /* Green background color */
        color: #fff; /* White text color */
        font-size: 14px; /*
        padding: 10px; /* Padding around the text */
        border-radius: 5px; /* Rounded corners */
    }

    /* Error Alert */
    .alert.alert-danger {
        background-color: #dc3545; /* Red background color */
        color: #fff; /* White text color */
        font-size: 14px; /*
        padding: 10px; /* Padding around the text */
        border-radius: 5px; /* Rounded corners */
    }
</style>
</head>
<body class="horizontal-menu">
  <div class="container-scroller">
    <nav class="navbar horizontal-layout-navbar fixed-top navbar-expand-lg">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <!-- <a class="navbar-brand brand-logo" href="#"><img src="{{asset($collegeSetup->avatar)}}" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="#"><img src="{{asset($collegeSetup->avatar)}}" alt="logo" /></a>                     -->
      </div>
      <div class="navbar-menu-wrapper d-flex flex-grow">
        <ul class="navbar-nav navbar-nav-left collapse navbar-collapse" id="horizontal-top-example">
          
          <li class="nav-item dropdown">            
            <a class="nav-link active" href="#" id="projects-dropdown" data-toggle="dropdown" aria-expanded="false">
            <!-- <img src="{{asset($collegeSetup->avatar)}}" alt="" width="50" height="50"> -->
            <strong><p class="bold-text">Oyo State College of Health Science and Technology</p></strong>
            </a>            
          </li>        
          
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile">
            <a class="nav-link">
              <div class="nav-profile-text">              
              </div>
              <div class="nav-profile-img">
                <img src="{{asset($collegeSetup->avatar)}}" alt="image" class="img-xs rounded-circle ml-3">
                <span class="availability-status online"></span>             
              </div>
            </a>
          </li>
          <li class="nav-item nav-search">
            <div class="nav-link">
              <div class="search-field d-none d-md-block">
                
              </div> 
            </div>
          </li>
          <li class="nav-item">
            <!-- <a class="nav-link">
              <i class="fas fa-power-off font-weight-bold icon-sm"></i>
            </a> -->
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center ml-auto" type="button" data-toggle="collapse" data-target="#horizontal-top-example">
          <span class="fa fa-bars"></span>
        </button>
      </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Computer Based Test - Result.
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('login')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Computer Based Test</li>
              </ol>
            </nav>
          </div>
          <!-- <div>
          @if(session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
          @elseif(session('error'))
						<div class="alert alert-danger">
							{{ session('error') }}
						</div>
						@endif	
          </div> -->
          <div class="alert alert-success">
							<p>You have successfully completed the Computer based test.</strong>.</p>
						</div>
            <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                <a href="#" onclick="window.print();" class="btn btn-info" >Print Slip</a>
                </div>
              </div>
              <hr>
            <div class="row"> 
           @if($examSetting->check_result == 1)
           <table width="60%" border="0" align="center" cellpadding="4" cellspacing="5">
<tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td width="93"><img src="{{asset($collegeSetup->avatar)}}" alt="College logo"></td>
              <td width="465"><h1><div align="center"><strong>{{$collegeSetup->name}}</strong> </div></h1> </td>
  </tr>
  <tr>
                <td colspan="2" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            
            <tr>
                <td colspan="2" align="center"><p class="bold-font-text">{{$cbtEvaluation->session1}} {{$cbtEvaluation->exam_type}} RESULT CONFIRMATION SLIP</p> </td>
            </tr>
             <tr>
                <td colspan="2" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
                <tr>
                    <td width="348">&nbsp;</td>
                    <td width="116"><img name="" src="{{asset('uploads/'. $cbtEvaluation->studentno . '.jpg')}}" width="94" height="102" alt="" /></td>
                </tr> 
                </table></td>
            </tr>
            <tr>
                <td colspan="2" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
                <tr>
                    <td width="173"><span class="style8"><p class="bold-font-text">Examination Date:</p></span></td>
                  <td width="301"><p class="bold-font">{{ \Carbon\Carbon::parse($cbtEvaluation->examdate)->format('F j, Y') }}</p></td>
                </tr>
                <tr>
                    <td><span class="style8"><p class="bold-font-text">Student Name:</p></span></td>
                  <td><p class="bold-font">{{$cbtEvaluation->studentname}}</p></td>
                </tr>
                <tr>
                    <td><span class="style8"><p class="bold-font-text">Student No</p></span></td>
                  <td><p class="bold-font">{{$cbtEvaluation->studentno}}</p></td>
                </tr>
                <tr>
                    <td><span class="style8"><p class="bold-font-text">Programme:</p></span></td>
                  <td><p class="bold-font">{{$cbtEvaluation->department}}</p></td>
                </tr>
                <tr>
                    <td><span class="style8"><p class="bold-font-text">Level:</p></span></td>
                  <td><p class="bold-font">{{$cbtEvaluation->level}}</p></td>
                </tr>
                @if($cbtEvaluation->exam_category == 'SEMESTER')
                <tr>
                    <td><span class="style8"><p class="bold-font-text">Semester:</p></span></td>
                  <td><p class="bold-font">{{$cbtEvaluation->semester}}</p></td>
                </tr>
                <tr>
                    <td><span class="style8"><p class="bold-font-text">Course:</p></span></td>
                  <td><p class="bold-font">{{$cbtEvaluation->course}}</p></td>
                </tr>
                @else

                @endif
                <tr>
                    <td><span class="style8"><p class="bold-font-text">Academic Session:</p></span></td>
                  <td><p class="bold-font">{{$cbtEvaluation->session1}}</p></td>
                </tr>
                <tr>
                    <td><span class="style8"><p class="bold-font-text">Total No of Questions:</p></span></td>
                  <td><p class="bold-font">{{$cbtEvaluation->noofquestion}}</p></td>
                </tr>
                <tr>
                    <td><span class="style8"><p class="bold-font-text">Score:</p></span></td>
                  <td><p class="bold-font">{{$cbtEvaluation->correct}}</p></td>
                </tr>
              </table></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            @if($cbtEvaluation->exam_type == 'ENTRANCE')
            <tr>
                <td colspan="2"><span class="style10"><p class="bold-font-text"><i>Note: Check your Portal to know the Cut off mark and the interview date.</i> </p></span></td>
            </tr>
            @else
            
            @endif
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            @if($cbtEvaluation->exam_type == 'ENTRANCE')
            <tr>
              <td colspan="2" align="center"><img src="{{asset('college/signature.jpg')}}" alt="" width="210" height="81"></td>
            </tr>
            @elseif($cbtEvaluation->exam_type == 'WEEDING-OUT')
            <tr>
              <td colspan="2" align="center"><img src="{{asset('college/signature.jpg')}}" alt="" width="210" height="81"></td>
            </tr>
            @else

            @endif
            </table>
           @else<table class="table">   
                    <li>
                      <tr>
												<div class="form-check">
													<label class="form-check-label">
                              <td><p class="bold-font">You have successfully completed the test, <strong>Exit the Computer based test</strong>.</p></td>
                          </label>
												</div>	
                        </tr>											
											</li> 										
                                      
                    </table>
            
           @endif
<hr>
            
          </div>   
<div>

<table width="100%">
  <tr>
    <td></td>
    <td><p><form action="" method="post">
                      @csrf
                      <div class="form-check">
													<label class="form-check-label">
                          <a href="{{route('student-logout')}}" class="btn btn-success btn-block">Exit Computer Based Test</a>                            
													</label>
												</div> 
                    </form></p></td>
    <td></td>
  </tr>
</table>
</div>
        
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
</body>


<!-- Mirrored from www.urbanui.com/melody/template/pages/layout/horizontal-menu.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:05:55 GMT -->
</html>
