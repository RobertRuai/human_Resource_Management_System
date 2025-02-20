@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">
                        <i class="fas fa-file-invoice-dollar mr-2"></i>Payroll Management
                    </h2>
                    <div>
                        <a href="{{ route('payrolls.create') }}" class="btn btn-success">
                            <i class="fas fa-plus mr-2"></i>Create New Payroll
                        </a>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="payrollTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>
                                        <input type="checkbox" id="selectAllCheckbox">
                                    </th>
                                    <th>Employee</th>
                                    <th>Basic Salary</th>
                                    <th>Gross Salary</th>
                                    <th>Net Pay</th>
                                    <th>Bank</th>
                                    <th>Account Number</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($payrolls as $payroll)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="selected_payrolls[]" 
                                                   value="{{ $payroll->id }}" 
                                                   class="payroll-checkbox">
                                        </td>
                                        <td>
                                            <a href="{{ route('payrolls.show', $payroll->id) }}" 
                                               class="text-primary font-weight-bold">
                                                {{ $payroll->employee->first_name }} 
                                                {{ $payroll->employee->last_name }}
                                            </a>
                                        </td>
                                        <td>{{ number_format($payroll->basic_salary, 2) }}</td>
                                        <td>{{ number_format($payroll->gross_salary, 2) }}</td>
                                        <td class="text-success font-weight-bold">
                                            {{ number_format($payroll->net_pay, 2) }}
                                        </td>
                                        <td>{{ $payroll->bank }}</td>
                                        <td>{{ $payroll->account_number }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('payrolls.show', $payroll->id) }}" 
                                                   class="btn btn-info btn-sm" 
                                                   title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('payrolls.edit', $payroll->id) }}" 
                                                   class="btn btn-warning btn-sm" 
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm delete-payroll" 
                                                        data-id="{{ $payroll->id }}"
                                                        title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle mr-2"></i>
                                                No payroll records found. 
                                                <a href="{{ route('payrolls.create') }}" class="alert-link">
                                                    Create your first payroll
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($payrolls->count() > 0)
                        <div class="card-footer">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="selectAllBottom">
                                        <label class="form-check-label" for="selectAllBottom">
                                            Select All
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-danger" id="bulkDeleteBtn" disabled>
                                            <i class="fas fa-trash mr-2"></i>Delete Selected
                                        </button>
                                        <button class="btn btn-success" id="exportBtn">
                                            <i class="fas fa-file-excel mr-2"></i>Export to Excel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $payrolls->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Confirm Deletion
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this payroll record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deletePayrollForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select All Checkboxes
    const selectAllCheckboxes = document.querySelectorAll('#selectAllCheckbox, #selectAllBottom');
    const payrollCheckboxes = document.querySelectorAll('.payroll-checkbox');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');

    selectAllCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            payrollCheckboxes.forEach(cb => {
                cb.checked = this.checked;
            });
            updateBulkDeleteButton();
        });
    });

    payrollCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkDeleteButton);
    });

    function updateBulkDeleteButton() {
        const selectedCheckboxes = document.querySelectorAll('.payroll-checkbox:checked');
        bulkDeleteBtn.disabled = selectedCheckboxes.length === 0;
    }

    // Delete Single Payroll
    const deleteButtons = document.querySelectorAll('.delete-payroll');
    const deleteConfirmModal = $('#deleteConfirmModal');
    const deletePayrollForm = document.getElementById('deletePayrollForm');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const payrollId = this.getAttribute('data-id');
            deletePayrollForm.action = `/payrolls/${payrollId}`;
            deleteConfirmModal.modal('show');
        });
    });

    // Export Button (placeholder)
    const exportBtn = document.getElementById('exportBtn');
    exportBtn.addEventListener('click', function() {
        alert('Export functionality to be implemented');
    });
});
</script>
@endsection