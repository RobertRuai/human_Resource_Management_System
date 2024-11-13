@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="my-4">HRMS Dashboard</h1>

    <!-- Statistics Cards -->
    <div class="row">
        <!-- Total Employees -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Employees</h5>
                    <p class="card-text">{{ $employeeCount }}</p>
                </div>
            </div>
        </div>
        <!-- Total Users -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text">{{ $userCount }}</p>
                </div>
            </div>
        </div>

        <!-- Pending Leaves -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pending Leaves</h5>
                    <p class="card-text">{{ $pendingLeavesCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Employee Distribution by Department -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    Employee Distribution by Department
                </div>
                <div class="card-body">
                    <canvas id="departmentChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Leave Status Chart -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    Leave Status
                </div>
                <div class="card-body">
                    <canvas id="leaveStatusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Charts Row -->
    <div class="row">
        <!-- Training Participation Chart -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    Training Participation
                </div>
                <div class="card-body">
                    <canvas id="trainingChart"></canvas>
                </div>
            </div>
        </div>

        <!-- User Role Distribution Chart -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    User Role Distribution
                </div>
                <div class="card-body">
                    <canvas id="roleChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Employee Distribution by Department Chart
const departmentData = @json($departmentData);
const departmentChartCtx = document.getElementById('departmentChart').getContext('2d');
new Chart(departmentChartCtx, {
    type: 'pie',
    data: {
        labels: departmentData.labels,
        datasets: [{
            label: 'Employees',
            data: departmentData.data,
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'],
        }],
    },
});

// Leave Status Chart
const leaveStatusData = @json($leaveStatusData);
const leaveStatusChartCtx = document.getElementById('leaveStatusChart').getContext('2d');
new Chart(leaveStatusChartCtx, {
    type: 'doughnut',
    data: {
        labels: leaveStatusData.labels,
        datasets: [{
            label: 'Leave Status',
            data: leaveStatusData.data,
            backgroundColor: ['#4e73df', '#f6c23e', '#e74a3b'],
        }],
    },
});



// User Role Distribution Chart
const roleData = @json($roleData);
const roleChartCtx = document.getElementById('roleChart').getContext('2d');
new Chart(roleChartCtx, {
    type: 'pie',
    data: {
        labels: roleData.labels,
        datasets: [{
            label: 'User Roles',
            data: roleData.data,
            backgroundColor: ['#1cc88a', '#36b9cc', '#f6c23e'],
        }],
    },
});
</script>
@endsection