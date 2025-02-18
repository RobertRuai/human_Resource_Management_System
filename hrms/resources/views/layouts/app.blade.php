<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>@yield('title') SSRA - HRMS Platform</title>
    @stack('styles')
</head>
<body class="d-flex flex-column vh-100">
    <div class="d-flex flex-grow-1" id="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar-wrapper text-light vh-100 ">
        <div class="ssra-logo">
            <div class="">
                <a href=""><img src="../images/favicon.png" alt=""></a>
            </div>
            <div class="">
                <a href="#"><h6>South Sudan<br>Revenue Authority</h6></a>
            </div>
        </div>
            <div class="nav-item dashboard">
                <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-bars me-2"></i>Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('divisions.index') }}" class="nav-link {{ Request::is('divisions') ? 'active' : '' }}">
                    <i class="fas fa-building me-2"></i>Divisions
                </a>
            </div> 
            <div class="nav-item">
                <a href="{{ route('departments.index') }}" class="nav-link {{ Request::is('departments') ? 'active' : '' }}">
                    <i class="fas fa-building me-2"></i>Departments
                </a>
            </div> 
            <div class="nav-item">
                <a href="{{ route('employees.index') }}" class="nav-link {{ Request::is('employees') ? 'active' : '' }}">
                    <i class="fas fa-users me-2"></i>Employees
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('leaves.index') }}" class="nav-link {{ Request::is('leaves') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt me-2"></i>Leaves
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('payrolls.index') }}" class="nav-link {{ Request::is('payrolls') ? 'active' : '' }}">
                    <i class="fas fa-money-check-alt me-2"></i>Payrolls
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('trainings.index') }}" class="nav-link {{ Request::is('trainings') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard-teacher me-2"></i>Trainings
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('hr.leaves.index') }}" class="nav-link {{ Request::is('hr.leaves') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt me-2"></i>Leave Approvals
                </a>
            </div>
            <div class="nav-item leave-approvals"></div>
            <div class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users') ? 'active' : '' }}">
                    <i class="fas fa-user me-2"></i>Users
                </a>
            </div><!--
            <div class="nav-item">
                <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles') ? 'active' : '' }}">
                    <i class="fas fa-user-tag me-2"></i>Roles
                </a>
            </div>-->
            <div class="nav-item">
                <a href="{{ route('notifications.index') }}" class="nav-link {{ Request::is('notifications') ? 'active' : '' }}">
                    <i class="fas fa-bell me-2"></i>Notifications
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('audit_logs.index') }}" class="nav-link {{ Request::is('audit_logs') ? 'active' : '' }}">
                    <i class="fas fa-file-alt me-2"></i>Audit Logs
                </a>
            </div>
        </nav>
        <div id="page-content-wrapper" class="w-100">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            @guest
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                                @if (Route::has('register'))
                                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" 
                                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->username }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container-fluid px-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
         document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar-wrapper').classList.toggle('active');
        });
    </script>
    @stack('scripts')
</body>
</html>
