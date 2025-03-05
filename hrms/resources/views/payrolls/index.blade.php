@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-file-invoice-dollar"></i> All Payrolls
        </div>
       <!-- Search Area -->
        <div class="card-body">
            <!-- Search and Filters Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <form action="{{ route('payrolls.index') }}" method="GET" class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <!-- Search Field -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="search" class="form-label">Search Employee</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-search"></i>
                                            </span>
                                            <input type="text" name="search" id="search" class="form-control" 
                                                   placeholder="Search by name..." 
                                                   value="{{ request('search') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Division Filter -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="division_id" class="form-label">Division</label>
                                        <select name="division_id" id="division_id" class="form-select">
                                            <option value="">All Divisions</option>
                                            @foreach($divisions as $division)
                                                <option value="{{ $division->id }}" 
                                                    {{ request('division_id') == $division->id ? 'selected' : '' }}>
                                                    {{ $division->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Department Filter -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="department_id" class="form-label">Department</label>
                                        <select name="department_id" id="department_id" class="form-select">
                                            <option value="">All Departments</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Search Button -->
                                <div class="col-md-3 d-flex align-items-end gap-2">
                                    <button type="submit" class="btn btn-primary flex-grow-1">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                    <a href="{{ route('payrolls.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-undo"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="row mb-4">
                <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2">
                            <a href="{{ route('payrolls.create') }}" class="btn btn-primary">
                                <i class="fas fa-user-plus"></i> Add New Payroll
                            </a>
                            <a href="{{ route('payrolls.bulkGenerateForm') }}" class="btn btn-success">
                                <i class="fas fa-calculator"></i> Bulk Generate
                            </a>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('employees.export.pdf', request()->query()) }}" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </a>
                            <a href="{{ route('employees.export.excel', request()->query()) }}" class="btn btn-success">
                                <i class="fas fa-file-excel"></i> Export Excel
                            </a>
                            <button class="btn btn-secondary" onclick="window.print()">
                                <i class="fas fa-print"></i> Print
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="page-description">
            <!-- <p>The table below shows the current active departments in all the divisions.</p> -->
        </div>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                                <tr>
                                    <th>
                                        <input type="checkbox" id="selectAll">
                                    </th>
                                    <th>Employee</th>
                                    <th>Basic Salary</th>
                                    <th>Gross Salary</th>
                                    <th>Net Pay</th>
                                    <th>Bank</th>
                                    <th>Account Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($payrolls as $payroll)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="selected_payrolls[]" 
                                                   value="{{ $payroll->id }}" 
                                                   class="payroll-checkbox selectItem">
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
                                            <a href="{{ route('payrolls.show', $payroll->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                                            <a href="{{ route('payrolls.edit', $payroll->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                            <form action="{{ route('payrolls.destroy', $payroll->id) }}" method="POST" style="display:inline-block;"
                                            onsubmit="return confirm('Are you sure you want to delete this payroll?');">
                                                @csrf
                                                @method('DELETE')
                                                <button  type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                                            </form>
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
                    <p class="copyright">&copy; {{ date('Y') }} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
                    
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
// Wait for both DOM and jQuery to be ready
function initializePayrollScripts() {
    // Handle division change to load departments
    $('#division_id').on('change', function() {
        var divisionId = $(this).val();
        var departmentSelect = $('#department_id');
        
        // Clear current departments
        departmentSelect.html('<option value="">All Departments</option>');
        
        if (divisionId) {
            // Fetch departments for selected division
            $.get('/divisions/' + divisionId + '/departments', function(departments) {
                departments.forEach(function(department) {
                    departmentSelect.append(
                        $('<option></option>')
                            .val(department.id)
                            .text(department.name)
                    );
                });
            });
        }
    });

    // Initialize Select2 if the element exists
    if ($('select[name="selected_employees[]"]').length) {
        $('select[name="selected_employees[]"]').select2({
            placeholder: 'Select employees',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#bulkGenerateModal')
        });
    }

    // Handle generation type change if the element exists
    if ($('#generationType').length) {
        $('#generationType').on('change', function() {
            var selectedType = $(this).val();
            
            // Hide all sections first
            $('#selectedEmployeesSection, #departmentSection').hide();
            
            // Show relevant section based on selection
            if (selectedType === 'selected') {
                $('#selectedEmployeesSection').show();
            } else if (selectedType === 'department') {
                $('#departmentSection').show();
            }
        });
    }

    // Handle form submission if the form exists
    if ($('#bulkGenerateForm').length) {
        $('#bulkGenerateForm').on('submit', function(e) {
            e.preventDefault();
            
            // Basic validation
            var selectedType = $('#generationType').val();
            var isValid = true;
            var errorMessage = '';

            if (selectedType === 'selected') {
                var selectedEmployees = $('select[name="selected_employees[]"]').val();
                if (!selectedEmployees || selectedEmployees.length === 0) {
                    errorMessage = 'Please select at least one employee';
                    isValid = false;
                }
            } else if (selectedType === 'department') {
                var departmentId = $('select[name="department_id"]').val();
                if (!departmentId) {
                    errorMessage = 'Please select a department';
                    isValid = false;
                }
            }

            if (!isValid) {
                alert(errorMessage);
                return false;
            }

            // If validation passes, submit the form
            this.submit();
        });
    }

    // Handle bulk delete functionality if the elements exist
    if ($('#selectAll').length) {
        $('#selectAll').on('change', function() {
            $('.payroll-checkbox').prop('checked', $(this).prop('checked'));
            updateBulkDeleteButton();
        });
    }

    if ($('.payroll-checkbox').length) {
        $('.payroll-checkbox').on('change', function() {
            updateBulkDeleteButton();
        });
    }

    function updateBulkDeleteButton() {
        var selectedCount = $('.payroll-checkbox:checked').length;
        if ($('#bulkDeleteBtn').length) {
            $('#bulkDeleteBtn').prop('disabled', selectedCount === 0);
        }
    }

    // Handle single delete if the elements exist
    if ($('.delete-payroll').length) {
        $('.delete-payroll').on('click', function() {
            var payrollId = $(this).data('id');
            if ($('#deletePayrollForm').length) {
                $('#deletePayrollForm').attr('action', '/payrolls/' + payrollId);
                $('#deleteConfirmModal').modal('show');
            }
        });
    }

    // Handle bulk delete if the button exists
    if ($('#bulkDeleteBtn').length) {
        $('#bulkDeleteBtn').on('click', function() {
            var selectedIds = [];
            $('.payroll-checkbox:checked').each(function() {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length > 0) {
                if (confirm('Are you sure you want to delete the selected payroll records?')) {
                    var form = $('<form>', {
                        'method': 'POST',
                        'action': '{{ route("payrolls.bulkDestroy") }}'
                    });

                    form.append($('<input>', {
                        'type': 'hidden',
                        'name': '_token',
                        'value': '{{ csrf_token() }}'
                    }));

                    form.append($('<input>', {
                        'type': 'hidden',
                        'name': 'selected_payrolls[]',
                        'value': selectedIds.join(',')
                    }));

                    $('body').append(form);
                    form.submit();
                }
            } else {
                alert('Please select at least one payroll record to delete.');
            }
        });
    }

    // Handle export to Excel if the button exists
    if ($('#exportToExcel').length) {
        $('#exportToExcel').on('click', function() {
            window.location.href = '{{ route('payrolls.export') }}';
        });
    }
}

// Check if jQuery is loaded
if (typeof jQuery !== 'undefined') {
    $(document).ready(initializePayrollScripts);
} else {
    console.error('jQuery is not loaded');
}
</script>
@endsection