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

    .bold-font {
    font-size: 24px;
    font-weight: bold;
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
              Computer Based Test - Check all information carefully before you proceed.
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('login')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Computer Based Test</li>
              </ol>
            </nav>
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
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-thumbtack"></i>
                    Computer Based Test
                  </h4>
                  <div class="border-bottom text-center pb-4">
                        <img src="{{asset('uploads/'. $studentData->picture_name . '.jpg')}}" alt="profile" class="img-lg rounded-circle mb-3"/>
                        
                        
                      </div>
									<div class="list-wrapper">
                  <ul class="d-flex flex-column-reverse todo-list">
                    <table class="table">   
                    <li>
                      <tr>
												<div class="form-check">
													<label class="form-check-label">
                              <td><p class="bold-font">You have not completed the test, <strong>Click Continue Computer based test</strong>.</p></td>
                          </label>
												</div>	
                        </tr>											
											</li> 
											
                      <li>
                      <tr>
												<div class="form-check">
													<label class="form-check-label">
														
                              <td><p class="bold-font">Time Left: {{$studentMin}} Mins</p></td>
                              <td><p class="bold-font"></p></td>
                            
													</label>
												</div>
                        </tr>												
											</li>                     
                    </table>
										</ul> 
                    <form action="" method="post">
                      @csrf
                      <div class="form-check">
													<label class="form-check-label">
                          <a href="{{route('cbt-page', ['id' => $studentData->id])}}" class="btn btn-success btn-block">Continue Computer Based Test</a>                            
													</label>
												</div> 
                    </form>                   
												                      											
											

									</div>
                </div>
              </div>
            </div>

            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-rocket"></i>
                    Exam Information
                  </h4>
                  <div class="table-responsive">
                    <table class="table">
                     <tr>
                      <td><p class="bold-text-font">Academic Session</p></td>
                      <td><p class="bold-text-font">{{$examSetting->session1}}</p></td>
                      <td></td>
                      <td></td>
                     </tr>
                     <tr>
                      <td><p class="bold-text-font">Programme</p></td>
                      <td><p class="bold-text-font">{{$examSetting->department}}</p></td>
                      <td></td>
                      <td></td>
                     </tr>
                     <tr>
                      <td><p class="bold-text-font">Level</p></td>
                      <td><p class="bold-text-font">{{$examSetting->level}}</p></td>
                      <td></td>
                      <td></td>
                     </tr>
                     @if($examSetting->exam_category == 'GENERAL')
                      <!-- <tr>
                      <td><p class="bold-text-font">Subject/Course</p></td>
                      <td><p class="bold-text-font">{{$examSetting->course}}</p></td>
                      <td></td>
                      <td></td>
                     </tr> -->
                     @elseif($examSetting->exam_category == 'SEMESTER')
                     <tr>
                      <td><p class="bold-text-font">Subject/Course</p></td>
                      <td><p class="bold-text-font">{{$examSetting->course}}</p></td>
                      <td></td>
                      <td></td>
                     </tr>
                     @endif
                     <tr>
                      <td><p class="bold-text-font">Exam Mode</p></td>
                      <td><p class="bold-text-font">{{$examSetting->exam_mode}}</p></td>
                      <td></td>
                      <td></td>
                     </tr>
                     <tr>
                      <td><p class="bold-text-font">Exam Category</p></td>
                      <td><p class="bold-text-font">{{$examSetting->exam_category}}</p></td>
                      <td></td>
                      <td></td>
                     </tr>
                     <tr>
                      <td><p class="bold-text-font">Exam Type</p></td>
                      <td><p class="bold-text-font">{{$examSetting->exam_type}}</p></td>
                      <td></td>
                      <td></td>
                     </tr>
                     <tr>
                      <td><p class="bold-text-font">Total no of Question</p></td>
                      <td><p class="bold-text-font">{{$examSetting->no_of_qst}}</p></td>
                      <td><p class="bold-text-font">Duration</p></td>
                      <td><p class="bold-text-font">{{$examSetting->duration}}mins</p></td>
                     </tr>                     
                     <!-- <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                     </tr> -->
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

</div>
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
