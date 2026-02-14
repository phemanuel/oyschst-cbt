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
        <form id="start-cbt-form" method="post" action="{{ route('login.action') }}" class="p-4">
    @csrf

    <!-- Logo -->
    <div class="text-center mb-3">
        <img 
            src="{{ asset($collegeSetup->avatar) }}" 
            alt="School Logo" 
            style="max-width: 120px;"
            class="img-fluid"
        >
    </div>

    <hr>

    <!-- Reg / Matric Number -->
    <div class="form-group mb-3">
        <label class="font-weight-bold">Reg / Matric No</label>
        <div class="input-group">
            <input 
                type="text" 
                class="form-control @error('admission_no') is-invalid @enderror" 
                placeholder="Enter your Reg/Matric No"
                name="admission_no"
                value="{{ old('admission_no') }}"
            >
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="mdi mdi-account-outline"></i>
                </span>
            </div>
        </div>
        @error('admission_no')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <!-- Programme -->
    <div class="form-group mb-4">
        <label class="font-weight-bold">Programme</label>
        <div class="input-group">
            <select 
                name="department" 
                class="form-control @error('department') is-invalid @enderror"
            >
                <option value="">-- Select Programme --</option>
                @foreach($dept as $rs)
                    <option value="{{ $rs->department }}">
                        {{ $rs->department }}
                    </option>
                @endforeach
            </select>
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="mdi mdi-school-outline"></i>
                </span>
            </div>
        </div>
        @error('department')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="form-group mb-4">
        <button 
            type="submit" 
            class="btn btn-success btn-block py-2 font-weight-bold"
            id="start-cbt-button"
        >
            Login
        </button>
    </div>

    <!-- Admin Login Link -->
<!-- <div class="text-center mb-3">
    <a href="{{ route('admin-login') }}" 
       class="btn btn-outline-primary btn-sm font-weight-bold"
       style="min-width: 150px;">
       <i class="mdi mdi-lock-outline mr-1"></i> Admin Login
    </a>
</div> -->


    <!-- Footer -->
    <div class="text-center mt-4">
        <small class="text-muted">
            © 2020 - {{ date('Y') }} {{ $collegeSetup->name }}
        </small>
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