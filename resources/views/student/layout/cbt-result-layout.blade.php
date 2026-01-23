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
            <strong><p class="bold-text">{{$collegeSetup->name}}</p></strong>
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
            <!-- Page Header -->
            <div class="page-header mb-4">
                <!-- <h3 class="page-title">Computer Based Test - Result</h3> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('login') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Computer Based Test</li>
                    </ol>
                </nav>
            </div>

            <!-- Completion Message -->
            <!-- <div class="alert alert-success text-center">
                <strong>You have successfully completed the test!</strong>
            </div> -->            

            <!-- Result Card -->
            @if($examSetting->check_result == 1)
            <div class="card shadow-sm mb-4" style="max-width: 900px; margin: 0 auto;">
                <div class="card-body">
                    <!-- College Logo and Name -->
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <img src="{{ asset($collegeSetup->avatar) }}" alt="College Logo" style="height:80px;" class="mr-3">
                        <h2 class="mb-0 text-center">{{ $collegeSetup->name }}</h2>
                    </div>

                    <!-- Result Title -->
                    <h5 class="text-center text-uppercase mb-4">
                        {{ $cbtEvaluation->session1 }} {{ $cbtEvaluation->exam_type }} Result Confirmation Slip
                    </h5>

                    <div class="row mb-4">
                        <!-- Student Photo -->
                        <div class="col-md-3 text-center">
                            <img src="{{ asset('uploads/' . $cbtEvaluation->studentno . '.jpg') }}" 
                                 alt="Student Photo" class="img-fluid rounded" style="max-height: 140px;">
                        </div>

                        <!-- Student Info -->
                        <div class="col-md-9">
                            <table class="table table-borderless table-sm mb-0">
                                <tr>
                                    <th>Examination Date:</th>
                                    <td>{{ \Carbon\Carbon::parse($cbtEvaluation->examdate)->format('F j, Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Student Name:</th>
                                    <td>{{ $cbtEvaluation->studentname }}</td>
                                </tr>
                                <tr>
                                    <th>Student No:</th>
                                    <td>{{ $cbtEvaluation->studentno }}</td>
                                </tr>
                                <tr>
                                    <th>Programme:</th>
                                    <td>{{ $cbtEvaluation->department }}</td>
                                </tr>
                                <tr>
                                    <th>Level:</th>
                                    <td>{{ $cbtEvaluation->level }}</td>
                                </tr>
                                @if($cbtEvaluation->exam_category == 'SEMESTER')
                                <tr>
                                    <th>Semester:</th>
                                    <td>{{ $cbtEvaluation->semester }}</td>
                                </tr>
                                <tr>
                                    <th>Course:</th>
                                    <td>{{ $cbtEvaluation->course }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th>Academic Session:</th>
                                    <td>{{ $cbtEvaluation->session1 }}</td>
                                </tr>
                                <tr>
                                    <th>Total Questions:</th>
                                    <td>{{ $cbtEvaluation->noofquestion }}</td>
                                </tr>
                                <tr>
                                    <th>Score:</th>
                                    <td>{{ $cbtEvaluation->correct }}</td>
                                </tr>
                            </table>                            

                            @if($cbtEvaluation->exam_type == 'ENTRANCE')
                            <p class="mt-3 text-center"><i>Check your Portal for Cut-off mark and interview date.</i></p>
                            @endif
                        </div>
                    </div>

                    <!-- Signature -->
                    <div class="text-center mt-4">
                        <img src="{{ asset('college/signature.jpg') }}" alt="Signature" width="210">
                    </div>
                </div>
            </div>
            @else
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h4>You have successfully completed the test. <strong>Exit the Computer Based Test</strong>.</h4>
                </div>
            </div>
            @endif

            <!-- Exit and Print Buttons Responsive -->
            <div class="d-flex flex-column flex-md-row justify-content-center mt-4" style="gap: 10px;">
                <!-- Exit Button -->
                <a href="{{ route('student-logout') }}" class="btn btn-success btn-lg">Exit Computer Based Test</a>

                <!-- Print Button -->
                @if($examSetting->check_result === 1)
                    <a href="#" onclick="window.print();" class="btn btn-info btn-lg">Print Slip</a>
                @endif
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
