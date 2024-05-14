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
    font-size: 13px;
    font-weight: bold;  
    color: white;  
}

    .bold-font {
    font-size: 16px;
    font-weight: bold;
}

.bold-font-ans {
    font-size: 16px;
    font-weight: bold;
    color: red;
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
            <strong><p class="bold-text">Oyo State College of Health Science and Technology</p></strong>
            </a>            
          </li> 
          <li class="nav-item dropdown">            
            <a class="nav-link" href="#" id="projects-dropdown" data-toggle="dropdown" aria-expanded="false">            
            <strong><p class="bold-text-font">{{$studentData->admission_no}}</p></strong>
            </a>            
          </li>   
          <li class="nav-item dropdown">            
            <a class="nav-link active" href="#" id="projects-dropdown" data-toggle="dropdown" aria-expanded="false">            
            <strong><p class="bold-text-font">{{ $studentData->surname }} {{ $studentData->first_name }} {{ $studentData->other_name }}</p></strong>
            </a>            
          </li>   
          <li class="nav-item dropdown">            
            <a class="nav-link" href="#" id="projects-dropdown" data-toggle="dropdown" aria-expanded="false">           
            <strong><p class="bold-text-font">{{$studentData->department}} | {{$studentData->level}}</p></strong>            
            </a>             
          </li> 
          <li class="nav-item dropdown">            
            <a class="nav-link active" href="#" id="projects-dropdown" data-toggle="dropdown" aria-expanded="false">           
            <strong><p class="bold-text-font">{{$examSetting->no_of_qst}}qst | {{$examSetting->duration}}mins</p></strong>            
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
                <form class="d-flex align-items-stretch h-100" action="#">
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-search"></i>                                          
                        </span>
                    </div>
                    <input type="text" class="form-control" placeholder="Search your projects ...">
                  </div>
                </form>
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
              Computer Based Test - Read questions carefully and select the answer appropriately.
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">                
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
            <form action="{{route('check-page', ['id' =>$studentData->id])}}" method="post" id="answerForm">
              @csrf
          <!-- begin card -->
            <div class="col-12 grid-margin">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q1'] }} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                      <tr>                        
                        <td><p class="bold-font">{!! $question1->question !!}</p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                      <td width="82%">
                      <input type="submit" name="option1A" id="option1A" value="       A        " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option1B" id="option1B" value="      B         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option1C" id="option1C" value="      C         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option1D" id="option1D" value="       D        " class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <p class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a1']} }}</p>
                        <input type="hidden" name="q1" id="q1" value="{{ $questionNo['q1'] }}">
                        
                        </td>
                        <td></td>
                        <td></p></td>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->
           <!-- begin card -->
           <div class="col-12 grid-margin">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q2'] }} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                      <tr>                        
                        <td><p class="bold-font">{!!$question2->question!!} </p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                      <td><input type="submit" name="option2A" id="option2A" value="       A        " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option2B" id="option2B" value="      B         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option2C" id="option2C" value="      C         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option2D" id="option2D" value="       D        " class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <p class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a2']} }}</p>
                        <input type="hidden" name="q2" value="{{ $questionNo['q2'] }}">
                        </td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->
           <!-- begin card -->
           <div class="col-12 grid-margin">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q3'] }} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                      <tr>                        
                        <td><p class="bold-font">{!!$question3->question!!} </p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                      <td width="82%"><input type="submit" name="option3A" id="option3A" value="       A        " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option3B" id="option3B" value="      B         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option3C" id="option3C" value="      C         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option3D" id="option3D" value="       D        " class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <p class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a3']} }}</p>
                        <input type="hidden" name="q3" id="questionNumber" value="{{ $questionNo['q3'] }}">
                        </td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->
           <form action="" method="post">
           <!-- begin card -->
           <div class="col-12 grid-margin">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q4'] }} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                      <tr>                        
                        <td><p class="bold-font">{!!$question4->question!!} </p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                      <td><input type="submit" name="option4A" id="option4A" value="       A        " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option4B" id="option4B" value="      B         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option4C" id="option4C" value="      C         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option4D" id="option4D" value="       D        " class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <p class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a4']} }}</p>
                        <input type="hidden" name="q4" id="questionNumber" value="{{ $questionNo['q4'] }}">
                        </td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->
           <!-- begin card -->
           <div class="col-12 grid-margin">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q5'] }} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                      <tr>                        
                        <td><p class="bold-font">{!!$question5->question!!} </p></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                      <td><input type="submit" name="option5A" id="option5A" value="       A        " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option5B" id="option5B" value="      B         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option5C" id="option5C" value="      C         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option5D" id="option5D" value="       D        " class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <p class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a5']} }}</p>
                        <input type="hidden" name="q5" id="questionNumber" value="{{ $questionNo['q5'] }}">
                        </td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->
           <!-- begin card -->
           <div class="col-12 grid-margin">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q6'] }} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                      <tr>                        
                        <td><p class="bold-font">{!!$question6->question!!} </p></td>
                        <td></td>
                      </tr>
                      <tr>
                      <td><input type="submit" name="option6A" id="option6A" value="       A        " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option6B" id="option6B" value="      B         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option6C" id="option6C" value="      C         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option6D" id="option6D" value="       D        " class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <p class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a6']} }}</p>
                        <input type="hidden" name="q6" id="questionNumber" value="{{ $questionNo['q6'] }}">
                        </td>
                        <td></td>
                      </tr>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->
           <!-- begin card -->
           <div class="col-12 grid-margin">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q7'] }} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                      <tr>                        
                        <td><p class="bold-font">{!!$question7->question!!} </p></td>
                        <td></td>
                      </tr>
                      <tr>
                      <td><input type="submit" name="option7A" id="option7A" value="       A        " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option7B" id="option7B" value="      B         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option7C" id="option7C" value="      C         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option7D" id="option7D" value="       D        " class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <p class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a7']} }}</p>
                        <input type="hidden" name="q7" id="questionNumber" value="{{ $questionNo['q7'] }}">
                        </td>
                        <td></td>
                      </tr>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->
           <!-- begin card -->
           <div class="col-12 grid-margin">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q8'] }} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                      <tr>                        
                        <td><p class="bold-font">{!!$question8->question!!} </p></td>
                        <td></td>
                      </tr>
                      <tr>
                      <td><input type="submit" name="option8A" id="option8A" value="       A        " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option8B" id="option8B" value="      B         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option8C" id="option8C" value="      C         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option8D" id="option8D" value="       D        " class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <p class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a8']} }}</p>
                        <input type="hidden"  name="q8" id="questionNumber" value="{{ $questionNo['q8'] }}">
                        </td>
                        <td></td>
                      </tr>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->
           <!-- begin card -->
           <div class="col-12 grid-margin">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q9'] }} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                      <tr>                        
                        <td><p class="bold-font">{!!$question9->question!!} </p></td>
                        <td></td>
                      </tr>
                      <tr>
                      <td><input type="submit" name="option9A" id="option9A" value="       A        " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option9B" id="option9B" value="      B         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option9C" id="option9C" value="      C         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option9D" id="option9D" value="       D        " class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <p class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a9']} }}</p>
                        <input type="hidden" name="q9" id="questionNumber" value="{{ $questionNo['q9'] }}">
                        </td>
                        <td></td>
                      </tr>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->
           <!-- begin card -->
           <div class="col-12 grid-margin">            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> 
                    <strong>Question {{ $questionNo['q10'] }} </strong>
                  </h4>
                  <div class="table-responsive">
                    <table class="table" width="100%">
                      <tr>                        
                        <td><p class="bold-font">{!!$question10->question!!} </p></td>
                        <td></td>
                      </tr>
                      <tr>
                      <td><input type="submit" name="option10A" id="option10A" value="       A        " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option10B" id="option10B" value="      B         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option10C" id="option10C" value="      C         " class="btn btn-dark"/> &nbsp; &nbsp;
                        <input type="submit" name="option10D" id="option10D" value="       D        " class="btn btn-dark"/>&nbsp; &nbsp;&nbsp; &nbsp;
                        <p class="bold-font-ans">{{ $studentAnswer->{"OK" . $questionNo['a10']} }}</p>
                        <input type="hidden" name="q10" id="questionNumber" value="{{ $questionNo['q10'] }}">
                        </td>
                        <td></td>
                      </tr>
                    </table>                    
                  </div>
                </div>                
              </div>
            </div>
           <!-- end card -->
           <input type="hidden" name="pageNo" value ="{{$pageNo}}">
  </form>
            <div class="col-12 grid-margin">            
              <div class="card">
                <div class="card-body">
                  @if($examSetting->no_of_qst == 10)
                    <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">1-10</a>                  
                  @elseif($examSetting->no_of_qst == 20)
                    <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">1-10</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page2', ['id' => $studentData->id])}}" class="btn btn-success">11-20</a>                  
                  @elseif($examSetting->no_of_qst == 30)
                    <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">1-10</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page2', ['id' => $studentData->id])}}" class="btn btn-success">11-20</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page3', ['id' => $studentData->id])}}" class="btn btn-success">21-30</a>  
                  @elseif($examSetting->no_of_qst == 40)
                    <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">1-10</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page2', ['id' => $studentData->id])}}" class="btn btn-success">11-20</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page3', ['id' => $studentData->id])}}" class="btn btn-success">21-30</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page4', ['id' => $studentData->id])}}" class="btn btn-success">31-40</a>   
                  @elseif($examSetting->no_of_qst == 50)
                    <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">1-10</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page2', ['id' => $studentData->id])}}" class="btn btn-success">11-20</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page3', ['id' => $studentData->id])}}" class="btn btn-success">21-30</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page4', ['id' => $studentData->id])}}" class="btn btn-success">31-40</a>&nbsp; &nbsp; 
                    <a href="{{route('cbt-page5', ['id' => $studentData->id])}}" class="btn btn-success">41-50</a>  
                  @elseif($examSetting->no_of_qst == 60)
                    <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">1-10</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page2', ['id' => $studentData->id])}}" class="btn btn-success">11-20</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page3', ['id' => $studentData->id])}}" class="btn btn-success">21-30</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page4', ['id' => $studentData->id])}}" class="btn btn-success">31-40</a>&nbsp; &nbsp; 
                    <a href="{{route('cbt-page5', ['id' => $studentData->id])}}" class="btn btn-success">41-50</a>&nbsp; &nbsp; 
                    <a href="{{route('cbt-page6', ['id' => $studentData->id])}}" class="btn btn-success">51-60</a>  
                  @elseif($examSetting->no_of_qst == 70)
                    <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">1-10</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page2', ['id' => $studentData->id])}}" class="btn btn-success">11-20</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page3', ['id' => $studentData->id])}}" class="btn btn-success">21-30</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page4', ['id' => $studentData->id])}}" class="btn btn-success">31-40</a>&nbsp; &nbsp; 
                    <a href="{{route('cbt-page5', ['id' => $studentData->id])}}" class="btn btn-success">41-50</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page6', ['id' => $studentData->id])}}" class="btn btn-success">51-60</a>&nbsp; &nbsp; 
                    <a href="{{route('cbt-page7', ['id' => $studentData->id])}}" class="btn btn-success">61-70</a>   
                  @elseif($examSetting->no_of_qst == 80)
                    <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">1-10</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page2', ['id' => $studentData->id])}}" class="btn btn-success">11-20</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page3', ['id' => $studentData->id])}}" class="btn btn-success">21-30</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page4', ['id' => $studentData->id])}}" class="btn btn-success">31-40</a>&nbsp; &nbsp; 
                    <a href="{{route('cbt-page5', ['id' => $studentData->id])}}" class="btn btn-success">41-50</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page6', ['id' => $studentData->id])}}" class="btn btn-success">51-60</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page7', ['id' => $studentData->id])}}" class="btn btn-success">61-70</a>&nbsp; &nbsp;  
                    <a href="{{route('cbt-page8', ['id' => $studentData->id])}}" class="btn btn-success">71-80</a> 
                  @elseif($examSetting->no_of_qst == 90)
                    <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">1-10</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page2', ['id' => $studentData->id])}}" class="btn btn-success">11-20</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page3', ['id' => $studentData->id])}}" class="btn btn-success">21-30</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page4', ['id' => $studentData->id])}}" class="btn btn-success">31-40</a>&nbsp; &nbsp; 
                    <a href="{{route('cbt-page5', ['id' => $studentData->id])}}" class="btn btn-success">41-50</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page6', ['id' => $studentData->id])}}" class="btn btn-success">51-60</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page7', ['id' => $studentData->id])}}" class="btn btn-success">61-70</a>&nbsp; &nbsp;  
                    <a href="{{route('cbt-page8', ['id' => $studentData->id])}}" class="btn btn-success">71-80</a>&nbsp; &nbsp;  
                    <a href="{{route('cbt-page9', ['id' => $studentData->id])}}" class="btn btn-success">81-90</a>   
                  @elseif($examSetting->no_of_qst == 100)
                    <a href="{{route('cbt-page1', ['id' => $studentData->id])}}" class="btn btn-success">1-10</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page2', ['id' => $studentData->id])}}" class="btn btn-success">11-20</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page3', ['id' => $studentData->id])}}" class="btn btn-success">21-30</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page4', ['id' => $studentData->id])}}" class="btn btn-success">31-40</a>&nbsp; &nbsp; 
                    <a href="{{route('cbt-page5', ['id' => $studentData->id])}}" class="btn btn-success">41-50</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page6', ['id' => $studentData->id])}}" class="btn btn-success">51-60</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page7', ['id' => $studentData->id])}}" class="btn btn-success">61-70</a>&nbsp; &nbsp;  
                    <a href="{{route('cbt-page8', ['id' => $studentData->id])}}" class="btn btn-success">71-80</a>&nbsp; &nbsp;
                    <a href="{{route('cbt-page9', ['id' => $studentData->id])}}" class="btn btn-success">81-90</a>&nbsp; &nbsp;  
                    <a href="{{route('cbt-page10', ['id' => $studentData->id])}}" class="btn btn-success">91-100</a> 
                       
                  @endif
                  &nbsp; &nbsp;
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal-2">
                    Submit Test</button>
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
                  <!-- <a href="" class="btn btn-success">Submit</a> -->
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

  <!-- <script>
    // Attach event listeners to the buttons
    //--A
    document.getElementById('option1A').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the value of the selected answer
        var selectedAnswer = 'A';
        var questionNumber = document.getElementById('questionNumber').value;

        // Send AJAX request to update the answer
        updateAnswer(questionNumber, selectedAnswer);
    });

    //--B
    document.getElementById('option1B').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the value of the selected answer
        var selectedAnswer = 'B';
        var questionNumber = document.getElementById('questionNumber').value;

        // Send AJAX request to update the answer
        updateAnswer(questionNumber, selectedAnswer);
    });

    //--C
    document.getElementById('option1C').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the value of the selected answer
        var selectedAnswer = 'C';
        var questionNumber = document.getElementById('questionNumber').value;

        // Send AJAX request to update the answer
        updateAnswer(questionNumber, selectedAnswer);
    });

    //--D
    document.getElementById('option1D').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the value of the selected answer
        var selectedAnswer = 'D';
        var questionNumber = document.getElementById('questionNumber').value;

        // Send AJAX request to update the answer
        updateAnswer(questionNumber, selectedAnswer);
    });

    // Repeat for options B, C, and D

    function updateAnswer(questionNumber, selectedAnswer) {
        // Send AJAX request to update the answer
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "{{ route('update-answer', ['id' => $studentData->id]) }}", true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Handle success response
                    console.log(xhr.responseText);
                } else {
                    // Handle error response
                    console.error('Request failed:', xhr.statusText);
                }
            }
        };
        
        var data = JSON.stringify({ questionNumber: questionNumber, answer: selectedAnswer });
        xhr.send(data);
    }
</script> -->


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


<!-- Mirrored from www.urbanui.com/melody/template/pages/layout/horizontal-menu.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:05:55 GMT -->
</html>
