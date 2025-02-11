<!-- resources/views/leaves/supervisor_review.blade.php -->
@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <i class="fas fa-calendar-check"></i> Supervisor Review
        </div>
        <div class="card-body">
            <form action="{{ route('leaves.supervisor-review', $leave) }}" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="status">Decision</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">Select Decision</option>
                        <option value="approved">Approve</option>
                        <option value="rejected">Reject</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="supervisor_remarks">Remarks</label>
                    <textarea name="supervisor_remarks" id="supervisor_remarks" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Review</button>
                <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
