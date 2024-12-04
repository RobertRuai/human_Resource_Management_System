@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="my-4 text-center">HRMS Dashboard</h1>

    <!-- Statistics Cards -->
    <div class="row justify-content-center">
        <!-- Total Employees -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users fa-2x me-3"></i>
                        <div>
                            <h5 class="card-title">Total Employees</h5>
                            <p class="card-text">{{ $employeeCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Users -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user-circle fa-2x me-3"></i>
                        <div>
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text">{{ $userCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Leaves -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-calendar-alt fa-2x me-3"></i>
                        <div>
                            <h5 class="card-title">Pending Leaves</h5>
                            <p class="card-text">{{ $pendingLeavesCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Employee Distribution by Department -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Employee Distribution by Department</div>
                <div class="card-body">
                    <canvas id="departmentChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Leave Status Chart -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header">Leave Status</div>
                <div class="card-body">
                    <canvas id="leaveStatusChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Training Participation Chart -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header">Training Participation</div>
                <div class="card-body">
                    <canvas id="trainingChart"></canvas>
                </div>
            </div>
        </div>
        <!-- User Role Distribution Chart -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header">User Role Distribution</div>
                <div class="card-body">
                    <canvas id="roleChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const departmentData = @json($departmentData);
        const departmentChartCtx = document.getElementById('departmentChart').getContext('2d');
        new Chart(departmentChartCtx, {
            type: 'pie',
            data: {
                labels: departmentData.labels,
                datasets: [{
                    data: departmentData.data,
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'],
                }],
            },
        });

        const leaveStatusData = @json($leaveStatusData);
        const leaveStatusChartCtx = document.getElementById('leaveStatusChart').getContext('2d');
        new Chart(leaveStatusChartCtx, {
            type: 'doughnut',
            data: {
                labels: leaveStatusData.labels,
                datasets: [{
                    data: leaveStatusData.data,
                    backgroundColor: ['#4e73df', '#f6c23e', '#e74a3b'],
                }],
            },
        });

        const trainingData = @json($trainingData);
        const trainingChartCtx = document.getElementById('trainingChart').getContext('2d');
        new Chart(trainingChartCtx, {
            type: 'bar',
            data: {
                labels: trainingData.labels,
                datasets: [{
                    data: trainingData.data,
                    backgroundColor: ['#1cc88a', '#36b9cc', '#f6c23e'],
                }],
            },
        });

        const roleData = @json($roleData);
        const roleChartCtx = document.getElementById('roleChart').getContext('2d');
        new Chart(roleChartCtx, {
            type: 'polarArea',
            data: {
                labels: roleData.labels,
                datasets: [{
                    data: roleData.data,
                    backgroundColor: ['#1cc88a', '#36b9cc', '#f6c23e'],
                }],
            },
        });
    </script>
</div>
@endsection

@section('scripts')
@endsection