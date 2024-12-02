<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - HR Management</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    @stack('styles')
</head>
<body class="d-flex flex-column vh-100 bg-light">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper" class="bg-info text-light">
            <div class="sidebar-heading text-center py-4 fs-4 fw-bold text-uppercase border-bottom">
                <i class="fas fa-users-cog me-2"></i>HR Management
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('dashboard') }}" 
                   class="list-group-item list-group-item-action bg-info text-light {{ Request::is('dashboard') ? 'active bg-primary text-white' : '' }}">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
                <a href="{{ route('users.index') }}" 
                   class="list-group-item list-group-item-action bg-info text-light {{ Request::is('users') ? 'active bg-primary text-white' : '' }}">
                    <i class="fas fa-user me-2"></i> Users
                </a>
                <a href="{{ route('roles.index') }}" 
                   class="list-group-item list-group-item-action bg-info text-light {{ Request::is('roles') ? 'active bg-primary text-white' : '' }}">
                    <i class="fas fa-user-tag me-2"></i> Roles
                </a>
                <a href="{{ route('employees.index') }}" 
                   class="list-group-item list-group-item-action bg-info text-light {{ Request::is('employees') ? 'active bg-primary text-white' : '' }}">
                    <i class="fas fa-briefcase me-2"></i> Employees
                </a>
                <a href="{{ route('departments.index') }}" 
                   class="list-group-item list-group-item-action bg-info text-light {{ Request::is('departments') ? 'active bg-primary text-white' : '' }}">
                    <i class="fas fa-building me-2"></i> Departments
                </a>
                <a href="{{ route('salaries.index') }}" 
                   class="list-group-item list-group-item-action bg-info text-light {{ Request::is('salaries') ? 'active bg-primary text-white' : '' }}">
                    <i class="fas fa-money-check-alt me-2"></i> Salaries
                </a>
                <a href="{{ route('leaves.index') }}" 
                   class="list-group-item list-group-item-action bg-info text-light {{ Request::is('leaves') ? 'active bg-primary text-white' : '' }}">
                    <i class="fas fa-calendar-alt me-2"></i> Leaves
                </a>
                <a href="{{ route('trainings.index') }}" 
                   class="list-group-item list-group-item-action bg-info text-light {{ Request::is('trainings') ? 'active bg-primary text-white' : '' }}">
                    <i class="fas fa-chalkboard-teacher me-2"></i> Trainings
                </a>
                <a href="{{ route('notifications.index') }}" 
                   class="list-group-item list-group-item-action bg-info text-light {{ Request::is('notifications') ? 'active bg-primary text-white' : '' }}">
                    <i class="fas fa-bell me-2"></i> Notifications
                </a>
                <a href="{{ route('audit_logs.index') }}" 
                   class="list-group-item list-group-item-action bg-info text-light {{ Request::is('audit_logs') ? 'active bg-primary text-white' : '' }}">
                    <i class="fas fa-file-alt me-2"></i> Audit Logs
                </a>
            </div>
        </div>
        <!-- /Sidebar -->

        <!-- Page Content -->
        <div id="page-content-wrapper" class="w-100">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
                <div class="container-fluid">
                    <button class="btn btn-info me-3" id="menu-toggle"><i class="fas fa-bars"></i></button>
                    <span class="navbar-brand mb-0 h1">HR Management</span>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
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

            <!-- Main Content -->
            <div class="container mt-4">
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
        <!-- /Page Content -->
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Toggle Sidebar
        document.getElementById("menu-toggle").addEventListener("click", function () {
            const wrapper = document.getElementById("wrapper");
            wrapper.classList.toggle("toggled");
        });
    </script>
    @stack('scripts')
</body>
</html>
