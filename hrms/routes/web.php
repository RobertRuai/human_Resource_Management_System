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

Route::get('/admin', function () {
    return view('admin.index');
})->middleware(['auth', 'role:Admin,'])->name('admin.index');



Route::middleware('auth')->group(function () {
    Route::resource('audit_logs', AuditLogController::class);
    Route::resource('divisions', DivisionController::class);
    Route::resource('departments', DepartmentController::class);
    Route::get('divisions/{division}/departments', [DepartmentController::class, 'byDivision'])
        ->name('divisions.departments');
    Route::resource('employees', EmployeeController::class);
    Route::resource('leaves', LeaveController::class);
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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
