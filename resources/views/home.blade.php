<!DOCTYPE html>
<html>
<head>
  <title>Computer Based Test</title>
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
       
			<p align="center"><img src="{{asset('/OYSCHSTLOGO.png')}}" alt=""></p> 
			<hr>
            <table width="394" border="0" align="center" cellpadding="3" cellspacing="3">
  <tr>
    <td width="185"><a href="{{route('admin-login')}}"><img src="{{asset('dashboard/dist/img/admin.png')}}" width="185" height="185" /></a> </td>
    <td width="10">&nbsp;</td>
    <td width="185"><a href="{{route('login')}}"><img src="{{asset('dashboard/dist/img/student.png')}}" width="185" height="185" /></a> </td>
  </tr>
</table>
          
          <div class="text-block text-center my-3">
          <span class="text-small font-weight-semibold">© 2020 - <?php echo date('Y') ?> Oyo State College of Health Science and Technology.</span>
            
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