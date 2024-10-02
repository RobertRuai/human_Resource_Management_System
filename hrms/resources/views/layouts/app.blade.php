<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - HR Management</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">HR Management</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('employees.index') }}">Employees</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('departments.index') }}">Departments</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('salaries.index') }}">Salaries</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('leaves.index') }}">Leaves</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('trainings.index') }}">Trainings</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('notifications.index') }}">Notifications</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('audit_logs.index') }}">Audit Logs</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
