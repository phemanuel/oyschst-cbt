<!DOCTYPE html>
<html>
<head>
  <title>OSCE :: Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="_token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('/favicon.png') }}">

  <!-- CSS -->
  <link href="{{ asset('assets/plugins/@mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <style>
    .input-font-size-12 { font-size: 12px; }
    .hover-card { transition: transform 0.3s, box-shadow 0.3s; cursor: pointer; }
    .hover-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.15); }

    @keyframes pulse {
        0% { transform: scaleX(1); opacity: 0.6; }
        50% { transform: scaleX(1.5); opacity: 1; }
        100% { transform: scaleX(1); opacity: 0.6; }
    }
    @keyframes fadeScale {
        0% { opacity: 0; transform: scale(0.95); }
        100% { opacity: 1; transform: scale(1); }
    }

    .alert-success { background-color: #28a745; color: #fff; border-radius: 5px; padding: 10px; }
    .alert-danger { background-color: #dc3545; color: #fff; border-radius: 5px; padding: 10px; }

    /* custom input styles */
.input-field {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 14px;
    color: #495057;
    background-color: #fff;
}

/* select box */
.select-field {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 14px;
    color: #495057;
    background-color: #fff;
    appearance: none; /* remove default arrow if needed */
}

  </style>
</head>
<body style="background-image: url({{ url('assets/images/auth/bg2.jpg') }}); background-size: cover;">

<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-5" style="max-width: 900px; width: 100%; border-radius: 15px; position: relative;">

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif

        <!-- Admin Login Button -->
        <div style="position: absolute; top: 20px; right: 25px;">
            <a href="javascript:void(0);" class="text-dark font-weight-bold" style="font-size: 0.9rem;" data-toggle="modal" data-target="#adminLoginModal">
                <i class="mdi mdi-lock-outline mr-1"></i> Admin Login
            </a>
        </div>

        <!-- Logo + College Info -->
        <div class="text-center mb-5 position-relative">
            <div class="mx-auto mb-3" style="width:130px; height:130px; border-radius:50%; background:#fff; display:flex; align-items:center; justify-content:center; box-shadow:0 8px 20px rgba(0,0,0,0.2); animation:fadeScale 1s;">
                <img src="{{ asset($collegeSetup->avatar) }}" alt="School Logo" class="img-fluid rounded-circle" style="max-width:75px;">
            </div>
            <h2 class="mt-2" style="font-weight:800; font-size:1.5rem; color:#2d3436; animation:fadeScale 1s 0.2s;">
                {{ $collegeSetup->name }}
            </h2>
            <div class="mx-auto my-2" style="width:50px; height:3px; background:#00b894; border-radius:2px; animation:pulse 1.5s infinite;"></div>
            <p class="text-muted" style="animation:fadeScale 1s 0.4s;">Choose your login type</p>
        </div>

        <!-- Login Cards -->
        <div class="row justify-content-center">
            <!-- Examiner -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm hover-card" data-toggle="modal" data-target="#examinerLoginModal">
                    <div class="card-body text-center py-5">
                        <i class="mdi mdi-account-tie display-4 text-primary mb-3"></i>
                        <h4 class="card-title">Examiner</h4>
                        <p class="text-muted">Login to grade students at practical stations.</p>
                    </div>
                </div>
            </div>
            <!-- Student -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm hover-card" data-toggle="modal" data-target="#studentLoginModal">
                    <div class="card-body text-center py-5">
                        <i class="mdi mdi-school-outline display-4 text-success mb-3"></i>
                        <h4 class="card-title">Student</h4>
                        <p class="text-muted">Login to access your MCQ stations and practical tests.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-5"><small class="text-muted">© 2020 - {{ date('Y') }} {{ $collegeSetup->name }}</small></div>
    </div>
</div>

<!-- ---------------- STUDENT LOGIN MODAL ---------------- -->
<div class="modal fade" id="studentLoginModal" tabindex="-1" role="dialog" aria-labelledby="studentLoginLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('student.login') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="studentLoginLabel">Student Login</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    {{-- Admission / Matric No --}}
                    <div class="form-group">
                        <label>Reg / Matric No</label>
                        <input type="text" name="admission_no" class="input-field @error('admission_no') is-invalid @enderror" placeholder="Enter your Reg/Matric No" value="{{ old('admission_no') }}">
                        @error('admission_no') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Department --}}
                    <div class="form-group">
                        <label>Programme</label>
                        <select name="department" class="select-field @error('department') is-invalid @enderror">
                            <option value="" {{ old('department', '') === '' ? 'selected' : '' }}>-- Select Programme --</option>
                            @foreach($dept as $rs)
                                <option value="{{ $rs->department }}" {{ old('department') === $rs->department ? 'selected' : '' }}>
                                    {{ $rs->department }}
                                </option>
                            @endforeach
                        </select>
                        @error('department') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Session error --}}
                    @if(session('error'))
                        <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Login</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ---------------- EXAMINER LOGIN MODAL ---------------- -->
<div class="modal fade" id="examinerLoginModal" tabindex="-1" role="dialog" aria-labelledby="examinerLoginLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('examiner.login') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="examinerLoginLabel">Examiner Login</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="input-field @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="input-field @error('password') is-invalid @enderror">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
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

<!-- ---------------- ADMIN LOGIN MODAL ---------------- -->
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
                        <input type="email" name="email" class="input-field" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="input-field" required>
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

<!-- Scripts -->
<script src="{{ asset('student/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    // Show Student modal if errors or session error exist
    @if($errors->has('admission_no') || $errors->has('department') || session('error'))
        $('#studentLoginModal').modal('show');
    @endif

    // Show Examiner modal if errors
    @if($errors->has('email') || $errors->has('password'))
        $('#examinerLoginModal').modal('show');
    @endif

    // Admin AJAX login
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
});
</script>
</body>
</html>
