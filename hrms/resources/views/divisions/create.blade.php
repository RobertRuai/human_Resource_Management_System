@extends('layouts.app')

@section('content')
<!-- Admin Content -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
        <i class="fas fa-building"></i> Add New Division
        </div>
    </div>
   
                <div class="card add-page">
                    <div class="card-body">
                    <form action="{{ route('divisions.store') }}" method="POST">
                    @csrf
                    <div class="form-display">
                        <div class="col-2 form-group">
                            <label for="name">Division Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-2 form-group">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="col-2 form-group">
                            <label for="head_of_division">Head of Division <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="head_of_division" name="head_of_division">
                        </div>
                        <div class="col-2 form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-display">
                        <div class="col-2 form-group">
                            <button type="submit" class="btn btn-success"><i class='fas fa fa-save'></i> Create Division</button>
                            <a href="{{ route('divisions.index') }}" class="btn btn-danger"><i class='fas fa fa-times-circle'></i> Cancel</a>
                        </div>
                    </form>
                </div>
                <p class="copyright">&copy; 2024 HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
            </div>
        </div>
    </div>
@endsection