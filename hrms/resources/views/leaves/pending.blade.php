@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pending Leave Requests</h1>

    @if ($pendingLeaves->count())
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendingLeaves as $leaf)
            <tr>
                <td>{{ $leaf->employee_id_number }}</td>
                <td>{{ $leaf->leave_commencement }}</td>
                <td>{{ $leaf->date_of_return }}</td>
                <td>
                    <a href="{{ route('leaves.approve', $leaf->id) }}" class="btn btn-success">Approve</a>

                    <!-- Disapprove Modal Trigger -->
                    <button class="btn btn-danger" data-toggle="modal" data-target="#disapproveModal-{{ $leaf->id }}">Disapprove</button>

                    <!-- Disapprove Modal -->
                    <div class="modal fade" id="disapproveModal-{{ $leaf->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Disapprove Leave Request</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('leaves.disapprove', $leaf->id) }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="remarks">Reason for Disapproval</label>
                                            <textarea name="remarks" class="form-control" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-danger">Disapprove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No pending leave requests.</p>
    <p class="copyright">&copy; {{ date('Y')}} HRMS Portal South Sudan Revenue Authority. All Rights Reserved.</p>
    @endif
</div>
@endsection
