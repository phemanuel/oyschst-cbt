<!DOCTYPE html>
<html>
<head>
  <title>@yield('pageTitle')</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  
  <link rel="shortcut icon" href="{{ asset('/favicon.png') }}">

  <!-- plugin css -->
<link href="{{ asset('assets/plugins/@mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet">
<!-- end plugin css -->

<!-- plugin css -->
@stack('plugin-styles')
<!-- end plugin css -->

<!-- common css -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!-- end common css -->
<!-- <style>
        body {
          background-image: url({{asset('/bg2.jpg')}});
            /* Additional styling */
            background-size: cover; /* Adjust as needed */
            background-repeat: no-repeat; /* Adjust as needed */
        }
    .style2 {
	font-size: 12px;
	font-weight: bold;
}
    .style3 {font-size: 12px}
    </style> -->
	<style>
		.input-font-size-12 {
    font-size: 12px;
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

  @stack('style')

</head>
<body>

  <div class="container-scroller" id="app">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
	<div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('assets/images/auth/bg2.jpg') }}); background-size: cover;">
  <div class="row w-100">
    <div class="col-lg-4 mx-auto">
      <div class="auto-form-wrapper">
	  @if(session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
          @elseif(session('error'))
						<div class="alert alert-danger">
							{{ session('error') }}
						</div>
						@endif	
        <form id="start-cbt-form" method="post" action="{{route('login.action')}}">
			@csrf
			<p align="center"><img src="{{asset('/OYSCHSTLOGO.png')}}" alt=""></p> 
			<hr>
          <div class="form-group">
            <strong><label class="label">Reg/Matric No</label></strong>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Reg/Matric No" name="admission_no">
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline"></i>
                </span>
              </div>
            </div>
          </div>
          @error('admission_no')
									<span class="invalid-feedback">{{ $message }}</span>
									@enderror
          <div class="form-group">
            <strong><label class="label">Programme</label></strong>
            <div class="input-group">
              <select name="department" id="" class="form-control input-font-size-12">
				@foreach($dept as $rs)
				<option value="{{$rs->department}}">{{$rs->department}}</option>
				@endforeach
			  </select>
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline"></i>
                </span>
              </div>
            </div>
          </div>
          @error('department')
									<span class="invalid-feedback">{{ $message }}</span>
									@enderror
          <div class="form-group">
            <button class="btn btn-success submit-btn btn-block" id="start-cbt-button">Login</button>
          </div>
          
          <div class="form-group">
            <!-- preload user information -->
          </div>
          <div class="text-block text-center my-3">
            <span class="text-small font-weight-semibold">© 2020 - <?php echo date('Y') ?> {{$collegeSetup->name}}.</span>
            
          </div>
        </form>
      </div>     
      
    </div>
  </div>
</div>
    </div>
  </div>
  

  <!-- base js -->
  <script src="{{ asset('js/app.js') }}"></script>
<!-- end base js -->

<!-- plugin js -->
@stack('plugin-scripts')
<!-- end plugin js -->

<!-- custom scripts -->
@stack('custom-scripts')



</body>
</html>