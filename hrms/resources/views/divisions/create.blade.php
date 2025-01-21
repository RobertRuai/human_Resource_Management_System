@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Division</h1>
    <form action="{{ route('divisions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Division Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="head_of_division">Head of Division</label>
            <input type="text" class="form-control" id="head_of_division" name="head_of_division">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Division</button>
    </form>
</div>
@endsection