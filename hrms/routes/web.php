<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeaveApprovalController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

#Route::get('/dashboard', function () {
#    return view('dashboard');
#})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index');
});

Route::middleware('auth')->group(function () {
    Route::resource('audit_logs', AuditLogController::class);
    Route::resource('divisions', DivisionController::class);
    Route::resource('departments', DepartmentController::class);
    Route::get('divisions/{division}/departments', [DepartmentController::class, 'byDivision'])
        ->name('divisions.departments');
    Route::resource('employees', EmployeeController::class);
    Route::get('/get-employee-details/{employeeId}', [EmployeeController::class, 'getEmployeeDetails']);
    Route::resource('leaves', LeaveController::class);
    Route::post('leaves/{leave}/hr-review', [LeaveController::class, 'hrReview'])->name('leaves.hr-review');
    Route::resource('notifications', NotificationController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('salaries', SalaryController::class);
    Route::resource('trainings', TrainingController::class);
    Route::resource('users', UserController::class);

    Route::get('/hr/leaves', [LeaveApprovalController::class, 'index'])->name('hr.leaves.index');
    Route::get('/hr/leaves/{id}/approveLeave', [LeaveApprovalController::class, 'approveLeave'])->name('hr.leaves.approve');
    Route::post('/hr/leaves/{id}/disapproveLeave', [LeaveApprovalController::class, 'disapproveLeave'])->name('hr.leaves.disapprove');

    Route::get('departments/export/pdf', [DepartmentController::class, 'exportPdf'])->name('departments.export.pdf');
    Route::get('departments/export/excel', [DepartmentController::class, 'exportExcel'])->name('departments.export.excel');
});

Route::middleware(['auth', 'role:HR Manager'])->group(function () {
    // Add HR Manager routes here
    Route::get('leaves/{leave}/hr-review', [LeaveController::class, 'showHrReview'])->name('leaves.hr-review');
    Route::post('leaves/{leave}/hr-review', [LeaveController::class, 'hrReview'])->name('leaves.hr-review');
});

Route::middleware(['auth', 'role:Supervisor'])->group(function () {
    Route::get('leaves/{leave}/supervisor-review', [LeaveController::class, 'showSupervisorReview'])->name('leaves.supervisor-review');
    Route::post('leaves/{leave}/supervisor-review', [LeaveController::class, 'supervisorReview'])->name('leaves.supervisor-review');
});

Route::middleware(['auth', 'role:Employee'])->group(function () {
    // Add Employee routes here
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
