@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-calculator mr-2"></i> Bulk Payroll Generation
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('payrolls.bulkGenerate') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Generation Type</label>
                    <select name="generation_type" id="generationType" class="form-control" required>
                        <option value="all">All Employees</option>
                        <option value="selected">Selected Employees</option>
                        <option value="division">By Division</option>
                        <option value="department">By Department</option>
                    </select>
                </div>

                <div id="selectedEmployeesSection" class="form-group" style="display:none;">
                    <label>Select Employees</label>
                    <select name="selected_employees[]" class="form-control" multiple>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">
                                {{ $employee->first_name }} {{ $employee->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div id="divisionSection" class="form-group" style="display:none;">
                    <label>Select Division</label>
                    <select name="division_id" class="form-control">
                        <option value="">Select a division</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}">
                                {{ $division->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div id="departmentSection" class="form-group" style="display:none;">
                    <label>Select Department</label>
                    <select name="department_id" class="form-control">
                        <option value="">Select a department</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Month</label>
                    <select name="month" class="form-control" required>
                        @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}" {{ $month == date('n') ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Year</label>
                    <select name="year" class="form-control" required>
                        @foreach(range(date('Y') - 2, date('Y') + 2) as $year)
                            <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-calculator mr-2"></i> Generate Payrolls
                    </button>
                    <a href="{{ route('payrolls.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Payrolls
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialize Select2
    $('select[name="selected_employees[]"]').select2({
        placeholder: 'Select employees',
        allowClear: true,
        width: '100%'
    });

    // Handle generation type change
    $('#generationType').on('change', function() {
        var selectedType = $(this).val();
        
        // Hide all sections first
        $('#selectedEmployeesSection, #departmentSection, #divisionSection').hide();
        
        // Show relevant section based on selection
        if (selectedType === 'selected') {
            $('#selectedEmployeesSection').show();
        } else if (selectedType === 'department') {
            $('#departmentSection').show();
        }
        else if (selectedType === 'division') {
            $('#divisionSection').show();
        }
    });

    // Handle form submission
    $('form').on('submit', function(e) {
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
        } else if (selectedType === 'division') {
            var divisionId = $('select[name="division_id"]').val();
            if (!divisionId) {
                errorMessage = 'Please select a division';
                isValid = false;
            }
        }

        if (!isValid) {
            e.preventDefault();
            alert(errorMessage);
        }
    });
});
</script>
@endsection 