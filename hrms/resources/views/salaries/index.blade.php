<!-- resources/views/users/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-money-check-alt"></i> All Payrolls
                </div>
                <!-- Search Area -->
                <div class="container mt-1 search-area">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search payrolls.." aria-label="Search" aria-describedby="button-search">
                                <div class="input-group-append">
                                    <button class="btn btn-white" type="button" id="button-search">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Add New employee Button -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('salaries.create') }}" class="btn btn-primary add-btn" id="openPopupBtn"><i class="fas fa-money-check"></i> Add New Payroll</a>
                    </div>
                    <div class="col-md-5 download-btn">
                        <div class="download-form">
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-file-pdf text-danger"></i> PDF
                            </a>
                        </div>
                        <div class="download-form">
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-file-excel text-success"></i> Excel
                            </a>
                        </div>
                            <button class="btn btn-secondary" onclick="window.print()">
                                <i class="fas fa-print"></i> Print Page
                            </button>
                        </div>
                    </div>
                    <div class="">
                        <select class="form-control select-option" id="monthSelector">
                            <option selected>Filter Payrolls by Division</option>
                            <option>Corporate Service Division (CSD)</option>
                            <option>Domestic Tax Revenue Division (DTRD)</option>
                            <option>Customs Revenue Division (CRD)</option>
                            <option>Internal Audit Division (IAD)</option>
                            <option>Internal Affairs Division (INAD)</option>
                            <option>Information and Communication Technology Division (ICTD)</option>
                        </select>
                    </div>

            <div class="d-flex justify-content-between align-items-center mb-3">

            @if($salaries->isEmpty())
                <p class="salaries-paragraph"><i class="fas fa-warning text-warning"></i> No Payrolls records found.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Employee ID</th>
                            <th>Monthly Basic Salary</th>
                            <th>Currency</th>
                            <th>Allowances</th>
                            <th>Gross Salary</th>
                            <th>Monthly Taxes</th>
                            <th>Monthly Deductions</th>
                            <th>Monthly Insurance</th>
                            <th>Net Salary</th>
                            <th>Salary Start Date</th>
                            <th>Salary End Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($salaries as $salary)
                            <tr>
                                <td>{{ $salary->employee_id_number }}</td>
                                <td>{{ $salary->monthly_basic_salary }}</td>
                                <td>{{ $salary->currency }}</td>
                                <td>{{ $salary->allowances }}</td>
                                <td>{{ $salary->gross_salary }}</td>
                                <td>{{ $salary->monthly_taxes }}</td>
                                <td>{{ $salary->monthly_deductions }}</td>
                                <td>{{ $salary->monthly_insurance }}</td>
                                <td>{{ $salary->net_salary }}</td>
                                <td>{{ $salary->salary_startDate }}</td>
                                <td>{{ $salary->salary_endDate }}</td>
                                <td>
                                    <a href="{{ route('salaries.show', $salary->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                                    <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                    <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" style="display:inline-block;" 
                                        onsubmit="return confirm('Are you sure you want to delete this salary record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
        </div>
    </div>
</div>
    @endif
@endsection
