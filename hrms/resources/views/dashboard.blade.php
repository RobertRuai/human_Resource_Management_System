@extends('layouts.app')

@section('content')

<style>
    .top-menu li a {
        color: #707070;
    }
    .welcome h6, .welcome h5{
        font-weight: bold;
    }
    .welcome p {
        font-size: 13px;
        color: #606060;
        margin-bottom: 10px
    }
    .welcome i {
        font-size: 14px;
    }
</style>
   
    <div class="welcome">
        <h5>
            <span id="time-greeting">Good Morning</span> {{ Auth::user()->username }},
        </h5>
        <p>Our HRMS is designed to streamline our HR processes, making it easier to manage our workforce and focus on what matters most.</p>
        <h6 class="mt-4 text"><i class="fas fa fa-bars"></i> Overview</h6>
        <p>Dashboard Overview</p>
    </div>

    <!-- Statistics Cards -->
    <div class="row justify-content-center">
        <!-- Total Divisions -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-home fa-2x me-3"></i>
                        <div>
                            <h6 class="card-title">Divisions</h6>
                            <p class="card-text">{{ $departmentCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Users -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users fa-2x me-3"></i>
                        <div>
                            <h6 class="card-title">Employees</h6>
                            <p class="card-text">{{ $employeeCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Leaves -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-calendar-alt fa-2x me-3"></i>
                        <div>
                            <h6 class="card-title">Pending Leaves</h6>
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
                <div class="card-header bg-white">Employee Distribution</div>
                <div class="card-body">
                    <canvas id="departmentChart"></canvas>
                </div>
            </div>
        </div>
         <!-- User Role Distribution Chart -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header bg-white">User Role Distribution</div>
                <div class="card-body">
                    <canvas id="roleChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Leave Status Chart -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header bg-white">Leave Status</div>
                <div class="card-body">
                    <canvas id="leaveStatusChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Training Participation Chart -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header bg-white">Training Participation</div>
                <div class="card-body">
                    <canvas id="trainingChart"></canvas>
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

    <script>
        function getTimeOfDay() {
            const hour = new Date().getHours();
            if (hour >= 5 && hour < 12) {
                return 'Morning';
            } else if (hour >= 12 && hour < 17) {
                return 'Afternoon';
            } else if (hour >= 17 && hour < 22) {
                return 'Evening';
            } else {
                return 'Night';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const greetingElement = document.getElementById('time-greeting');
            if (greetingElement) {
                greetingElement.textContent = `Good ${getTimeOfDay()}`;
            }
        });
    </script>
    <p class="copyright">&copy; {{ date('Y') }} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
</div>
@endsection
@section('scripts')
@endsection