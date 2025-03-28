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
use App\Http\Controllers\PayrollController;
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
});

Route::middleware(['auth', 'role:Admin|HR Manager|Supervisor|Employee'])->group(function () {
    Route::resource('employees', EmployeeController::class);
    Route::get('/get-employee-details/{employeeId}', [EmployeeController::class, 'getEmployeeDetails']);
    Route::get('employees/export/pdf', [EmployeeController::class, 'exportPdf'])->name('employees.export.pdf');
    Route::get('employees/export/excel', [EmployeeController::class, 'exportExcel'])->name('employees.export.excel');
});

Route::middleware('auth')->group(function () {
    Route::resource('leaves', LeaveController::class);
    Route::resource('employees', EmployeeController::class);
    Route::post('leaves/{leave}/supervisor-review', [LeaveController::class, 'supervisorReview'])->name('leaves.supervisor-review');
    Route::post('leaves/{leave}/hr-review', [LeaveController::class, 'hrReview'])->name('leaves.hr-review');
    Route::resource('notifications', NotificationController::class);
    #Route::resource('payrolls', PayrollController::class);
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

Route::middleware(['auth', 'role:Admin|HR Manager'])->group(function () {
    Route::get('/payrolls/bulk-generate', [PayrollController::class, 'showBulkGenerateForm'])->name('payrolls.bulkGenerateForm');
    Route::post('/payrolls/bulk-generate', [PayrollController::class, 'bulkGenerate'])->name('payrolls.bulkGenerate');
    Route::delete('/payrolls/bulk-destroy', [PayrollController::class, 'bulkDestroy'])->name('payrolls.bulkDestroy');
    Route::post('/payrolls/select', [PayrollController::class, 'select'])->name('payrolls.select');
    Route::get('/payrolls/export', [PayrollController::class, 'exportToExcel'])->name('payrolls.export');
    Route::get('/payrolls/download-template', [PayrollController::class, 'downloadTemplate'])->name('payrolls.downloadTemplate');
    Route::post('/payrolls/upload-excel', [PayrollController::class, 'uploadExcel'])->name('payrolls.uploadExcel');
     // Resource route should come last
     Route::resource('payrolls', PayrollController::class);
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
    Route::get('/get-employee-details/{employeeId}', [EmployeeController::class, 'getEmployeeDetails']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
