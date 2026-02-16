<!DOCTYPE html>
<html>
<head>
  <title>OSCE :: Home</title>
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
<style>
.hover-card {
    transition: transform 0.3s, box-shadow 0.3s;
}
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}
.cursor-pointer {
    cursor: pointer;
}
</style>
<style>
/* Hover pulse for separator */
@keyframes pulse {
    0% { transform: scaleX(1); opacity: 0.6; }
    50% { transform: scaleX(1.5); opacity: 1; }
    100% { transform: scaleX(1); opacity: 0.6; }
}

/* Fade + scale animation for elements */
@keyframes fadeScale {
    0% { opacity: 0; transform: scale(0.95); }
    100% { opacity: 1; transform: scale(1); }
}
</style>
</head>
<body style="background-image: url({{ url('assets/images/auth/bg2.jpg') }}); background-size: cover;">
<div class="d-flex justify-content-center align-items-center" >    
    <!-- Main Card -->
    <div class="card shadow-lg p-5" style="max-width: 900px; width: 100%; border-radius: 15px;">
         <!-- Admin Login Button (Top Right) -->
        <div style="position: absolute; top: 20px; right: 25px;">
            <a href="javascript:void(0);" 
            class="text-dark font-weight-bold"
            style="font-size: 0.9rem; text-decoration: none;"
            data-toggle="modal" 
            data-target="#adminLoginModal">
                <i class="mdi mdi-lock-outline mr-1"></i> Admin Login
            </a>
        </div>

        <div class="text-center mb-5 position-relative">
    <div class="text-center mb-5 position-relative">
    <!-- Logo with halo -->
    <div class="mx-auto mb-3" style="
        width: 130px; 
        height: 130px; 
        border-radius: 50%; 
        background: linear-gradient(135deg, #fff, #fff); 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        animation: fadeScale 1s ease-in-out;">
        <img src="{{ asset($collegeSetup->avatar) }}" 
             alt="School Logo" 
             style="max-width: 75px; max-height: 75px;" 
             class="img-fluid rounded-circle">
    </div>

    <!-- College Name -->
    <h2 class="mt-2" style="
        font-family: 'Montserrat', sans-serif; 
        font-weight: 800; 
        font-size: 1.5rem; 
        letter-spacing: 0.5px; 
        color: #2d3436;
        animation: fadeScale 1s 0.2s ease-in-out;">
        {{ $collegeSetup->name }}
    </h2>

    <!-- Animated separator -->
    <div class="mx-auto my-2" style="
        width: 50px; 
        height: 3px; 
        background: #00b894; 
        border-radius: 2px; 
        animation: pulse 1.5s infinite;">
    </div>

    <!-- Subtitle -->
    <p class="text-muted" style="
        font-family: 'Montserrat', sans-serif;
        font-weight: 500;
        font-size: 1rem;
        animation: fadeScale 1s 0.4s ease-in-out;">
        Choose your login type
    </p>
</div>
</div>

        <div class="row justify-content-center">
    <!-- Student Card -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm hover-card cursor-pointer" data-toggle="modal" data-target="#studentLoginModal">
            <div class="card-body text-center py-5">
                <i class="mdi mdi-school-outline display-4 text-success mb-3"></i>
                <h4 class="card-title">Student</h4>
                <p class="card-text text-muted">Login to access your MCQ stations and practical tests.</p>
            </div>
        </div>
    </div>

    <!-- Examiner Card -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm hover-card cursor-pointer" data-toggle="modal" data-target="#examinerLoginModal">
            <div class="card-body text-center py-5">
                <i class="mdi mdi-account-tie display-4 text-primary mb-3"></i>
                <h4 class="card-title">Examiner</h4>
                <p class="card-text text-muted">Login to grade students at practical stations.</p>
            </div>
        </div>
    </div>
</div>
        <!-- Footer -->
        <div class="text-center mt-5">
            <small class="text-muted">
                © 2020 - {{ date('Y') }} {{ $collegeSetup->name }}
            </small>
        </div>
    </div>
</div>


{{-- Student Login Modal --}}
<div class="modal fade @if($errors->has('admission_no') || $errors->has('department')) show @endif" id="studentLoginModal" tabindex="-1" aria-labelledby="studentLoginLabel" aria-hidden="true" @if($errors->has('admission_no') || $errors->has('department')) style="display:block;" @endif>
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('student.login') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="studentLoginLabel">Student Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Reg / Matric No</label>
                        <input type="text" name="admission_no" class="form-control @error('admission_no') is-invalid @enderror" placeholder="Enter your Reg/Matric No" value="{{ old('admission_no') }}">
                        @error('admission_no')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Programme</label>
                        <select name="department" class="form-control @error('department') is-invalid @enderror">
                            <option value="">-- Select Programme --</option>
                            @foreach($dept as $rs)
                                <option value="{{ $rs->department }}" @if(old('department') == $rs->department) selected @endif>{{ $rs->department }}</option>
                            @endforeach
                        </select>
                        @error('department')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Login</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Examiner Login Modal --}}
<div class="modal fade @if($errors->has('email') || $errors->has('password')) show @endif" id="examinerLoginModal" tabindex="-1" aria-labelledby="examinerLoginLabel" aria-hidden="true" @if($errors->has('email') || $errors->has('password')) style="display:block;" @endif>
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('examiner.login') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="examinerLoginLabel">Examiner Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your Email" value="{{ old('email') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your Password">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Login</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Admin Login Modal -->
<div class="modal fade" id="adminLoginModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="adminLoginForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Admin Login</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Login</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>

            </div>
        </form>
    </div>
</div>

</body>
</html>
<script src="{{asset('student/js/jquery-3.6.0.min.js')}}"></script>
<!-- base js -->
  <script src="{{ asset('js/app.js') }}"></script>
<!-- end base js -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Automatically show student modal if validation errors exist
    @if($errors->has('admission_no') || $errors->has('department'))
        var studentModal = new bootstrap.Modal(document.getElementById('studentLoginModal'));
        studentModal.show();
    @endif

    // Automatically show examiner modal if validation errors exist
    @if($errors->has('email') || $errors->has('password'))
        var examinerModal = new bootstrap.Modal(document.getElementById('examinerLoginModal'));
        examinerModal.show();
    @endif
});
</script>

<script>
$('#adminLoginForm').submit(function(e){
    e.preventDefault();

    $.ajax({
        url: "{{ route('osce.admin.login') }}",
        type: "POST",
        data: $(this).serialize(),
        success: function(res){
            if(res.status === 'success'){
                window.location.href = res.redirect;
            }
        },
        error: function(xhr){
            let message = xhr.responseJSON?.message ?? 'Login failed.';
            alert(message);
        }
    });
});

</script>


