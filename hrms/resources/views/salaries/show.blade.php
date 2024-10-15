<!-- resources/views/users/show.blade.php -->
@extends('layouts.app')

@section('title', 'Salary Details')

@section('content')
    <h1>Salary Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{  $salary->employee_id_number}}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $salary->monthly_basic_salary }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $salary->currency }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $salary->allowances }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $salary->gross_salary }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $salary->monthly_taxes }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $salary->monthly_deductions }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $salary->monthly_insurance }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $salary->net_salary }}</p>
            <p class="card-text"><strong>salary:</strong> {{ $salary->salary_startDate }}</p>
            <p class="card-text"><strong>salary:</strong> {{ $salary->salary_endDate }}</p>
            <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Back to salary</a>
            <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-warning">Edit salary</a>
        </div>
    </div>
@endsection
