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
<body data-base-url="{{url('/')}}">

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
        <form action="{{route('admin-login.action')}}" method="post">
        @csrf
			<p align="center"><img src="{{asset('/OYSCHSTLOGO.png')}}" alt=""></p> 
			<hr>
          <div class="form-group">
            <label class="label">Email Address</label>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Email Address" name="email">
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline"></i>
                </span>
              </div>
            </div>
          </div>
          @error('email')
									<span class="invalid-feedback">{{ $message }}</span>
									@enderror
          <div class="form-group">
            <label class="label">Password</label>
            <div class="input-group">
              <input type="password" class="form-control" placeholder="*********" name="password">
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button class="btn btn-success submit-btn btn-block">Login</button>
          </div>
          <div class="form-group d-flex justify-content-between">
            
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