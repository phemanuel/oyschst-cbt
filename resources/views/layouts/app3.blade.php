<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSCE ::Result</title>

    <link rel="shortcut icon" href="{{ asset('/favicon.png') }}">

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Material Design Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.9.55/css/materialdesignicons.min.css" rel="stylesheet">

    <!-- Google Fonts Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;800&display=swap" rel="stylesheet">
<style>
    /* Add this CSS to your page or app.css */
.custom-modal-width {
    max-width: 1400px; /* or whatever width you prefer */
}

.graded-students ul li {
    padding: 2px 0;
    font-size: 0.9rem;
}
.graded-students ul li .badge {
    font-size: 0.75rem;
}

</style>
    @stack('styles')
</head>
<body class="bg-light">

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand navbar-dark bg-primary shadow-sm">
        <a class="navbar-brand font-weight-bold" href="{{ route('osce.dashboard') }}">
            OSCE Results
        </a>
        <ul class="navbar-nav ml-auto">
            <!-- Profile Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown">
                    <i class="mdi mdi-account-circle-outline"></i>
                   {{ auth()->user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- <a class="dropdown-item" href="{{ route('admin.profile') }}">
                        <i class="mdi mdi-account-outline mr-2"></i> Profile
                    </a> -->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('osce.logout') }}">
                        <i class="mdi mdi-logout mr-2"></i> Logout
                    </a>
                    
                </div>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block bg-light sidebar shadow-sm pt-4">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.check') }}">
                                <i class="mdi mdi-view-dashboard-outline mr-2"></i> Dashboard
                            </a>
                        </li>                      
                        

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('osce.logout') }}">
                                <i class="mdi mdi-logout mr-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main role="main" class="col-md-10 ml-sm-auto px-4 py-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-light shadow-sm">
        <div class="container text-center">
            <span class="text-muted">© 2020 - {{ date('Y') }} OSCE</span>
        </div>
    </footer>

    <!-- Scripts -->
     
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @stack('scripts')
</body>
</html>

@push('styles')
<style>
.sidebar {
    height: 100vh;
    position: fixed;
}
.hover-card {
    transition: transform 0.3s, box-shadow 0.3s;
}
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}
</style>
@endpush
